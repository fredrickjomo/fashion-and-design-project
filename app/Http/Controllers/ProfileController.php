<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validatedData = request()->validate([
            'location' => 'string|min:4|max:20|required',
            'phone' => 'string|min:10|required',
            'p_address' => 'required',
            'p_code' => 'string|required|min:4|max:6',
            'image' => 'required|file|mimes:jpeg,jpg,bmp,png,svg|max:5000',
        ]);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = rand(00000001, 99999999) . '.' . $extension;
        if ($request->hasFile('image')) {
            $profile=Profile::create([
                'location'=>$request->input('location'),
                'user_id'=>$request->user()->id,
                'phone'=>$request->input('phone'),
                'p_address'=>$request->input('p_address'),
                'p_code'=>$request->input('p_code'),
                'image'=>$fileName,
                Input::file('image')->move(storage_path() . '/app/public/images/profiles/', $fileName),

        ]);
            if($profile){
                flash('Profile updated successfully')->success()->important();
                return redirect('/home');
            }
            flash('Profile could not be updated successfully...please try again')->error();
            return redirect()->back();
        }

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
    }
}
