<?php

namespace App\Http\Controllers\API\Main;

use App\Http\Controllers\API\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
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

        $brand = Brand::with('products')->find($id);
        if ($brand){
            return Response::SendResponse(200,"Here's your brand",new BrandResource($brand));
        }else{
            return Response::SendResponse(404,"There's no brand like that",null);
        }
    }
}
