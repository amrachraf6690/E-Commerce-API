<?php

namespace App\Http\Controllers\API\Main;

use App\Http\Controllers\API\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $product = Category::find($id);

        if ($product){
            return Response::SendResponse(200,"Here's your category",new CategoryResource($product));
        }else{
            return Response::SendResponse(404,"There's no categories like that",null);
        }
    }
}
