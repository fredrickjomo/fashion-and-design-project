@extends('layouts.designer')
@section('header')
    My Products
    @endsection
    @section('content')
        <div class="container">
            <div class="row">
                <table class="table table-stripped table-bordered table-hover">
                    <thead>
                    <th style="color: #0b97c4;">Number</th>
                    <th style="color: #0b97c4;">Name</th>
                    <th style="color: #0b97c4;">Caption</th>
                    <th style="color: #0b97c4;">Description</th>
                    <th style="color: #0b97c4;">Category</th>
                    <th style="color: #0b97c4;">Price</th>
                    <th style="color: #0b97c4;">Edit</th>
                    <th style="color: #0b97c4;">Delete</th>
                    </thead>
                    <tbody>
                    @foreach($myproducts as $products)
                    <tr>
                        <td>{{$number++}}</td>
                        <td>{{$products->name}}</td>
                        <td><img src='{{url("storage/images/products/{$products->image}")}}' height="100px" width="100px"></td>
                        <td>{{$products->description}}</td>
                        <td>{{$products->category}}</td>
                        <td>Ksh.{{$products->price}}</td>
                        <td><a href='{{url("/edit-product/{$products->slug}")}}' class="btn btn-success btn-sm">Edit</a> </td>
                        <td><a href='{{url("delete-product-from-list/{$products->slug}")}}' class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this product from my products?.This action ' +
                             'cannot be undone')">
                                Delete</a> </td>

                    </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

        @endsection