<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DesignerController extends Controller
{
    //
    public function  index(){
        return view('administration.designers.adddesigner');
    }
    public  function store(Request $request){
        $validatedData = request()->validate([
            'email'=>'required|unique:users',
            'name'=>'required'
        ]);
        if($validatedData){
            $user=new User();
            $user->name=$request['name'];
            $user->email=$request['email'];
            $user->user_type="designer";
            $user->password=bcrypt($request['email']);
            $user->save();

            if($user){
                flash('Designer added successfully')->success()->important();
                return redirect()->back();
            }
            flash('Product not added...please try again')->error();
            return redirect()->back();
        }





    }
}
