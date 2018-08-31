@extends('layouts.main')
@section('content')
<div class="container designers">
    <div class="row">
        <div class="col-md-12">
            <div class="card-default">
                <div class="card-header text-center">
                    <h4>Our Designers</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($designers as $designer)
                        <div class="col-md-3">
                            <img src='{{url("storage/images/profiles/{$designer->image}")}}' height="200px" width="100%">
                            <label><b>Name: </b>{{$designer->name}}</label>
                            <label><b>Email: </b>{{$designer->email}}</label>
                            <a href="#" class="btn btn-primary" onclick="viewProfile({{url('/view-designer-profile/'.$designer->id)}})">View Designer Profile</a>
                            <script>
                                function viewProfile() {
                                    window.open("_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=150,left=500,width=650,height=550");
                                }
                            </script>
                        </div>
                            @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    @endsection