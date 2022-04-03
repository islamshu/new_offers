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
    <form method="get" action="{{route('clients_sales_admin',['locale'=>app()->getLocale()])}}">
        
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
                                    last subscribe from 
                                </label>
                            </div>
                          <input type="date" value="{{ $request->last_from }}" placeholder="last subscribe from" class="form-control" name="last_from">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    last subscribe to 
                                </label>
                            </div>
                          <input type="date" value="{{ $request->last_to}}" placeholder="last subscribe to " class="form-control" name="last_to">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    transaction from 
                                </label>
                            </div>
                          <input type="date" value="{{ $request->transaction_from }}" placeholder="Transaction from " class="form-control" name="transaction_from">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    transaction to 
                                </label>
                            </div>
                          <input type="date" value="{{ $request->transaction_to}}" placeholder="Transaction To" class="form-control" name="transaction_to">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Type
                                </label>
                            </div>
                            <select name="type" class="form-control" id="">
                                <option value="">_</option>
                                <option value="FREE" @if($request->type == 'FREE') selected @endif>FREE</option>
                                <option value="TRIAL" @if($request->type == 'TRIAL') selected @endif>TRIAL</option>
                                <option value="PREMIUM" @if($request->type == 'PREMIUM') selected @endif>PREMIUM</option>
                                <option value="Expir_premium" @if($request->type == 'Expir_premium') selected @endif>Expir premium</option>

                                
                                
                            </select>
                        </div>
                     
                        <div class="input-group col-md-5 mb-3">

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </div>

                    </div>
              
            </div>

        </div>
        
    </form>
</div>
<div class="card card-docs mb-2">
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <h2 class="mb-3">{{ __('All Clients') }}</h2>


        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
            id="kt_datatable">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('phone') }}</th>
                    <th>{{ __('city') }}</th>
                    <th>{{ __('register date') }}</th>
                    <th>{{ __('subscribe status') }}</th>
                    <th>{{ __('last subscribe') }}</th>
                    <th>{{ __('first date of last subscribe') }}</th>
                    <th>{{ __('last date of last subscribe') }}</th>
                    <th>{{ __('Subscription event') }}</th>
                    <th>{{ __('subscribe count') }}</th>
                    <th>{{ __('Transaction count') }}</th>
                    <th>{{ __('saving') }}</th>
                    <th>{{ __('Payment method') }}</th>
                    <th>{{ __('mobile type') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $item)
                    @php
                        $city = @App\Models\City::find($item->city_id);
                    @endphp
              <td>{{ @$item->name }}</td>

                <td>{{ @$item->phone }}</td>

                    <td>
                      {{ @$city->city_name ? @$city->city_name : '-' }}
                </td>
                    <td>{{ @$item->register_date }}</td>

                    <td>{{ @$item->type_of_subscribe }}</td>
                    <td>{{@$item->subs->last()->created_at }}</td>
                    <td>{{@$item->start_date }}</td>
                    <td>{{@$item->expire_date }}</td>
                    <td>-</td>
                    <td>{{@$item->subs->count() }}</td>
                    <td>{{@$item->trans->count() }}</td>
                    <td>0</td>
                    <td>{{ @$item->subs->last()->payment_type }}</td>
                    <td>{{ @$item->mobile_type }}</td>

                   
                    </tr>
                @endforeach
           


            </tbody>

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
@endsection
