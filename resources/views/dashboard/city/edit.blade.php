@extends('layout.default')

@section('content')
<div class="
card card-docs mb-2">
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('Edit City') }}
            </h3>
            <ol class="breadcrumb">
                <li><a href="/{{ get_lang() }}/home"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
                <li><a href="{{ route('city.index',get_lang()) }}">{{ __('City') }}</a></li>
                <li class="active">{{ __('Edit') }}</li>
            </ol>
           
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-10">
                    <label for="city_name" class="required form-label">{{ __('Name ar') }}</label>
                    <input type="text" class="form-control" name="city_name" placeholder="Enter Arabic name" />
                </div>

                <div class="mb-10">
                    <label for="city_name_english" class="required form-label">{{ __('Name en') }}</label>
                    <input type="text" class="form-control" name="city_name_english" placeholder="Enter English name" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-10">
                    <label for="lat" class="required form-label">{{ __('Latitude') }}
                        </label>
                    <input type="number" name="lat" class="form-control " placeholder="Latitude" />
                </div>

                <div class="mb-10">
                    <label for="lng" class="required form-label">{{ __('Longitude') }}</label>
                    <input type="number" name="lng" class="form-control " placeholder="Longitude" />
                </div>

                <div class="mb-10">
                    <label for="country_id" class="required form-label">{{ __('Select Country') }}</label>
                    <select name="country_id" class="form-control ">
                        <option>City1</option>
                        <option>City1</option>
                        <option>City1</option>
                        <option>City1</option>
                        <option>City1</option>
                    </select>
                </div>

            </div>
        </div>


        <div class="mb-10 ">
            <a href="#" class="btn btn-primary me-2 mb-2">{{ __('Submit') }}</a>
        </div>
    </div>
</div>


@endsection