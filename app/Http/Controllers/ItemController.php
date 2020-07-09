<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\User;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
        $items = Item::all();
        return view('backend.item.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $suppliers = User::all();
        return view('backend.item.create', compact('suppliers'));
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
        return redirect()->route('admin.item.index')->with('status','Item was successfully added!!');
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
        $item= Item::find($id);
        $suppliers = User::all();
        return view('backend.item.edit',compact('item','suppliers'));
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
        return redirect()->route('admin.item.index')->with('status','Item was successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=Item::find($id);         
        $item->delete();
        return redirect()->route('admin.item.index')->with('status','Item was successfully deleted!!');
    }
}
