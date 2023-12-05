<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data =  [
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'added_at'=>$this->created_at->diffforhumans(),
            'products_count'=>$this->products->count(),
        ];
        if (Route::currentRouteName() === 'brand') {
            $data['products'] = ProductResource::collection($this->products);
        }

        return $data;
    }
}
