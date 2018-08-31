
@extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
<div class="container home-page">
    <div class="container text-center">
    <div class="row  top-links">
        <p><a href="">What We Offer</a></p>
        <p><a href="">Days Open</a></p>
        <p><a href="">Our Payment Methods</a></p>
        <p><a href="">Ask Us any Question</a></p>
        <p><a href="{{route('pdf')}}">Delivery Services</a></p>
    </div>
    </div>
    <div class="row justify-content-center">

        <div class="col-md-3 left-sidebar">
            <ul>
                <p style="color: #0000F0;text-decoration: underline;text-align: center">Quick Links</p>
                <a href="{{route('women_products')}}"><li>Women:&nbsp;<span>({{$women_product_count}})</span></li></a>
                <a href="{{route('men_products')}}"><li>Men:&nbsp;<span>({{$men_product_count}})</span></li></a>
                <a href=""><li>New fashion&nbsp;</li></a>
                <a href="{{route('designers')}}"><li>Our designers&nbsp;</li></a>
                <h6 class="text-center" style="text-decoration: underline;font-weight: bold;">
                    Available Colors</h6>
                <li>Blue</li>
                <li>Yellow</li>
                <li>Green</li>
                <li>Pink</li>
                <li>Navy</li>
                <li>Red</li>
                <li>Brown</li>
            </ul>

        </div>
        <div class="col-md-9"><br>
            {{--
            <div class="row">
                <div class="col-md-4">
                    <img src="{{url('storage/images/others/fashion.jpg')}}" alt="new fashion" height="150px">
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <img src="{{url('storage/images/others/kids-fashion.jpg')}}" height="150px">
                </div>
            </div>
            --}}
            <div class="card">
                <div class="card-header text-center"><h5>Shop Our Products Here</h5></div>

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
