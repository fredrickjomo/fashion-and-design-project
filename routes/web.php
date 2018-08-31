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
    $product=DB::table('products')
        ->select('products.name','products.slug','products.description','products.price','products.category','products.image','users.name as designer')
        ->join('users',function ($join){
            $join->on('users.id','=','products.designer_id');
        })
        ->orderByDesc('products.created_at')
        ->paginate(9);
    $men_product_count=DB::table('products')
        ->where('category','male')
        ->count();
    $women_product_count=DB::table('products')
        ->where('category','female')
        ->count();
    return view('home',compact('product','men_product_count','women_product_count'));
});
Route::get('download-pdf','HomeController@pdf')->name('pdf');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//error page routes
Route::get('/page-not-found','HomeController@error')->name('NOT_FOUND');

//products' routes
Route::get('/display-Item/{slug}','ProductsController@index');
Route::get('/men-products','ProductsController@men_products')->name('men_products');
Route::get('/women-products','ProductsController@women_products')->name('women_products');

//cart routes
Route::post('/add_cart','CartController@store');
Route::get('/cart','CartController@index');
Route::delete('remove-from-cart/{id}','CartController@destroy');
Route::post('/switchToWishlist/{id}','CartController@switchToWishlist');

//designer routes for non auth users
Route::get('available-designers','DesignerController@display')->name('designers');
Route::get('/view-designer-profile/{id}','DesignerController@designer_profile');

//wishlist routes
Route::post('/add_wishlist','WishlistController@store');
Route::get('/wishlist','WishlistController@index');
Route::delete('/remove-from-wishlist/{id}','WishlistController@destroy');
Route::post('/switchToCart/{id}','WishlistController@switchToCart');






//protected routes
Route::middleware(['auth'])->group(function (){

    //checkout routes
    Route::get('/buy-product/{total}','CheckoutController@index');//->name('checkout');
    Route::get('/lipa-na-mpesa/{total}','CheckoutController@lipa_na_mpesa');
    Route::get('/pay-via-card/{total}','CheckoutController@pay_via_card');
    Route::post('/confirm-customer-payment-status','CheckoutController@confirm_payment')->name('confirm_payment');
    Route::get('/checkout-items','PaymentController@checkout')->name('checkout');
    Route::get('/confirm-payment-details/{total}','CheckoutController@confirm_details');

    Route::get('lipa-na-mpesa','CheckoutController@lipa_na_mpesa_transaction')->name('lipa_na_mpesa');
//    Route::get('card-payment/{total}','CheckoutController@pay_via_card');
    //buyer profile update
    Route::post('updating-profile-information/{total}','ProfileController@buyer_profile_update')->name('buyer_profile_update');


    //designer protected  routes
   Route::group(['middleware'=>'designer'],function (){
        Route::post('updating-profile','ProfileController@store')->name('profile_update');
        Route::get('/designer-home','DesignerController@home');
        Route::get('/add-new-product','DesignerController@add_product')->name('designer_add_product');
        Route::post('/adding-product','DesignerController@save_product')->name('designer_save_product');
        Route::get('/my-products','DesignerController@designer_products')->name('designer_products');
        Route::get('/edit-product/{slug}','DesignerController@edit_product');
        Route::post('/update_product/{slug}','DesignerController@update_product');
        Route::get('/delete-product-from-list/{slug}','DesignerController@delete_product');

        //change password routes
       Route::get('designer/change-password','DesignerController@change_password')->name('change_password');
       Route::post('/designer/save-password','DesignerController@save_changed_password')->name('changePassword');

       //designer profile
       Route::get('designer/view-profile','DesignerController@view_profile')->name('view_profile');
       Route::get('designer/edit-profile','DesignerController@edit_profile')->name('edit_profile');
       Route::post('designer/update-profile','DesignerController@update_profile')->name('update_profile');
    });



    //admin protected routes follow here
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
