<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use PDF;

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
        //$product=Product::orderBy('created_at','desc')->paginate(9);
        $product=DB::table('products')
            ->select('products.name','products.slug','products.description','products.price','products.image','products.category','users.name as designer')
           ->join('users',function ($join){
               $join->on('users.id','=','products.designer_id');
           })
            ->orderByDesc('products.created_at')
            ->paginate(9);
        //dd($product);
        $men_product_count=DB::table('products')
            ->where('category','men')
            ->count();
        $women_product_count=DB::table('products')
            ->where('category','female')
            ->count();
        return view('/home',compact('product','men_product_count','women_product_count'));

    }
    public function error(){
        return view('/page_not_found');
    }
    public function pdf(){
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->inline();
    }
}
