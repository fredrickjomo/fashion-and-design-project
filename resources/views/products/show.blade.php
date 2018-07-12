<title>Shop Product</title>
@extends('layouts.main')

@section('content')
   <link rel="stylesheet" href="{{asset('css/showproduct.css')}}">

    <div class="container">
        <div class="card-default col-md-8">
            <div class="card-header" style="background-color: #ffffff"><p><a href="{{ url('/') }}">Shop</a> / {{ $product->name }}</p><hr><h2>{{$product->name}}
                -{{$product->description}}</h2>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-5" style="padding: 0">
                        <img src='{{url("storage/images/products/{$product->image}")}}'  height="300px" width="100%" class="img-responsive">
                    </div>

                        <div class="col-md-7">
                            <h3>Ksh. {{ $product->price }}</h3>
                            <form action="{{ url('/add_cart') }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->name }}">
                                <input type="hidden" name="price" value="{{ $product->price }}">
                                <input type="submit" class="btn btn-success btn-lg" value="Add to Cart">
                            </form>

                            <form action="{{ url('/add_wishlist') }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->name }}">
                                <input type="hidden" name="price" value="{{ $product->price }}">
                                <input type="submit" class="btn btn-primary btn-lg" value="Add to Wishlist">
                            </form>


                            <br><br>


                        </div> <!-- end col-md-8 -->
                    </div>



            </div>
            <div class="card-footer"style="background-color: #ffffff">
               <h5 style="font-weight: bold;">Designer::</h5>
            </div>
        </div>
    </div>






@endsection
