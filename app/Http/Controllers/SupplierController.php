<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
        $suppliers = User::all();
        return view('backend.supplier.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('backend.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return redirect()->route('admin.supplier.index')->with('status','Supplier was successfully added!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Facility  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facility  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier= User::find($id);
        return view('backend.supplier.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
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
        return redirect()->route('admin.supplier.index')->with('status','Supplier was successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier=User::find($id);         
        $supplier->delete();
        return redirect()->route('admin.supplier.index')->with('status','Supplier was successfully deleted!!');
    }
}
