<?php

namespace App\Http\Controllers\API\Main;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Controllers\API\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function __invoke(Request $request,$id)
    {
        $product = Product::find($id);

        if ($product){
            return Response::SendResponse(200,"Here's your product",new ProductResource($product));
        }else{
            return Response::SendResponse(404,"There's no product like that",null);
        }
    }
}
