<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::where('role','admin')->get();
        $users =  UserResource::collection($users);
        return response()->json([
            'admins' => $users,
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
            "name"=> 'required',     
            "email"=> 'required|min:6|unique:users',                 
            "password"=> 'required|min:3',                 
            "phone_no"=> 'required|min:1',                 
            "address"=> 'required|min:3', 
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

        //store data 
        $user = new User;              
        $user->name =request('name');
        $user->email =request('email');            
        $user->password =md5(request('password'));            
        $user->phone_no =request('phone_no');            
        $user->address =request('address');            
        $user->image =$path;            
        $user->role ='admin';            
        $user->save();

        return response()->json([
            'user'  =>  $user,
            'message'   =>  'Successfully Admin Added!'
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
            "name"=> 'required',     
            "email"=> 'required|min:6',                
            "phone_no"=> 'required|min:1',                 
            "address"=> 'required|min:3',   
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

        $user=User::find($id);
        $user->name =request('name');
        $user->email =request('email');
        if (request('new_password')) {
            $password = md5(request('new_password'));
        }else {
            $password = request('old_password');
        }            
        $user->password = $password;            
        $user->phone_no =request('phone_no');            
        $user->address =request('address');            
        $user->image =$path;            
        $user->role ='admin';            
        $user->save();

        return response()->json([
            'message'   =>  'Successfully Admin updated!!'
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
        $user = User::find($id);
        $user->delete();
        
        return response()->json([
            'message'   =>  'Successfully Admin deleted!!'
        ],200);
    }
}
