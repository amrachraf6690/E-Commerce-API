<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data =  [
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'products_count'=>$this->products->count(),
            'added_at'=>$this->created_at->diffforhumans(),
        ];
        if (Route::currentRouteName() === 'category') {
            $data['products'] = ProductResource::collection($this->products);
        }


        return $data;
    }
}
