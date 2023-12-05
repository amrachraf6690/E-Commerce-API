<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'address'=>$this->street.' ,'.$this->city.' ,'.$this->government.' - '.$this->zip_code,
            'added_at'=>$this->created_at->diffforhumans(),
            'last_update'=>$this->updated_at->diffforhumans(),
        ];
    }
}
