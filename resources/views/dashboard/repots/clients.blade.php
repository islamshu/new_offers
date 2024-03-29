@extends('layout.default')

@section('content')
@php
    $lang = app()->getLocale();
@endphp
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Slaes Repots') }}
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <form method="get" action="{{route('clients_sales',['locale'=>app()->getLocale()])}}">
        
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
            <div class="container">

                <div class="row">
    
    
                  
                            
                            <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Email
                                </label>
                            </div>
                          <input type="email" value="{{ $request->email }}" placeholder="Email" class="form-control" name="email">
                        </div>
                       
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Phone
                                </label>
                            </div>
                          <input type="text" value="{{ $request->phone }}" placeholder="phone" class="form-control" name="phone">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Registar From
                                </label>
                            </div>
                          <input type="date" value="{{ $request->register_form }}" placeholder="Registar From" class="form-control" name="register_form">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Registar To
                                </label>
                            </div>
                          <input type="date" value="{{ $request->register_to}}" placeholder="Registar To" class="form-control" name="register_to">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Subscribe From
                                </label>
                            </div>
                          <input type="date" value="{{ $request->sub_form}}" placeholder="Subscribe From" class="form-control" name="sub_form">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Subscribe To
                                </label>
                            </div>
                          <input type="date" value="{{ $request->sub_to}}" placeholder="Subscribe To" class="form-control" name="sub_to">
                        </div>
                     
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Subscripe Type
                                </label>
                            </div>
                            <select name="sub_type" class="selectpicker form-control"
                            data-live-search="true" >
                                <option value="">Choose Type</option>
                                <option value="PREMIUM" @if($request->sub_type =='PREMIUM') selected @endif>PREMIUM</option>
                                <option value="FREE" @if($request->sub_type =='FREE') selected @endif>FREE</option>
                                <option value="TRIAL" @if($request->sub_type =='TRIAL') selected @endif>TRIAL</option>
                                <option value="Expir_premium" @if($request->sub_type =='Expir_premium') selected @endif>EXPIRED PREMIUM</option>


                            </select>
                        </div>
                       
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>

                    </div>
              
            </div>

        </div>
        
    </form>
</div>
<div class="card card-docs mb-2">
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <h2 class="mb-3">{{ __('All Clients') }}</h2>


        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
            id="kt_datatablenew">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">

                    <th>{{ __('Whatsapp') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('name') }}</th>
                    <th>{{ __('nationality') }}</th>
                    <th>{{ __('gender') }}</th>
                    <th>{{ __('city') }}</th>
                    <th>{{ __('mobile') }}</th>
                    <th>{{ __('email') }}</th>
                    <th>{{ __('register time') }}</th>
                    <th>{{ __('Subscripe time') }}</th>
                    <th>{{ __('Subscripe type') }}</th>
                    <th>{{ __('Transaction number') }}</th>
                    <th>{{ __('last transaction') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $item)
                    @php
                        $city = @App\Models\City::find($item->city_id);
                    @endphp
                    <td>
                        <a target="_blank" href="https://api.whatsapp.com/send?phone={{ $item->phone }}">Send
                    </a>
                </td>
                    <td>{{ @$item->subs_last->first()->payment_type }}</td>

                    <td>{{ @$item->name }}</td>
                    <td>{{@$item->nationality }}</td>
                    <td>{{$item->gender == 0 ?'Female' : 'Male' }}</td>
                    <td>{{@$city->city_name}}</td>
                    <td>{{@$item->phone}}</td>
                    <td>{{@$item->email}}</td>
                    <td>{{@$item->register_date}}</td>
                    <td>{{@$item->start_date}}</td>
                    <td>{{@$item->expire_date}}</td>
                    <td>{{@$item->purchases_no}}</td>
                    <td>{{$item->last_transaction }}</td>

                   
                    </tr>
                @endforeach
           


            </tbody>

        </table>
        result num : {{ $count }}



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
            $('#branch_id').html(new Option('', '','disabled','selected'));
            for (var i = 0; i < data.length; i++) {
                @if($lang == 'ar')
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
