<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'product'=>$this->product->name,
            'address'=>new AddressResource($this->address),
            'price'=>number_format($this->product->price / 100,3).' EGP',
            'ordered_at'=>$this->created_at->diffforhumans(),
            'status'=>$this->status,
        ];
    }
}
