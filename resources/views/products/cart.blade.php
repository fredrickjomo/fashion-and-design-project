@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card-default col-md-6">
                <div class="card-title">
                    <p><a href="{{ url('/') }}">Home</a> / Cart Items</p>
                </div>
                <div class="card-body">
                    @if(sizeof(Cart::content())>0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Number</th>
                                <th class="table-image">Caption</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th class="column-spacer"></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach (Cart::content() as $item)
                                <tr>
                                    <td>{{$number++}}</td>
                                    <td class="table-image"><a href="{{ url('shop', [$item->model->slug]) }}"> <img src='{{url("storage/images/products/{$item->model->image}")}}'  height="100px" width="100px" class="img-responsive">
                                        </a></td>
                                    <td><a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }}</a></td>
                                    <td>
                                        <select class="quantity" data-id="{{ $item->rowId }}">
                                            <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                                            <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                                            <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                                            <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                                            <option {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                                        </select>
                                    </td>
                                    <td>Ksh.{{ $item->subtotal }}</td>
                                    <td class=""></td>
                                    <td>
                                        <form action="{{ url('/remove-from-cart', [$item->rowId]) }}" method="POST" class="side-by-side">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" class="btn btn-danger btn-sm col-md-12" value="Remove"><br><br>
                                        </form>

                                        <form action="{{ url('/switchToWishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                                            {!! csrf_field() !!}
                                            <input type="submit" class="btn btn-success btn-sm col-md-12" value="To Wishlist">
                                        </form>
                                    </td>
                                </tr>

                            @endforeach
                            <tr>
                                <td class="table-image"></td>
                                <td></td>
                                <td class="small-caps table-bg" style="text-align: right">Subtotal</td>
                                <td>Ksh.{{ Cart::instance('default')->subtotal() }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-image"></td>
                                <td></td>
                                <td class="small-caps table-bg" style="text-align: right">Tax</td>
                                <td>Ksh.{{ Cart::instance('default')->tax() }}</td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr class="border-bottom">
                                <td class="table-image"></td>
                                <td style="padding: 40px;"></td>
                                <td class="small-caps table-bg" style="text-align: right">Your Total</td>
                                <td class="table-bg">Ksh.{{ Cart::total() }}</td>
                                <td class="column-spacer"></td>
                                <td></td>
                            </tr>

                            </tbody>
                        </table>
                        <a href="{{ url('/') }}" class="btn btn-primary btn-lg">Continue Shopping</a> &nbsp;
                        <a href="#" class="btn btn-success btn-lg">Proceed to Checkout</a>


                    @else

                        <h3>You have no items in your shopping cart</h3>
                        <a href="{{ url('/') }}" class="btn btn-primary btn-lg">Continue Shopping</a>

                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection