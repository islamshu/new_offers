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
    <form method="get" action="{{route('transaction_sales',['locale'=>app()->getLocale()])}}">
        
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
            <div class="container">

            <div class="row">


              
                        
                        <div class="input-group col-md-6">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    From
                                </label>
                            </div>
                          <input type="date" value="{{ $request->from }}" placeholder="from" class="form-control" name="from">
                        </div>
                       
                        <div class="input-group col-md-6">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    To
                                </label>
                            </div>
                          <input type="date" value="{{ $request->to }}" class="form-control" name="to">
                        </div>
                     
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                   Vendor
                                </label>
                            </div>
                            <select name="vendor_id" id="vendor_id" class="form-control selectpicker" data-live-search="true">
                                <option value="" selected> Choose Brand</option>
                                @foreach ($vendors as $item)
                                <option value="{{ $item->id }}" @if($request->vendor_id == $item->id) selected @endif> {{ $item->name_en }} </option>

                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                   Branch
                                </label>
                            </div>

                            <select value="branch_id" name="branch_id" id="branch_id" class="form-control">
                                <option value="" selected  >{{ __('choose') }}</option>

                            </select>
                        </div>
                       
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>

              
            </div>
            </div>

        
    </form>
</div>
<div class="card card-docs mb-2">
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <h2 class="mb-3">{{ __('All Transaction') }}</h2>


        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
            id="kt_datatable">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">

                    <th>{{ __('offer') }}</th>
                    <th>{{ __('brand') }}</th>
                    <th>{{ __('offer type') }}</th>
                    <th>{{ __('price after discount') }}</th>
                    <th>{{ __('discount percentage') }}</th>
                    <th>{{ __('Crated at') }}</th>
                    <th>{{ __('client name') }}</th>
                    <th>{{ __('client phone') }}</th>
                    <th>{{ __('client age') }}</th>
                    <th>{{ __('client gender') }}</th>
                    <th>{{ __('branch') }}</th>
                    <th>{{ __('Refreace code') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trans as $item)
                @php
                    $offer = App\Models\Offer::find($item->offer_id);
                    $vendor = App\Models\Vendor::find($item->vendor_id);

                    $client = App\Models\Clinet::find($item->client_id);
                @endphp
                    <td>{{ @$offer->name_en }}</td>
                    <td>{{ @$vendor->name_en }}</td>

                    <td>{{ @$offer->offertype->offer_type }}</td>
                    <td>{{@$offer->offertype->price_after_discount }}</td>
                    <td>{{@$offer->offertype->discount_value }}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$client->name}}</td>
                    <td>{{$client->phone}}</td>

                    @if($client->birth_date != null)
                    <td>{{ \Carbon\Carbon::parse($client->birth_date)->age}}</td>
                    @else
                    <td>-</td>
                    @endif
                    <td>@if($item->gender == 1) male @elseif($item->gender == 2) female @else - @endif</td>
                    <td>{{ App\Models\Branch::find($item->branch_id)->name_en }}</td>
                    <td>{{ $item->refreance_number }}</td>

                   
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
