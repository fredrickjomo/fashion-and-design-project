@extends('layouts.designer')
@section('header')
    Add New Product
    @endsection
@section('content')
    <link rel="stylesheet" href="{{asset('css/designer/addproduct.css')}}">
    <div class="container">
        <div class="card-default">
            <div class="card-body">
                <form action="{{route('designer_save_product')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group row col-md-6">
                        <label for="name">Name<span class="required">*</span> </label>
                        <input placeholder="Name of product" id="name" required name="name" spellcheck="false" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"  />
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group row col-md-6">
                        <label for="description">Description<span class="required">*</span> </label>
                        <textarea placeholder="Product Description" id="description" required name="description" spellcheck="false" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">
                        </textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group row col-md-6">
                        <label for="category">Category<span class="required">*</span> </label>
                        <select id="category" required name="category" spellcheck="false" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}">
                       <option value="">--select category--</option>
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
                    <div class="form-group row col-md-6">
                        <label for="price">Price<span class="required">*</span> </label>
                        <input placeholder="Product Price Tag" type="number" id="price" required name="price" spellcheck="false" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"  />
                        @if ($errors->has('price'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group row col-md-6">
                        <label for="image">Image/Photo<span class="required">*</span> </label>
                        <input type="file" id="image" required name="image" spellcheck="false" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"  />
                        @if ($errors->has('image'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group row col-md-6">
                        <input type="submit" class="btn btn-primary col-md-4" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>

    </div>
    @endsection