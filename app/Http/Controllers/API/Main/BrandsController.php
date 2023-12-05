<?php

namespace App\Http\Controllers\API\Main;

use App\Http\Controllers\API\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BrandsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $query = Brand::query();


        //Search by name
        if (request()->filled('name')) {
            $searchTerm = '%' . request('name') . '%';
            $query->where('name', 'like', $searchTerm)
                ->orWhere('description', 'like', $searchTerm);
        }



        //ordering search results
        if (request()->filled('orderby') && request()->filled('direction')
            && in_array(request('orderby'),['created_at','name','products']) && in_array(request('direction'),['asc','desc'])) {
            $query->orderBy(request('orderby') , request('direction'));
        }



        $brands = $query->get();

        if ($brands) {

            //Checking if there is products with search terms or not
            if ($brands->count() > 0) {

                //Response if we got products
                return Response::SendResponse(
                    200,
                    'We Got your brands',
                    ['count'=>$brands->count(),'items'=>BrandResource::collection($brands)]
                );

            } else {

                //Response if we didn't get products
                return Response::SendResponse(
                    200,
                    'There is no results for the terms you searched for.',
                    ['count'=>$brands->count(),'items'=>$brands]);
            }
        } else {
            return Response::SendResponse(
                404,
                'an error has occurred',
            );
        }
    }
}
