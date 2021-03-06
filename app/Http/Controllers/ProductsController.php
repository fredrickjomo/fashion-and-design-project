<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        //
        $product=Product::where('slug',$slug)
            ->first();
//dd($product);
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administration/products.add');
    }
    public function men_products(){
//        $cart_contents=Cart::content()->groupBy('id');
//
//        dd($cart_contents);
        $product=Product::where('category','male')->orderBy('created_at','desc')
            ->paginate(9);
        return view('products.men',compact('product'));
    }
    public function  women_products(){
        $product=Product::where('category','female')->orderBy('created_at','desc')
            ->paginate(9);
        return view('products.women',compact('product'));
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
            'name' => 'string|min:4|max:20|required|unique:products',
            'description' => 'string|min:10|required',
            'category'=>'required',
            'price' => 'required',
            'image' => 'required|file|mimes:jpeg,jpg,bmp,png,svg,pdf|max:5000',
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = rand(00000001, 99999999) . '.' . $extension;
        if ($request->hasFile('image')) {
                 $product = Product::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'category'=>$request->input('category'),
                'price' => $request->input('price'),
                'slug'=>str_slug($request['name']),
                'designer_id'=>Auth::user()->id,
                'image' => $fileName,
                Input::file('image')->move(storage_path() . '/app/public/images/products/', $fileName),
            ]);
                 if($product){
                     flash('Product added successfully')->success()->important();
                     return redirect()->back();
                 }
                 flash('Product not added...please try again')->error();
                 return redirect()->back();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
