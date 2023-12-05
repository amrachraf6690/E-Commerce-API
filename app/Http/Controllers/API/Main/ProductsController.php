<?php

namespace App\Http\Controllers\API\Main;

use App\Http\Controllers\API\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        //Start the query
        $query = Product::query();

        //Search Filtering by price
        if (request()->filled('min_price') || request()->filled('max_price')) {
            if (request()->filled('min_price') && request()->filled('max_price')) {
                $query->whereBetween('price', [request('min_price') * 100, request('max_price') * 100]);
            } elseif (request()->filled('min_price')) {
                $query->where('price', '>=', request('min_price') * 100);
            } else {
                $query->where('price', '<=', request('min_price') * 100);
            }
        }

        //Search Filtering by Name,Description,Brand Name or Brand Description
        if (request()->has('name')) {
            $query->where('name', 'like', '%' . request('name') . '%')
                ->orWhere('description', 'like', '%' . request('name') . '%')
                ->orWhereHas('brand', function ($query) {
                    $query->where('name', 'like', '%' . request('name') . '%')
                        ->orWhere('description', 'like', '%' . request('name') . '%');
                });
        }


        //Ordering results by price or name
        if (request()->filled('orderby') && request()->filled('direction')
            && in_array(request('orderby'), ['price', 'created_at', 'name']) && in_array(request('direction'), ['asc', 'desc'])) {
            $query->orderBy(request('orderby'), request('direction'));
        }

        //Searching by Brand ID
        if (request()->has('brand_id')) {
            $query->where('brand_id', request('brand_id'));
        }

        //Searching By Category
        if (request()->has('category_id')) {
            $query->where('category_id', request('category_id'));
        }

        //Getting the query results
        $products = $query->get();

        //Checking If we got products
        if ($products) {

            //Checking if there is products with search terms or not
            if ($products->count() > 0) {

                //Response if we got products
                return Response::SendResponse(
                    200,
                    'We Got your products',
                    ['count'=>$products->count(),'items'=>ProductResource::collection($products)]
                    );

            } else {

                //Response if we didn't get products
                return Response::SendResponse(
                    200,
                    'There is no results for the terms you searched for.',
                    ['count'=>$products->count(),'items'=>$products]);
            }
        } else {
            return Response::SendResponse(
                404,
                'an error has occurred',
            );
        }
    }
}
