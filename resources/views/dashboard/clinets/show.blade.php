@extends('layout.default')

@section('title')
    {{ __('Members') }}
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/c3/c3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/animate-css/vivify.min.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>{{ __('Members') }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                {{-- <a href="{{ route('dashboard.home.index', ['locale' => app()->getLocale()]) }}">
                                    {{ __('Dashboard') }}
                                </a> --}}
                            </li>
                            <li class="breadcrumb-item">
                                {{-- <a href="{{ route('dashboard.member.index', ['locale' => app()->getLocale()]) }}">
                                    {{ __('Members') }}
                                </a> --}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-xl-6 col-lg-6 col-md-5">
                <div class="card">
                    <div class="body">
                        <div class="c_grid c_yellow text-center p-4">
                            <div class="circle">
                                <img class="rounded-circle" src="{{ url($member->image ?? '') }}" alt="">
                            </div>
                            <h6 class="mt-3 mb-0">{{  $member->lname }}</h6>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <small class="text-muted">Phone: </small>
                                <p>{{ $member->phone }}</p>
                                <hr>
                                <small class="text-muted">Email address: </small>
                                <p>{{ $member->email }}</p>
                                <hr>
                                <small class="text-muted">Last Visit: </small>
                                <p>{{ $member->last_login }}</p>
                                <hr>
                                <small class="text-muted">Birth Date: </small>
                                <p class="m-b-0">{{ $member->birthday }}</p>
                                <hr>
                                <small class="text-muted">Gender: </small>
                                <p class="m-b-0">{{ $member->gender }}</p>
                                <hr>
                                <small class="text-muted">Device: </small>
                                <p class="m-b-0">
                                    {{ $member->mobile_type }}
                            </p>
                            </div>
                            <div class="col">
                                <small class="text-muted">Customer ID: </small>
                                <p>{{ $member->member_id }}</p>
                                <hr>
                                <small class="text-muted">Register Date: </small>
                                <p>{{ $member->entry_date }}</p>
                                <hr>
                                <small class="text-muted">Total Order: </small>
                                <p class="m-b-0">{{ 'aa' }}</p>
                                <hr>
                                <small class="text-muted">Total Amount: </small>
                                <p class="m-b-0">{{ 'aa' }}</p>
                                <hr>
                                <small class="text-muted">Total Point: </small>
                                <p class="m-b-0">0 points</p>
                            </div>
                        </div>
                        <hr>
                        <small class="text-muted">Last Address: </small>
                        <p class="m-b-0">
                            @if (!empty($last_address))
                                <b>{{ $last_address->lable }}</b>
                                Address: {{ $last_address->address }} <br>
                                storey number: {{ $last_address->address }} <br>
                                apartment number: {{ $last_address->apartment_number }} <br>
                            @endif
                        </p>
                        <hr>
                        <small class="text-muted">Saved Address: </small>
                        <p class="m-b-0">
                            @if (!empty($last_address))
                                @foreach ($allAddress as $address)
                                    <b>{{ $address->lable }}</b>
                                    Address: {{ $address->address }} <br>
                                    storey number: {{ $address->storey_number }} <br>
                                    apartment number: {{ $address->apartment_number }} <br>
                                    <hr>
                                @endforeach
                            @endif
                        </p>
                        <small class="text-muted">Addresses On Google map: </small>
                        @if (!empty($last_address))
                            <div id="map" style="height: 400px;"></div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="body">
                        <div class="header">
                            <h2>Total Points <small class="text-muted"></small></h2>
                        </div>
                        <div id="Order_status" style="height: 285px"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2>Direct Communication</h2>
                        <span class="text-muted mt-2 d-block">You can communicate directly with the customer through the
                            following means</span>
                    </div>
                    <div class="body">
                        <div class="row text-center">
                            <div class="col-md  col-sm-6 border-right ">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#sendNotificationModal"
                                    id="sendNotification">
                                    <h4 class="font-30 font-weight-bold count text-col-blue">
                                        <i class="fa fa-bell-o fa-2x"></i>
                                    </h4>
                                </a>
                            </div>
                            <div class="col-md  col-sm-6 border-right ">
                                <a href="tel:{{ $member->phone }}">
                                    <h4 class="font-30 font-weight-bold count text-col-blue" ">
                                        <i class=" fa fa-mobile fa-2x"></i>
                                    </h4>
                                </a>
                            </div>
                            <div class="col-md  col-sm-6">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#sendSMSModal" id="sendSMS">
                                    <h4 class="font-30 font-weight-bold count text-col-blue">
                                        <i class="fa fa-comments-o fa-2x"></i>
                                    </h4>
                                </a>
                            </div>
                            <div class="col-md  col-sm-6">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#sendEmailModal"
                                    id="sendEmail">
                                    <h4 class="font-30 font-weight-bold count text-col-blue">
                                        <i class="fa fa-envelope-o fa-2x"></i>
                                    </h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="header">
                        <h2>Notifications & Emails</h2>
                    </div>
                    <div class="bodhy">
                        <table class="table table-custom">

                            <head>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Type</th>
                                <th>Send By</th>
                                <th>Received</th>
                                <th>Date</th>
                            </head>

                            <body>
                                {{-- @foreach ($emails as $email)
                                <tr>
                                    <td>{{$email->id}}</td>
                                    <td>{{$email->subject}}</td>
                                    <td>{{$email->content}}</td>
                                    <td>Email</td>
                                    <td>{{$email->createBy->username}}</td>
                                    <td> <i class="fa fa-check"></i> </td>
                                    <td>{{$email->created_at}}</td>
                                </tr>
                            @endforeach

                            @foreach ($notifications as $notification)
                                <tr>
                                    <td>{{$notification->id}}</td>
                                    <td>{{$notification->title_ar}} - {{$notification->title_en}}</td>
                                    <td>{{$notification->content_ar}}</td>
                                    <td>Notification</td>
                                    <td>{{$notification->createBy->username}}</td>
                                    <td> <i class="fa fa-check"></i> </td>
                                    <td>{{$notification->created_at}}</td>
                                </tr>
                            @endforeach --}}
                            </body>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="header">
                        <h2>Oredrs</h2>
                    </div>
                    <div class="bodhy">
                        <table class="table table-custom">

                            <head>
                                <th>RF</th>
                                <th>Date</th>
                                <th>Total Amount</th>
                                <th>Points</th>
                                <th>District</th>
                                <th>Payment Method</th>
                                <th>Order Type</th>
                            </head>

                            <body>
                                {{-- @foreach ($allOrders as $order)
                            <tr>
                                <td>{{$order->order_number}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>{{$order->total}}</td>
                                <td>0</td>
                                <td>-</td>
                                <td>{!!  $order->payment_type == 'cash' ? '<i class="badge badge-info ml-0 mr-0">CASH</i>': '<i class="badge badge-primary ml-0 mr-0">ONLINE</i>' !!}</td>
                                <td>{!!  $order->order_type == 'delivery' ? '<i class="badge badge-danger ml-0 mr-0">delivery</i>': '<i class="badge badge-success ml-0 mr-0">PICKUP</i>' !!}</td>
                            </tr>
                        @endforeach --}}
                            </body>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="header">
                        <h2>Notes ( SUPPORT )</h2>
                    </div>
                    <div class="bodhy">
                        <table class="table table-custom">

                            <head>
                                <th>#</th>
                                <th>Title Ticket</th>
                                <th>Note</th>
                                <th>Date</th>
                                <th>is Sloved</th>
                            </head>

                            <body>
                                {{-- @if ($msgs->count() > 0)
                                @foreach ($msgs as $msg)
                                <tr>
                                    <td>{{$msg->MessageId}}</td>
                                    <td>{{$msg->MessageTitle}}</td>
                                    <td>{{$msg->MessageContent}}</td>
                                    <td>{{$msg->MessageDate}}</td>
                                    <td><i class=" fa {{$msg->is_sloved == 1 ? 'fa-check text-success' : 'fa-remove text-danger'}}"></i> </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                <td colspan="5" class="text-center">No data .. </td>

                                </tr>
                            @endif --}}
                            </body>
                        </table>
                    </div>
                </div>
            </div>
        </div>




        <div class="modal fade" id="sendEmailModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Send Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="sendEmailForm" method="post" data-action="">
                        <div class="modal-body">
                            <div class="msg"></div>
                            <div class="form-group">
                                <label for="">Send To</label>
                                <input type="email" readonly value="{{ $member->email }}" class="form-control"
                                    name="send_to" id="">
                            </div>

                            <div class="form-group">
                                <label for="">From</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->email }}" name="from"
                                    id="">
                            </div>
                            <div class="form-group">
                                <label for="">Subject</label>
                                <input type="text" class="form-control" name="subject" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Content</label>
                                <textarea name="content" id="" class="form-control" cols="30" rows="10"></textarea>
                            </div>

                            <input type="hidden" name="member_id" value="{{ $member->member_id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-paper-plane"></i> Send</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i
                                    class="fa fa-remove"></i>Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ./ send Email -->


        <div class="modal fade" id="sendSMSModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Send SMS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="sendSMSForm" method="post" data-action="">
                        <div class="modal-body">
                            <div class="msg"></div>
                            <div class="form-group">
                                <label for="">Send To</label>
                                <input type="text" readonly value="{{ $member->phone }}" class="form-control"
                                    name="send_to" id="">
                            </div>

                            <div class="form-group">
                                <label for="">Content</label>
                                <textarea name="content" id="" class="form-control" cols="30" rows="10"></textarea>
                            </div>

                            <input type="hidden" name="member_id" value="{{ $member->member_id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-paper-plane"></i> Send</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i
                                    class="fa fa-remove"></i>Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ./ send SMS -->


        <div class="modal fade" id="sendNotificationModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Send Mobile Notification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="sendNotificationForm" method="post" data-action="">
                        <div class="modal-body">
                            <div class="msg"></div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="form-group col-md-6">
                                    <label for="basic-url" @if ($errors->has('type'))
                                        style="color: red"
                                        @endif
                                        >
                                        {{ __('conect with') }}
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">
                                                <i class="icon-pencil"></i>
                                            </label>
                                        </div>
                                        <select class="custom-select type" id="type" name="type" @if ($errors->has('type'))
                                            style="border: 1px solid red"
                                            @endif
                                            >

                                            @if (Auth::user()->hasRole('Enterprises'))
                                                <option value="vendor" @if (Session::get('type') == 'vendor') selected="selected"
                                                    @endif @if (!$errors->isEmpty())
                                                        @if (old('type') == 'vendor')
                                                            selected="selected"
                                                        @endif
                                                    @endif
                                                    @if ($errors->has('type'))
                                                        style="border: 1px solid red"
                                                    @endif
                                                    >
                                                    {{ __('Vendor') }}
                                                </option>
                                            @endif
                                            <option value="product" @if (Session::get('type') == 'product')
                                                selected="selected" @endif @if (!$errors->isEmpty())
                                                    @if (old('type') == 'product')
                                                        selected="selected"
                                                    @endif
                                                @endif
                                                @if ($errors->has('type'))
                                                    style="border: 1px solid red"
                                                @endif
                                                >
                                                {{ __('product') }}
                                            </option>

                                            <option value="public" @if (Session::get('type') == 'public') selected="selected"
                                                @endif @if (!$errors->isEmpty())
                                                    @if (old('type') == 'public')
                                                        selected="selected"
                                                    @endif
                                                @endif
                                                @if ($errors->has('type'))
                                                    style="border: 1px solid red"
                                                @endif
                                                >
                                                {{ __('public') }}
                                            </option>


                                        </select>
                                    </div>
                                    @if ($errors->has('type'))
                                        <p style="color: red">{{ $errors->first('type') }}</p>
                                    @endif
                                </div>
                            </div>
                            @if (Auth::user()->hasRole('Enterprises'))
                                <div class="brand_section">
                                    <div class="col">
                                        <label>vendor</label>
                                        <div class="multiselect_div mb-3">
                                            <select name="vendor_id" class="multiselect multiselect-custom" id="vendor_id">
                                                {{-- @foreach ($vendors as $company)
                                            <option value="{{ $company->vendor_id }}">
                                                {{ $company->rest_name_english }}
                                            </option>
                                            @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-section">

                                    <div class="product_section">
                                        <div class="row">
                                            <!--rest_id_brand_section_product_section-->
                                            <div class="form-group col-md-6">
                                                <label for="basic-url" @if ($errors->has('rest_id_brand_section_product_section'))
                                                    style="color: red"
                            @endif
                            >
                            {{ __('Vendor') }}
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">
                                        <i class="icon-pencil"></i>
                                    </label>
                                </div>
                                <select class="custom-select rest_id_brand_section_product_section"
                                    name="rest_id_brand_section_product_section">
                                    {{-- @foreach ($vendors as $one_vendor)
                                                    <option value="{{$one_vendor->vendor_id}}"
                                                        @if (Session::has('rest_id_brand_section_product_section'))
                                                        @if (Session::get('rest_id_brand_section_product_section') == $one_vendor->vendor_id)
                                                        selected="selected"
                                                        @endif
                                                        @endif

                                                        @if (!$errors->isEmpty())
                                                        @if (old('rest_id_brand_section_product_section') == $one_vendor->vendor_id)
                                                        selected="selected"
                                                        @endif
                                                        @endif

                                                        @if ($errors->has('rest_id_brand_section_product_section'))
                                                        style="border: 1px solid red"
                                                        @endif
                                                        >
                                                        @if (app()->getLocale() == 'en')
                                                        {{$one_vendor->rest_name_english}}
                                                        @elseif(app()->getLocale() == "ar")
                                                        {{$one_vendor->rest_name}}
                                                        @endif
                                                    </option>
                                                    @endforeach --}}
                                </select>
                            </div>
                            @if ($errors->has('rest_id_brand_section_product_section'))
                                <p style="color: red">
                                    {{ $errors->first('rest_id_brand_section_product_section') }}</p>
                            @endif
                        </div>
                        <!--product_id_brand_section_product_section-->
                        <div class="form-group col-md-6">
                            <label for="basic-url" @if ($errors->has('product_id_brand_section_product_section'))
                                style="color: red"
                                @endif
                                >
                                {{ __('Product') }}
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">
                                        <i class="icon-pencil"></i>
                                    </label>
                                </div>
                                <select class="custom-select product_id_brand_section_product_section"
                                    name="product_id_brand_section_product_section" @if ($errors->has('product_id_brand_section_product_section'))
                                    style="border: 1px solid red"
                                    @endif
                                    >
                                </select>
                            </div>
                            @if ($errors->has('product_id_brand_section_product_section'))
                                <p style="color: red">
                                    {{ $errors->first('product_id_brand_section_product_section') }}</p>
                            @endif
                        </div>

                </div>
            </div>

        </div>
        @endif
        {{-- <div class="form-group">
                <label for="">choose Device</label>
                <select name="device" class="form-control" id="">
                     <option value="all">ALL</option>
                       <option value="android">Android Members</option>
                        <option value="ios">IOS Members</option>
                </select>
            </div> --}}

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">title ar</label>
                    <input type="text" name="title_ar" class="form-control" id="">
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="">title en</label>
                    <input type="text" name="title_en" class="form-control" id="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">content ar</label>
                    <textarea name="content_ar" id="" class="form-control" cols="30" rows="5"></textarea>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">content en</label>
                    <textarea name="content_en" id="" class="form-control" cols="30" rows="5"></textarea>
                </div>
            </div>
        </div>
        @if (Auth::user()->hasRole('Enterprises'))
            <input type="hidden" name="member_id" value="{{ $member->id }}">
        @elseif(Auth::user()->ent_id != 0)
            <input type="hidden" name="member_id" value="{{ $member->id }}">

        @elseif(Auth::user()->hasRole('Vendors') && Auth::user()->ent_id == 0)
            <input type="hidden" name="member_id" value="{{ $member->member_id }}">

        @endif


    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success"> <i class="fa fa-paper-plane"></i> Send</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-remove"></i>
            Close</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    <!-- ./ send SMS -->


@endsection


@section('js')
    <script>
        $(document).ready(function() {

            $('#sendNotificationForm').on('submit', function() {
                var url = $('#sendNotificationForm').data('action');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.code == 400) {
                            $('#sendNotificationForm .msg').html(`
                            <i>` + data.error + `</i>
                        `);
                            $('#sendNotificationForm .msg').addClass(
                                'text-danger alert alert-danger');

                        } else {
                            $('#sendNotificationForm textarea').val('');
                            $('#sendNotificationForm .msg').removeClass(
                                'text-danger alert alert-danger');
                            $('#sendNotificationForm .msg').addClass(
                                'text-success alert alert-success');
                            $('#sendNotificationForm .msg').html(
                                'Notification Has Been Send Successfully');
                        }
                    }
                });
                return false;
            });

            $('#sendEmailForm').on('submit', function() {
                var url = $('#sendEmailForm').data('action');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.code == 400) {
                            $('#sendEmailForm .msg').html(`
                            <i>` + data.error + `</i>
                        `);
                            $('#sendEmailForm .msg').addClass('text-danger alert alert-danger');

                        } else {
                            $('#sendEmailForm input[name=subject]').val('');
                            $('#sendEmailForm textarea').val('');
                            $('#sendEmailForm .msg').removeClass(
                                'text-danger alert alert-danger');
                            $('#sendEmailForm .msg').addClass(
                                'text-success alert alert-success');
                            $('#sendEmailForm .msg').html('Email Has Been Send Successfully');
                        }
                    }
                });
                return false;
            });

            $('#sendSMSForm').on('submit', function() {
                var url = $('#sendSMSForm').data('action');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.code == 400) {
                            $('#sendSMSForm .msg').html(`
                            <i>` + data.error + `</i>
                        `);
                            $('#sendSMSForm .msg').addClass('text-danger alert alert-danger');

                        } else {
                            $('#sendSMSForm textarea').val('');
                            $('#sendSMSForm .msg').removeClass(
                            'text-danger alert alert-danger');
                            $('#sendSMSForm .msg').addClass('text-success alert alert-success');
                            $('#sendSMSForm .msg').html('SMS Has Been Send Successfully');
                        }
                    }
                });
                return false;
            });

        });
    </script>
    <script src="{{ asset('dashboard/assets/assets/bundles/chartist.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/assets/bundles/mainscripts.bundle.js') }}"></script>

    <script src="{{ asset('dashboard/assets/assets/bundles/flotscripts.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/assets/bundles/c3.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/assets/bundles/knob.bundle.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDL_Iurzw7shb69C_H4GLxzETOgHWrzHEw"></script>
    {{-- <script type="text/javascript">
        var locations = [
            @foreach ($allLatLong as $lat => $long)
                ['', {{ $lat }}, {{ $long }}, 1],
            @endforeach
        ];

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 1,
            center: new google.maps.LatLng(-33.92, 151.25),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
        // Order_status
        var chart = c3.generate({
            bindto: '#Order_status', // id of chart wrapper
            data: {
                columns: [
                    // each columns data
                    ['data1', 7470],
                    ['data2', 825]
                ],
                type: 'donut', // default type of chart
                colors: {
                    'data1': '#17c2f7',
                    'data2': '#17c2d2',
                },
                names: {
                    // name of each serie
                    'data1': 'This Month',
                    'data2': 'Last Month'
                }
            },
            axis: {},
            legend: {
                show: false, //hide legend
            },
            padding: {
                bottom: 20,
                top: 0
            },
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#noti_send_to').on('change', function() {
                var to = $(this).val();
                if (to == 'custom') {
                    $('#noti_member').removeClass('d-none');
                    $('#noti_device').addClass('d-none');
                    var ent_id_ent_section = $('#ent_id_ent_section').val();
                    var vendor_ids = [];
                    $("#vendor_id :selected").each(function() {
                        vendor_ids.push(this.value);
                    });

                    // do ajax to get members
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('dashboard.mobile.noti.getAllMembersAjax', ['locale' => app()->getLocale()]) }}",
                        type: "post",
                        dataType: "json",
                        data: {
                            ent_id: ent_id_ent_section,
                            vendor_ids: vendor_ids,
                        },
                        success: function(data) {
                            $('#send_to').html(data.members);
                        }
                    });

                } else {
                    $('#noti_member').addClass('d-none');
                    $('#noti_device').removeClass('d-none');
                }
            });

            $('.multiselect').multiselect('rebuild');
            var success_exist = "{{ Session::has('success_msg') }}";
            var error_exist = "{{ Session::has('error_msg') }}";

            if (success_exist) {
                $context = 'success';
                $message = "{{ Session::get('success_msg') }}";
                $positionClass = 'toast-top-full-width';
                toastr.remove();
                toastr[$context]($message, '', {
                    positionClass: $positionClass
                });
            }
            if (error_exist) {
                $context = 'error';
                $message = "{{ Session::get('error_msg') }}";
                $positionClass = 'toast-top-full-width';
                toastr.remove();
                toastr[$context]($message, '', {
                    positionClass: $positionClass
                });
            }
        });
        var type = $("select.type").children("option:selected").val()
        if (type == "vendor") {
            $(".brand_section").show();
            $(".product_section").hide();
        } else if (type == "product") {
            $(".brand_section").hide();
            $(".product_section").show();
        } else if (type == "public") {
            $(".brand_section").hide();
            $(".product_section").hide();
        }


        $("select.type").change(function() {
            var type = $(this).children("option:selected").val();
            if (type == "vendor") {
                $(".brand_section").show();
                $(".product_section").hide();
            } else if (type == "product") {
                $(".brand_section").hide();
                $(".product_section").show();
            } else if (type == "public") {
                $(".brand_section").hide();
                $(".product_section").hide();
            }
        });
        $("select[name='rest_id_brand_section_product_section'] option:first").prop("selected", true);
        var selected_vendor_id = $("select.rest_id_brand_section_product_section").children("option:selected").val();
        $.ajax({
            url: "{{ route('dashboard.banner.select_products.ajax', ['locale' => app()->getLocale()]) }}",
            type: "GET",
            dataType: "json",
            data: {
                selected_vendor_id: selected_vendor_id,
            },
            success: function(data) {
                $('select[name="product_id_brand_section_product_section"]').empty();
                if (Object.keys(data).length != 0) {
                    $.each(data, function(key, value) {
                        $('select[name="product_id_brand_section_product_section"]').append(
                            '<option value="' + key + '">' + value + '</option>');
                    });
                    $("select[name=product_id_brand_section_product_section'] option:first").prop("selected",
                        true);
                } else {
                    $('select[name="product_id_brand_section_product_section"]').append(
                        '<option value="0">There Is No Product</option>');
                }
            }
        });

        //////show products from enterprise id in ent section (product_section)
        $("select.rest_id_brand_section_product_section").change(function() {
            var selected_vendor_id = $(this).children("option:selected").val();
            $.ajax({
                url: "{{ route('dashboard.banner.select_products.ajax', ['locale' => app()->getLocale()]) }}",
                type: "GET",
                dataType: "json",
                data: {
                    selected_vendor_id: selected_vendor_id,
                },
                success: function(data) {
                    $('select[name="product_id_brand_section_product_section"]').empty();
                    if (Object.keys(data).length != 0) {
                        $.each(data, function(key, value) {
                            $('select[name="product_id_brand_section_product_section"]').append(
                                '<option value="' + key + '">' + value + '</option>');
                        });
                        $("select[name=product_id_brand_section_product_section'] option:first").prop(
                            "selected", true);
                    } else {
                        $('select[name="product_id_brand_section_product_section"]').append(
                            '<option value="0">There Is No Product</option>');
                    }
                }
            });
        });
    </script> --}}
@endsection
