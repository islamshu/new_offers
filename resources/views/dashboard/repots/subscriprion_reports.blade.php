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
                        <th><img src="https://eg.poxnel.com/wp-content/uploads/2020/11/%D8%B4%D8%B9%D8%A7%D8%B1-stc-%D8%AC%D8%AF%D9%8A%D8%AF.png" width="100" height="40" alt="">{{ __('STC') }}</th>
                        <td>{{ $stc }}</td>
                        <td>{{ $sumstc }}SR</td>

                    </tr>
                    <tr>
                        <th> <img src="data:image/png;base64,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" width="100" height="40" alt="">{{ __('   Apple pay') }}</th>
                        <td>{{ $applepay }}</td>
                        <td>{{ $sumapplepay }}SR</td>

                    </tr>
                    <tr>
                        <th>{{ __('Apple pay (Mada)') }}</th>
                        <td>{{ $applepaymada }}</td>
                        <td>{{ $sumapplepaymada }} SR</td>

                    </tr>
                    <tr>
                        <th> <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAApVBMVEX///8AAACAvAQBoOEBoOLQ6uz9/v/3//sAouD7+/Hq8dQAnuIRoNiBuQaAuwR2twAAmNzn5+fv+fU/Pz+pqanF3JOcz+hMTEywsLDAwMAfHx9ubm5mZma5ubmioqJ2dnZUVFQsLCz19fWGhobd3d18fHyVlZXg4OBLS0vKysoQEBBeXl6jo6NDQ0OQkJAXFxc3NzcnJyfR0dHl8/YAkt34/Oy/2o3KdSkyAAAEzElEQVR4nO3a7XqiOBgGYBm7TLuz2xkGdpWConwpKmrZ7Z7/oa15Ez4CWu0kVrmu5/6FIa15DIRAGAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAK7in9+UmWe/xGyqPp+oHC6KONSY8O9/f6j62WxrkfprMhKtdIO90TQ5lAV8c5R2khTBK+2ad3f9csJvw0clw2EjYTyvo1DB4sVoiQ+ly+qTIzXGXLd+Cj0JH1QMH4aPdcJJo4E2K7Da+QyDVV7VH9NmY3yppjPQ4pBwqKZOGDfb57ES0SfLUWk5O5SGNtsUvVvUbWn/HvHdJbR5tCIkLEq3mxqyuq85OgRyp4gXY+rl5b0l5F2YNP75oj4hj3FbPeWwjxva5N1p3VnCbXWeXZhw8FpHqhJGfDvQdiZqTDiqTr8SP0o3x763jlF3ejPhuH083EPCefekm1HE3CeJ077GpWzv+mhCV951HwlpcJxK/33RGh1b3TllZbOjCTN5190mHBQ7OaLcxenphDSu+j1IeOiMbUA8ozs8vpMweu86c6uE86MJK+Gu0+jTCfkYld1ZwvzM8LfpHHhTeTjZVAnD5ZnrzG0SRmdaNRZ5Yt/jEpqHvgbio8dvKwx7lvMNPRNTjQn5LOz06EDXy0AkvcBMS0Ct81LeB6/ppOLWxhTQGJdzn/MBz99Zf3rC4oJ2m+U04Ki82rfSdO+kN6GYSr+HjY7WSYedYTaNkmhanG7xxxOqBmwkHFjBu/l8LTcLH03445uah0fpOY0ZT8YSRxi7saYT66MJHx7/UPTzNi2/1Fd19x2QMVXdOgDAJwizTbCf37oV10T3GPb5ev11zYRPT29vT4rUx9Kr9uFffyp7U27EdRN+/6Lo+Um5EUioRHvC0LLCarP9CDi0Fp2iUDyCspu1LH0TJa0Js0g8YfHj0OEra3Z5JxtmkVgYXbtlfXNK9T2vThhPxYrcPNUUUmPCuLHw2WDTOpt0Y+8f+wOWMG2W7PTcTWpMuDSOo8UauYiemrYWRFnCRCrRM8vRmLCzZF9ifcFXT/dLUYkdgaJby+f+LOGGJ8t5bcM93e7bJfQzK+YP8L3MWgRVQ30jcemoq5ZF+arNyCqffdi0c+3QowBrzoqie0xIPzu1nR4mUQexwaY+p9aiGl0iVjScbMqEYTXS6luZ0Z2Q3hGhDhizrVmZsBaIhF7dS0euh1kPE1pOMNof7ERCu6reTGi60do+1HrtXULTkwYfV1TKWgkdqVavEtpS008l3Mi1+pSQvy0VuFlWeCJhXlWqEvJVw/0kyzKnbwkpFl9b3IqEdHX3pIQ0vOxoeI37lnAmYjUS8m5dsKLyakFFfMW06FtCWgsNqFoiEprijAxNKxEJaTawomti764WfAiZpdt1NdK0V0rtcqa626bBS+9GGlNOww9YeZ4ddUr0JPzv+cuzikPC8jnNqkr4UiWkhV/2npAlz8v5KdnsxYAGGPmqqSfhd2VlwoS9NUOz0Yht0aUuZVs8ziTI7Xy9nWSpv6/uGibJKM+X/tYtJ6RxNLLtUeIUTpIbMx0J335X9vXj3xpe9Ba3qfOFdgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAPhc/wO0S6JJ6e2CHgAAAABJRU5ErkJggg==" width="100" height="40" alt="">    {{ __('   Mada') }}</th>
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
