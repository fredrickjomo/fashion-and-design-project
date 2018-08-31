@extends('layouts.designer')
@section('header')
    Edit "{{$product->name}}" product information
    @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
        <div class="card card-default col-md-8">
            <div class="card-header text-center">
                {{$product->name}}
            </div>
            <div class="card-body">
                <form method="POST" action='{{url("/update_product/{$product->slug}")}}'>
                {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name<span class="required">*</span></label>
                                <input id="name" name="name" value="{{$product->name}}" spellcheck="false" required class="form-control"/>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description">Description<span class="required">*</span></label>
                                <textarea id="description" name="description" value="{{$product->name}}" spellcheck="false" required class="form-control">
                                    {{$product->description}}
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price<span class="required">*</span></label>
                                <input id="price" name="price" value="{{$product->price}}" spellcheck="false" required class="form-control"/>
                                @if ($errors->has('price'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Category<span class="required">*</span> </label>
                                <select id="category" required name="category" spellcheck="false" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}">
                                    <option value="{{$product->category}}">{{$product->category}}</option>
                                    <option value="general">General</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @if ($errors->has('category'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group profile-image">
                                <label for="photo">Photo<span class="required">* &nbsp;<i class="fa fa-angle-right" style="color: red;"></i><h9>current</h9></span></label>
                                <img src='{{url("storage/images/products/{$product->image}")}}' height="30px" width="30px">
                                <input id="photo" type="file" class="form-control" name="image" value="{{$product->image}}">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-lg col-md-12" value="Update"/>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>
</div>
    @endsection