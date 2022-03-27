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
    <form method="get" action="{{route('offers_reports',['locale'=>app()->getLocale()])}}">
        
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
                                    Created From
                                </label>
                            </div>
                          <input type="date" value="{{ $request->created_form }}" placeholder="Created From" class="form-control" name="created_form">
                        </div>
                       
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Created To
                                </label>
                            </div>
                          <input type="date" value="{{ $request->created_to }}" placeholder=" Created To" class="form-control" name="created_to">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Brand status
                                </label>
                            </div>
                            <select name="vendor_status" class="form-control" >
                                <option value=""> _ </option>
                                <option value="active" @if($request->vendor_status == 'active') selected @endif> active </option>
                                <option value="deactive" @if($request->vendor_status == 'deactive') selected @endif> deactive </option>
                            </select>
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Offer status
                                </label>
                            </div>
                            <select name="offer_status" class="form-control" >
                                <option value=""> _ </option>
                                <option value="active"@if($request->offer_status == 'active') selected @endif> active </option>
                                <option value="deactive" @if($request->offer_status == 'deactive') selected @endif> deactive </option>
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
            >
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th>{{ __('Brand name') }}</th>
                    <th>{{ __('Brand created at') }}</th>
                    <th>{{ __('Brand status') }}</th>
                    <th>{{ __('Offer Count') }}</th>
                    <th>{{ __('offer name') }}</th>
                    <th>{{ __('offer created at') }}</th>
                    <th>{{ __('expired at') }}</th>
                    <th>{{ __('offer status') }}</th>
                    <th>{{ __('price') }}</th>
                    <th>{{ __('price after discount') }}</th>
                    <th>{{ __('percentage discount') }}</th>
                    <th>{{ __('Type') }}</th>
                    <th>{{ __('Buy Count') }}</th>
                    <th>{{ __('client Count') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offers as $item)

                   @if(get_lang() == 'ar')
                    <td>{{ @$item->vendor->name_ar }}</td>
                    @else
                    <td>{{ @$item->vendor->name_en }}</td>
                    @endif


                    <td>{{ @$item->vendor->created_at }}</td>
                    <td>{{ @$item->vendor->status }}</td>
                    <td>{{ @$item->vendor->offers->count() }}</td>
                    @if(get_lang() == 'ar')
                    <td>{{ @$item->name_ar }}</td>
                    @else
                    <td>{{ @$item->name_en }}</td>
                    @endif
                    <td>{{ @$item->created_at }}</td>
                    <td>{{ @$item->end_time }}</td>
                    <td>{{ $item->status == 0 ? 'deactive' :'active' }}</td>
                    <td>{{ @$item->offertype->price}}</td>
                    <td>{{ @$item->offertype->price_after_discount}}</td>
                    <td>{{ @$item->offertype->discount_value}}</td>
                    <td>{{ @$item->offertype->offer_type}}</td>
                    <td>-</td>
                    <td>-</td>

                   
                    </tr>
                @endforeach
           


            </tbody>

        </table>
        {!! $offers->appends(request()->input())->links() !!}


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
