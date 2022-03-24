@extends('layout.default')

@section('content')
@section('styles')
<style>
    /*the container must be positioned relative:*/
    .autocomplete {
        position: relative;
        display: inline-block;
    }

    input {
        border: 1px solid transparent;
        background-color: #f1f1f1;
        padding: 10px;
        font-size: 16px;
    }

    input[type=submit] {
        background-color: DodgerBlue;
        color: #fff;
        cursor: pointer;
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
        background-color: DodgerBlue !important;
        color: #ffffff;
    }

</style>
@endsection
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Social') }}
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <form method="post" action="">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session()->has('message'))
        <div class="alert {{session()->get('status')}} alert-dismissible fade show" role="alert">
            <span> {{ session()->get('message') }}<span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
        </div>
        @endif
        <div class="card-body">
            <div class="row">

                <div class="form-group col-md-6">

                    <div class="form-group">
                        <label for="exampleSelectd">{{ __('Email') }}</label>
                        <input type="text" name="general[email]" value="{{ get_social('email') }}" class="form-control" id="name_ar">
                     
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectd">{{ __('Phone') }}</label>
                        <input type="text" name="general[phone]" value="{{ get_social('phone') }}" class="form-control" id="name_en">
                     
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectd">{{ __('facebook') }}</label>
                        <input  name="general[facebook]" value="{{ get_social('facebook') }}" class="form-control" id="order">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectd">{{ __('twitter') }}</label>
                        <input  name="general[twitter]" value="{{ get_social('twitter') }}" class="form-control" id="order">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectd">{{ __('Instagram') }}</label>
                        <input  name="general[Instagram]" value="{{ get_social('Instagram') }}" class="form-control" id="order">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectd">{{ __('YouTube') }}</label>
                        <input  name="general[YouTube]" value="{{ get_social('YouTube') }}" class="form-control" id="order">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectd">{{ __('WhatsApp') }}</label>
                        <input  name="general[WhatsApp]" value="{{ get_social('WhatsApp') }}" class="form-control" id="order">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectd">{{ __('Website') }}</label>
                        <input  name="general[Website]" value="{{ get_social('Website') }}" class="form-control" id="order">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectd">{{ __('Telegram') }}</label>
                        <input  name="general[Telegram]" value="{{ get_social('Telegram') }}" class="form-control" id="order">
                    </div>
                
                </div>
                
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" onclick="performStore()" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
    </form>
</div>




@endsection
@section('scripts')
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var avatar4 = new KTImageInput('kt_image_4');

    avatar4.on('cancel', function (imageInput) {
        swal.fire({
            title: 'Image successfully canceled !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Awesome!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    avatar4.on('change', function (imageInput) {
        swal.fire({
            title: 'Image successfully changed !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Awesome!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    avatar4.on('remove', function (imageInput) {
        swal.fire({
            title: 'Image successfully removed !',
            type: 'error',
            buttonsStyling: false,
            confirmButtonText: 'Got it!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{asset('crudjs/crud.js')}}"></script>

@endsection
