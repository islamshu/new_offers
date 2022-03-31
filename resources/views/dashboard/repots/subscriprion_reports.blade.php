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
                        <th> <img src="https://freepikpsd.com/file/2019/10/apple-pay-png-5.png" width="100" height="40" alt="">
                            {{ __('   Apple pay') }}</th>
                        <td>{{ $applepay }}</td>
                        <td>{{ $sumapplepay }}SR</td>

                    </tr>
                    <tr>
                        <th>
                            <img src="https://freepikpsd.com/file/2019/10/apple-pay-png-5.png" width="100" height="40" alt="">
                                
                        {{ __('Apple pay (Mada)') }}
                        </th>
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
