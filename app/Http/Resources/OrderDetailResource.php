<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Item;
use App\Http\Resources\ItemResource;
use App\User;
use App\Http\Resources\OrderDetailResource;
class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return[
            'id' => $this->id,
            'item' => new ItemResource(Item::find($this->item_id)),
            'sub_qty' => $this->sub_qty,
            'color' => $this->color,
            'size' => $this->size,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
