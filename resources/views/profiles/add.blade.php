@extends('layouts.main')
@section('content')
    <div class="container">
        <form method="POST" action='{{url("updating-profile-information/{$total}")}}' enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group row">
                <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>

                <div class="col-md-6">
                    <input id="location" placeholder="e.g Nakuru" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" value="{{ old('location') }}" required autofocus>
                    @if ($errors->has('location'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                <div class="col-md-6">
                    <input id="phone" placeholder="e.g 0703 xxx xxx" type="text" maxlength="13" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{old('phone')}}"required>

                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                <div class="col-md-6">
                    <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" value="{{ old('image') }}" required autofocus accept="image/*">
                    @if ($errors->has('image'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="p_address" class="col-md-4 col-form-label text-md-right">Postal Address</label>

                <div class="col-md-6">
                    <input id="p_address" placeholder="e.g 123" type="text" class="form-control{{ $errors->has('p_address') ? ' is-invalid' : '' }}" name="p_address" value="{{ old('p_address') }}"  autofocus >
                    @if ($errors->has('p_address'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('p_address') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="p_code" class="col-md-4 col-form-label text-md-right">Postal Code</label>

                <div class="col-md-6">
                    <input id="p_code" type="number" placeholder="e.g 40200" class="form-control{{ $errors->has('p_code') ? ' is-invalid' : '' }}" name="p_code" value="{{ old('p_code') }}" required autofocus>
                    @if ($errors->has('p_code'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('p_code') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>


            </div>

        </form>
    </div>




@endsection