<?php

namespace App\Http\Controllers\API\Main;

use App\Http\Controllers\API\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $query = Category::query();

        if($request->filled('name')){
            $query->where('name','like','%'.request('name').'%')
                ->orWhere('description','like','%'.request('name').'%');
        }

        if (request()->filled('orderby') && request()->filled('direction')
            && in_array(request('orderby'),['created_at','name','products']) && in_array(request('direction'),['asc','desc'])) {
            $query->orderBy(request('orderby') , request('direction'));
        }

        $data = $query->get();

        if ($data->count()>0){
            return Response::SendResponse(200,'We Got your categories',['count'=>$data->count(),'data'=>CategoryResource::collection($data)]);
        }else{
            return Response::SendResponse(200,'There is no results for the terms you searched for.');

        }
    }
}
