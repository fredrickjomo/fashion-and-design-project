<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $number=1;
        return view('products.cart',compact('number'));
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
        $duplicates=Cart::search(function ($cartItem,$rowId)use ($request){
           return $cartItem->id===$request->id;
        });
        if(!$duplicates->isEmpty()){
            flash('Item is already in your cart!')->error()->important();
            return redirect()->back();
        }
        Cart::add($request->id,
            $request->name,
            1,
        $request->price
            )
            ->associate('App\Product');
        flash('Item Successfully added to cart')->success()->important();
        return redirect()->back();
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
        Cart::remove($id);
        flash('Product removed Successfully from cart')->success()->important();
        return redirect()->back();
    }
    public function switchToWishlist($id){
        $item=Cart::get($id);
        Cart::remove($id);
        $duplicates=Cart::instance('wishlist')->search(function ($cartItem,$rowId)use($id){
           return $cartItem->id===$id;
        });
        if (!$duplicates->isEmpty()){
            flash('Item already in your wishlist')->error();
            return redirect()->back();
        }
        Cart::instance('wishlist')->add($item->id,$item->name,1,$item->price)
            ->associate('App\Product');
        flash('Item has been moved to your wishlist')->success()->important();
        return redirect()->back();
    }
    public function wishlist(){
        return 'almost there';
    }
}
