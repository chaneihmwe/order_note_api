<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\SupplierResource;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers = User::where('role','supplier')->get();
        $suppliers =  SupplierResource::collection($suppliers);
        return response()->json([
            'suppliers' => $suppliers,
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
            "phone_no"=> 'required|min:5',                      
            "address"=> 'required|min:5',
        ]);

         $image = $request->file('image');
        if($image){
            $name=uniqid().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/image'),$name);
            $path='/image/'.$name;
        }
        else{
            $path = null;
        }

        $supplier=new User;
        $supplier->name =request('name');              
        $supplier->phone_no =request('phone_no');              
        $supplier->address =request('address');              
        $supplier->image = $path;              
        $supplier->role = 'supplier';              
        $supplier->save();

        $supplier = new SupplierResource($supplier);

        return response()->json([
            'supplier'  =>  $supplier,
            'message'   =>  'Successfully Supplier Added!'
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
        //
        //echo "$request";die();
        $request->validate([
            "name"=> 'required|min:4',                      
            "phone_no"=> 'required|min:5',                      
            "address"=> 'required|min:5', 
        ]);
        
        $image = $request->file('image');
        if($image){
            $name=uniqid().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/image'),$name);
            $path='/image/'.$name;
        }
        else{
            $path = request('old_image');
        }
        $supplier=User::find($id);
        $supplier->name =request('name');              
        $supplier->phone_no =request('phone_no');              
        $supplier->address =request('address');        
        $supplier->image = $path;        
        $supplier->role = 'supplier';        
        $supplier->save();

        return response()->json([
            'message'   =>  'Successfully Supplier updated!!'
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
        $supplier = User::find($id);
        $supplier->delete();

        return response()->json([
            'message'   =>  'Successfully Supplier deleted!!'
        ],200);
    }
}
