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
    <form class="form" method="POST" action="{{ route('generalinfo.store',app()->getLocale()) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">

                <div class="form-group col-md-6">
                    <label>{{ __('Sender Id sms') }}:</label>
                    <input type="text" name="general[sender_id]" id="sender_id" class="form-control form-control-solid"
                        placeholder="Enter Sender Id"  />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('Token for sms') }}:</label>
                    <input type="text" name="general[sms_token]" id="sms_token" class="form-control form-control-solid"
                        placeholder="Token for sms"  />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('password for sms') }}:</label>
                    <input type="text" name="general[sms_password]" id="sms_password" class="form-control form-control-solid"
                        placeholder="Password for sms" required />
                </div>
             
               
             
            </div>
        </div>



        <div class="card-footer">
            <button type="button" onclick="performStore()" class="btn btn-primary mr-2">{{ __('Submit') }}</button>


    </form>
</div>
</div>
@endsection


