@extends('layout.default')

@section('content')
    @php
    $lang = app()->getLocale();
    @endphp
    <div class="card card-custom">

        <div class="card-header">
            <h3 class="card-title">
                {{ __('Subscription Repots') }}
            </h3>
            <div class="card-toolbar">
                <div class="example-tools justify-content-center">
                    <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                    <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                </div>
            </div>
        </div>
        <form method="get" action="{{ route('subscriprion_reports', ['locale' => app()->getLocale()]) }}">

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
                <div class="alert {{ session()->get('status') }} alert-dismissible fade show" role="alert">
                    <span> {{ session()->get('message') }}<span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                </div>
            @endif
            <div class="card-body">
                <div class="container">

                    <div class="row">




                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Subscribe at
                                </label>
                            </div>
                            <input type="date" value="{{ $request->date_from }}" placeholder="Subscribe at"
                                class="form-control" name="date_from">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Subscribe To
                                </label>
                            </div>
                            <input type="date" value="{{ $request->date_to }}" placeholder="Subscribe To"
                                class="form-control" name="date_to">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>

                    </div>

                </div>

            </div>

        </form>
    </div>
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All Subscription') }}</h2>


            <table class="datatable table datatable-bordered datatable-head-custom " style="width: 50%">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>{{ __('Type') }}</th>
                        <td><a href="{{ route('get_detelis',['en',json_encode($request->all()),'trial']) }}">{{__('Count') }}</a></td>
                        <td>{{__('Total') }}</td>

                    </tr>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>{{ __('Trial') }}</th>
                        <td>{{ $trial }}</td>
                        <td>_</td>
                    </tr>
                    <tr>
                        <th>{{ __('By Admin') }}</th>
                        <td>{{ $admin }}</td>
                        <td>_</td>
                    </tr>
                   <tr>
                    <th>{{ __('By Excel') }}</th>
                    <td>{{ $excel }}</td>
                    <td>_</td>
                    </tr>
                    <tr>
                        <th>{{ __('Activation Code') }}</th>
                        <td>{{ $activation }}</td>
                        <td>{{ $sumactivation }}SR</td>

                    </tr>

                    <tr>
                        <th><img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" width="50" height="20" alt="">&nbsp;	&nbsp;	{{ __('Visa/Master') }}</th>
                        <td>{{ $visa }}</td>
                        <td>{{ $sumvisa }}SR</td>

                    </tr>
                    <tr>
                        <th><img src="https://eg.poxnel.com/wp-content/uploads/2020/11/%D8%B4%D8%B9%D8%A7%D8%B1-stc-%D8%AC%D8%AF%D9%8A%D8%AF.png" width="50" height="20" alt="">&nbsp;	&nbsp;	{{ __('STC') }}</th>
                        <td>{{ $stc }}</td>
                        <td>{{ $sumstc }}SR</td>

                    </tr>
                    <tr>
                        <th> <img src="https://e7.pngegg.com/pngimages/462/855/png-clipart-apple-pay-google-pay-payment-samsung-pay-apple-text-logo.png" width="50" height="20" alt="">
                            &nbsp;	&nbsp;	     {{ __('   Apple pay') }}</th>
                        <td>{{ $applepay }}</td>
                        <td>{{ $sumapplepay }}SR</td>

                    </tr>
                    <tr>
                        <th>
                            <img src="https://e7.pngegg.com/pngimages/462/855/png-clipart-apple-pay-google-pay-payment-samsung-pay-apple-text-logo.png" width="50" height="20" alt="">
                                
                            &nbsp;	&nbsp;	 {{ __('Apple pay (Mada)') }}
                        </th>
                        <td>{{ $applepaymada }}</td>
                        <td>{{ $sumapplepaymada }} SR</td>

                    </tr>
                    <tr>
                        <th> <img src="data:image/png;base64,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" width="50" height="20" alt="">  &nbsp;	&nbsp;	 {{ __('   Mada') }}</th>
                        <td>{{ $mada }}</td>
                        <td>{{ $summada }}SR</td>

                    </tr>
                </thead>


            </table>


        </div>
    </div>




@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#vendor_id').on('change', function() {
                // console.log("hmm its change");
                var cat_id = $(this).val();
                // console.log(cat_id);
                var div = $(this).parent();

                var op = " ";

                $.ajax({
                    type: 'get',
                    url: "{{ route('get_branch_ajax', ['locale' => app()->getLocale()]) }}",
                    data: {
                        'venodr_id': cat_id
                    },
                    success: function(data) {
                        $('#branch_id').html(new Option('', '', 'disabled', 'selected'));
                        for (var i = 0; i < data.length; i++) {
                            @if ($lang == 'ar')
                                $('#branch_id').append(new Option(data[i].name_ar,
                                data[i].id));
                            @else
                                $('#branch_id').append(new Option(data[i].name_en,
                                data[i].id));
                            @endif

                        }
                    },
                    error: function() {

                    }
                });

            });
        });
    </script>
    <script>
        $(function() {
            $("#kt_datatablenew").DataTable({
                // "pagingType": "full_numbers",
                "scrollX": true

            });
        });
    </script>
@endsection
