<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrderDetail;
use App\Order;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MenuResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderDetailResource;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::all();
        $orders =  OrderResource::collection($orders);
        return response()->json([
            'orders' => $orders,
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
          "name" => "required|min:4|",
          "phone_no" => "required|min:4|",
          "address" => "required|min:4|max:20",
          "qty" => "required|min:1",
          "total_price" => "required|min:4|",
          "order_details" => "required",
        ]);
        $role = 'customer';
        $order_details = json_decode(\request('order_details'));

        $user = User::create([
            'name'      => request('name'),
            'phone_no'      => request('phone_no'),
            'address'   => request('address'),
            'role'   => 'customer',
        ]);

        $order = Order::create([
            'customer_id' => $user->id,
            'order_date'   => date("Y-m-d"),
            'qty'  => request('qty'),
            'total_price'=> request('total_price'),
        ]);

       $order_id = $order->id;
    
        
        foreach ($order_details as $order_detail) {
                OrderDetail::create([
                'order_id'  => $order_id,
                'item_id'   => $order_detail->item_id,
                'sub_qty'   => $order_detail->sub_qty,
                'color'  => $order_detail->color,
                'size'=> $order_detail->size,
            ]);
                }
        return response()->json([
            'orders'  =>  $order,
            'message'   =>  'Successfully Order Added!'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order_id)
    {
        //
        $orders = DB::table('orders')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->select('orders.*', 'order_details.*')
            ->where('orders.id','=',$order_id)
            ->get();
        $order_detail =  OrderDetailResource::collection($orders);
        return response()->json([
            'order_detail' => $order_detail,
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $order = Order::find($id);
        if ($order->confirmed_date == null) {
            $order->confirmed_date = date("Y-m-d");
            $order->save();
            return response()->json([
                'message'   =>  'Successfully Order Confirmed'
            ],200);

        }elseif ($order->delivered_date == null) {
            $order->delivered_date = date("Y-m-d");
            $order->save();
            return response()->json([
                'message'   =>  'Successfully Order Delivered'
            ],200);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $order = Order::find($id);
        $order->delete();
        
        return response()->json([
            'message'   =>  'Successfully Order deleted!!'
        ],200);
    }
}
