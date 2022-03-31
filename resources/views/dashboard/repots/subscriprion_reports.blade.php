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
                        <td>{{__('Count') }}</td>
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
                        <th><img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" width="100" height="40" alt="">{{ __('Visa/Master') }}</th>
                        <td>{{ $visa }}</td>
                        <td>{{ $sumvisa }}SR</td>

                    </tr>
                    <tr>
                        <th><img src="data:image/png;base64,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" width="100" height="40" alt="">{{ __('STC') }}</th>
                        <td>{{ $stc }}</td>
                        <td>{{ $sumstc }}SR</td>

                    </tr>
                    <tr>
                        <th>{{ __('Apple pay') }}</th>
                        <td>{{ $applepay }}</td>
                        <td>{{ $sumapplepay }}SR</td>

                    </tr>
                    <tr>
                        <th>{{ __('Apple pay (Mada)') }}</th>
                        <td>{{ $applepaymada }}</td>
                        <td>{{ $sumapplepaymada }} SR</td>

                    </tr>
                    <tr>
                        <th>{{ __('Mada') }}</th>
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
