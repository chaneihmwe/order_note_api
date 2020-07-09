<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Item::all();
        $items =  ItemResource::collection($items);
        return response()->json([
            'items' => $items,
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
            "name"=> 'required|min:4',  
            'supplier_id' => 'required',                        
            'image' => 'required',                        
            "price"=> 'required|min:4',                      
        ]);
        $image = $request->file('image');
        if($image){
            $name=uniqid().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('image'),$name);
            $path='image/'.$name;
            }else{
                 $path="";
        }
        $item=new Item;
        $item->name =request('name');              
        $item->supplier_id =request('supplier_id');              
        $item->image = $path;              
        $item->price =request('price');              
        $item->save();

        return response()->json([
            'item'  =>  $item,
            'message'   =>  'Successfully Item Added!'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $request->validate([
            "name"=> 'required|min:4',  
            'supplier_id' => 'required',                      
            "price"=> 'required|min:4',
        ]);
        $image = $request->file('image');
         if($image){
            $name=uniqid().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('image'),$name);
            $path='image/'.$name;
            }else{
                 $path=request('old_image');
        }
        $item=Item::find($id);
        $item->name =request('name');              
        $item->supplier_id =request('supplier_id');              
        $item->image = $path;              
        $item->price =request('price');            
        $item->save();

        return response()->json([
            'message'   =>  'Successfully Item updated!!'
        ],200);
        
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
        $item = Item::find($id);
        $item->delete();
        
        return response()->json([
            'message'   =>  'Successfully Item deleted!!'
        ],200);
    }
}
