<?php

namespace App\Http\Controllers;

use App\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     //
      $usertype=DB::table('users')->where('user_type','designer')->
      where('id',Auth::user()->id)->exists();
        $exists=DB::table('profiles')->where('user_id',Auth::user()->id)->exists();
     // dd($exists);
      if ($usertype==true && $exists==false){
          return view('administration/designers.personal');

      }else{
          $product=Product::orderBy('created_at','desc')->paginate(9);
          return view('home',compact('product'));
      }

    }
    public function error(){
        return view('/page_not_found');
    }
}
