<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Menu;
use App\Http\Resources\MenuResource;
use App\User;
use App\Http\Resources\SupplierResource;
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_date' => $this->order_date,
            'confirmed_date' => $this->confirmed_date,
            'delivered_date' => $this->delivered_date,
            'qty' => $this->qty,
            'total_price' => $this->total_price,
            'customer' => new CustomerResource(User::find($this->customer_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            
        ];
    }
}
