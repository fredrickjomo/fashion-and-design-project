@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card-default col-md-6">
                <div class="card-title">
                    <p><a href="{{ url('/') }}">Home</a> / Wishlist Items</p>
                </div>
                <div class="card-body">
                    @if (sizeof(Cart::instance('wishlist')->content()) > 0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Number</th>
                                <th class="table-image">Caption</th>
                                <th>Product</th>

                                <th>Price</th>
                                <th class="column-spacer"></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach (Cart::instance('wishlist')->content() as $item)
                                <tr>
                                    <td>{{$number++}}</td>
                                    <td class="table-image"><a href="{{ url('shop', [$item->model->slug]) }}">
                                            <img src='{{url("storage/images/products/{$item->model->image}")}}'  height="100px" width="100px" class="img-responsive">
                                        </a></td>
                                    <td><a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }}</a></td>

                                    <td>Ksh.{{ $item->subtotal }}</td>
                                    <td class=""></td>
                                    <td>
                                        <form action="{{ url('remove-from-wishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" class="btn btn-danger btn-sm col-md-12" value="Remove"><br><br>
                                        </form>

                                        <form action="{{ url('switchToCart', [$item->rowId]) }}" method="POST" class="side-by-side">
                                            {!! csrf_field() !!}
                                            <input type="submit" class="btn btn-success btn-sm col-md-12" value="To Cart">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <a href="{{url('/')}}" class="btn btn-primary btn-lg">Continue Shopping</a> &nbsp;
                    @else

                        <h3>You have no items in your Wishlist</h3>
                        <a href="{{url('/')}}" class="btn btn-primary btn-lg">Continue Shopping</a>

                    @endif

                    <div class="spacer"></div>


                </div>
            </div>
        </div>
    </div>

    @endsection