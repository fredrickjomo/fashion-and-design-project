@extends('layouts.designer')
@section('header')
    My Profile
    @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card card-default">
                    <div class="card-header alert alert-dark" style="font-size: 18px; font-weight: bold;">{{$user_profile->name}}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <img src='{{url("storage/images/profiles/{$user_profile->image}")}}' height="200px" width="200px" style="border-radius: 50%;">

                            </div>
                            <div class="col-md-6">
                                <label>Name:&nbsp;</label><b>{{$user_profile->name}}</b><br>
                                <label>Email:&nbsp;</label><b>{{$user_profile->email}}</b><br>
                                <label>Location:&nbsp;</label><b>{{$user_profile->location}}</b><br>
                                <label>Phone No:&nbsp;</label><b>{{$user_profile->phone}}</b><br>
                                <label>Address:&nbsp;</label><b>{{$user_profile->p_address}}-{{$user_profile->p_code}}</b><br>
                                <a href="{{route('edit_profile')}}"class="btn btn-primary">Edit Profile</a>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection