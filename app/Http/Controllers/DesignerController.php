<?php

namespace App\Http\Controllers;

use App\Product;
use App\Profile;
use App\User;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

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
                return redirect()->route('admin');
            }
            flash('Product not added...please try again')->error();
            return redirect()->back();
        }






    }
    public function home(){
        $usertype=DB::table('users')->where('user_type','designer')->
        where('id',Auth::user()->id)->exists();
        $exists=DB::table('profiles')->where('user_id',Auth::user()->id)->exists();
        // dd($exists);
        if ($usertype==true && $exists==false){
            flash('<b class="text-center" style="margin-left: 30%">Fill the form below to complete registration!</b>')->success();
            return view('administration/designers.personal');

        }
        return view('designers.index');
        //  return view to avoid too many redirects if routes are under middleware
    }



    public function add_product(){
        return view('designers/products.add');
    }
    public function save_product(Request $request){
        $validatedData = request()->validate([
            'name' => 'string|min:4|max:50|required|unique:products',
            'description' => 'string|min:5|required',
            'category'=>'required',
            'price' => 'required|integer',
            'image' => 'required|file|mimes:jpeg,jpg,bmp,png,svg|max:5000',
        ]);
        if($validatedData){

            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = rand(00000001, 99999999) . '.' . $extension;
            if ($request->hasFile('image')) {
                $product=Product::create([

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
    }
    public function designer_products(){
        $user=Auth::user()->id;
        $number=1;
        $myproducts=Product::where('designer_id',$user)
            ->get();
        //dd($myproducts);
        return view('designers/products.show',compact('myproducts','number'));
    }
    public  function delete_product($slug){
        $product=Product::where('slug',$slug)->first();
        if($product){
           Storage::disk('local')->delete('public/images/products/'.$product->image);
           $product->delete();
            flash('Product deleted successfully')->success()->important();
            return redirect()->back();
        }
        flash('Could not delete the product. Try again')->error();
        return redirect()->back();

    }
    public function display(){
        $designers=DB::table('users')
            ->select('users.name','users.email','profiles.image','users.id')
            ->where('user_type','designer')
            ->join('profiles',function ($join){
                $join->on('users.id','=','profiles.user_id');
            })
            ->get();
        return view('designers.display',compact('designers'));

    }
    public function designer_profile($id){
        $designer=DB::table('users')
            ->select('users.name','users.email','profiles.image','profiles.location','profiles.phone','profiles.p_address',
                'profiles.p_code')
            ->where('users.user_type','designer')
            ->join('profiles',function ($join){
                $join->on('profiles.user_id','=','users.id');
            })
            ->first();
        return view('designers.view_designer_profile',compact('designer'));
    }
    public function change_password(){
        return view('designers/password.change_password');
    }
    public function save_changed_password(Request $request){
        if(!(Hash::check($request->get('current-password'),Auth::user()->password))){
            //check if password matches
            flash('Error! Your current password does not match with the password you provided. Please try again.')->error();
            return redirect()->back();
        }
        $validatedData=$request->validate([
            'current-password'=>'required',
            'new-password'=>'required|string|min:6|confirmed'
        ]);
        if($validatedData){
            $user=Auth::user();
            $user->password=bcrypt($request->get('new-password'));
            $user->save();
            flash('Success! Password changed successfully!')->success();
            return redirect()->back();
        }
    }
    public function view_profile(){
        $user_profile=DB::table('users')
            ->select('users.name','users.email','profiles.location','profiles.phone','profiles.p_address','profiles.p_code',
                'profiles.image')
            ->where('users.id','=',Auth::id())
            ->join('profiles',function ($join){
                $join->on('users.id','=','profiles.user_id');
            })
            ->first();
        return view('designers/profile.index',compact('user_profile'));

    }
    public function edit_profile(){
        $user_id=Auth::user()->id;
        $user=DB::table('users')
            ->select('users.name','users.email','profiles.image','profiles.location','profiles.phone','profiles.p_address','profiles.p_code')
            ->where('users.id',$user_id)
            ->join('profiles',function ($join){
                $join->on('users.id','=','profiles.user_id');
            })
            ->first();
        return view('designers/profile.edit',compact('user'));

    }
    public function update_profile(Request $request){
        $user_id=Auth::id();;
        $profile=Profile::where('user_id',$user_id)->first();
        $fileName=$profile->image;
        if ($request->hasFile('image')){
            Storage::disk('local')->delete('public/images/profiles/'.$fileName);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = rand(00000001, 99999999) . '.' . $extension;
            Input::file('photo')->move(storage_path() . '/app/public/images/profiles/', $fileName);

        }

        $user_update=User::where('id',$user_id)
            ->update([
               'name'=>$request->input('name'),
            ]);
        $profile_updated=Profile::where('user_id',$user_id)
            ->update([
               'location'=>$request->input('location'),
               'phone'=>$request->input('phone'),
                'p_address'=>$request->input('p_address'),
                'p_code'=>$request->input('p_code'),
                'image'=>$fileName,
            ]);
        if ($user_update && $profile_updated){
            flash('Your profile was successfully updated')->success()->important();
            return back();
        }
        return flash('An error occurred in updating your profile')->error()->important();

    }
    public function edit_product($slug){
        $product=Product::where('slug',$slug)->first();

        return view('designers/products.edit',compact('product'));
    }
    public function update_product(Request $request,$slug){
        $product=Product::where('slug',$slug)->first();
        $fileName=$product->image;
            if ($request->hasFile('image')) {
                Storage::disk('local')->delete('public/images/products/'.$product->image);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileName = rand(00000001, 99999999) . '.' . $extension;
                Input::file('image')->move(storage_path() . '/app/public/images/products/', $fileName);
            }
            $product_update=Product::where('slug',$slug)
                ->update([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'category'=>$request->input('category'),
                    'price' => $request->input('price'),
                    'slug'=>str_slug($request['name']),
                    'designer_id'=>Auth::user()->id,
                    'image' => $fileName,
                ]);
            if($product_update){
                flash('Successfully updated product information')->success()->important();
                return back();
            }
            flash('Error occurred in trying to update product information!.Please try again')->error()->important();
            return back();


    }
}
