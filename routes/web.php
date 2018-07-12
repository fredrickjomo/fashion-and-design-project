<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $product=\App\Product::orderBy('created_at','desc')->paginate(9);
    return view('home',compact('product'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//error page routes
Route::get('/page-not-found','HomeController@error')->name('NOT_FOUND');

//products' routes
Route::get('/display-Item/{slug}','ProductsController@index');

//cart routes
Route::post('/add_cart','CartController@store');
Route::get('/cart','CartController@index');
Route::delete('remove-from-cart/{id}','CartController@destroy');
Route::post('/switchToWishlist/{id}','CartController@switchToWishlist');
Route::post('/add_wishlist','CartController@wishlist');
//wishlist routes

//wishlist routes

Route::get('/wishlist','WishlistController@index');
Route::delete('/remove-from-wishlist/{id}','WishlistController@destroy');
Route::post('/switchToCart/{id}','WishlistController@switchToCart');






//protected routes
Route::middleware(['auth'])->group(function (){
    Route::post('updating-profile','ProfileController@store')->name('profile_update');
   Route::group(['middleware'=>'admin'],function (){
      Route::get('administration','AdminController@index')->name('admin');
      //admin product routes
       Route::get('add-product','ProductsController@create')->name('add_product');
       Route::post('store-product','ProductsController@store')->name('store_product');
       //designer routes
       Route::get('/registerDesigner','DesignerController@index');
       Route::post('/addDesigner/store','DesignerController@store');
   });
});
