@extends('layouts.main')
@section('content')
    <div class="container home-page">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="card-default">
                    <div class="card-header">
                        <h4 class="text-center">Men Products</h4>
                    </div>
                    <div class="card-body">
                        <div class="row purchases">
                            @foreach($product as $products)
                                <div class="col-md-4" style="padding-bottom: 5px;">
                                    <a href='{{url("/display-Item/{$products->slug}")}}'>
                                        <div class="card-default">
                                            <div class="card-header text-center">{{$products->name}}</div>
                                            <div class="card-body"><img src='{{url("storage/images/products/{$products->image}")}}' height="200px" width="100%"></div>
                                            <div class="card-footer">
                                                <b style="color: #1b1e21;">Desc:</b>{{$products->description}}<br>
                                                <b style="color: #1b1e21;">Price:</b>Kshs. {{$products->price}}<br>
                                                <b style="color: #1b1e21;">Designer:</b> {{$products->designer}}<br>
                                                <b style="color: #1b1e21;">For:</b>
                                                @if($products->category=='male')
                                                    Men
                                                @elseif($products->category=='general')
                                                    General Use
                                                @else
                                                    Women
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            @endforeach


                            {{$product->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection