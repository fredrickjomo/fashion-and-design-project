@extends('layouts.designer')
@section('header')
    Edit My Profile
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="card card-default">
                    <div class="card-header text-center alert alert-dark" style="font-size: 18px; font-weight: bold;">{{Auth::user()->name}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update_profile') }}">
                            {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name<span class="required">*</span></label>
                                    <input id="name" name="name" value="{{$user->name}}" spellcheck="false" required class="form-control"/>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email<span class="required">*</span></label>
                                    <input id="email" name="email" value="{{$user->email}}" spellcheck="false" readonly="readonly" required class="form-control"/>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                            </div>
                                <div class="form-group">
                                    <label for="location">Location<span class="required">*</span></label>
                                    <input id="location" name="location" value="{{$user->location}}" spellcheck="false" required class="form-control"/>
                                    @if ($errors->has('location'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone<span class="required">*</span></label>
                                    <input id="phone" name="phone" value="{{$user->phone}}" spellcheck="false" required class="form-control"/>
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="p_address">Postal Address<span class="required">*</span></label>
                                    <input id="p_address" name="p_address" value="{{$user->p_address}}" spellcheck="false" required class="form-control"/>
                                    @if ($errors->has('p_address'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('p_address') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="p_code">Postal Code<span class="required">*</span></label>
                                    <input id="p_code" name="p_code" value="{{$user->p_code}}" spellcheck="false" required class="form-control"/>
                                    @if ($errors->has('p_code'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('p_code') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group profile-image">
                                    <label for="photo">Profile Photo<span class="required">* &nbsp;<i class="fa fa-angle-right" style="color: red;"></i><h9>current</h9></span></label>
                                    <img src='{{url("storage/images/profiles/{$user->image}")}}' height="30px" width="30px">
                                    <input id="photo" type="file" class="form-control" name="image" value="{{$user->image}}">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-lg col-md-5" value="Update"/>
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