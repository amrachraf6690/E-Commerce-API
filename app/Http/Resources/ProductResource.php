<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,//
            'name'=>$this->name,//
            'description'=>$this->description,//
            'price'=>number_format($this->price / 100,3).' EGP',
            'category_id'=>$this->category_id,
            'category'=>$this->category->name,
            'brand_id'=>$this->brand_id,
            'brand'=>$this->brand->name,
            'added_at' => $this->created_at->diffforhumans(),
        ];
    }

}
