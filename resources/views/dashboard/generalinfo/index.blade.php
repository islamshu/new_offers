{{-- Extends layout --}}

@extends('layout.default')

@section('title','Enterprise')

{{-- Content --}}

@section('content')

<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Create Enterprise') }}
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <form class="form" method="POST" action="{{ route('generalinfo.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">

                <div class="form-group col-md-6">
                    <label>{{ __('Name ar') }}:</label>
                    <input type="text" name="name_ar" id="name_ar" class="form-control form-control-solid"
                        placeholder="Enter Name" required />
                </div>
             
               
             
            </div>
        </div>



        <div class="card-footer">
            <button type="button" onclick="performStore()" class="btn btn-primary mr-2">{{ __('Submit') }}</button>


    </form>
</div>
</div>
@endsection


@endsection
