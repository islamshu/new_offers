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
    <form method="get" action="{{route('offers_reports',['locale'=>app()->getLocale()])}}" id="filter_search">
        
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
                          <input type="date" value="{{ $request->created_form }}" id="created_form" placeholder="Created From" class="form-control" name="created_form">
                        </div>
                       
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Created To
                                </label>
                            </div>
                          <input type="date" value="{{ $request->created_to }}" id="created_to" placeholder=" Created To" class="form-control" name="created_to">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Brand status
                                </label>
                            </div>
                            <select name="vendor_status" id="vendor_status" class="form-control" >
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
                            <select name="offer_status" id="offer_status"  class="form-control" >
                                <option value=""> _ </option>
                                <option value="active"@if($request->offer_status == 'active') selected @endif> active </option>
                                <option value="deactive" @if($request->offer_status == 'deactive') selected @endif> deactive </option>
                            </select>
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    City
                                </label>
                            </div>
                            <select name="city_id" id="city_id" class="form-control" >
                                <option value=""> _ </option>
                                @foreach (App\Models\City::where('status',1)->get() as $item)
                                <option value="{{ $item->id }}" @if($request->city_id == $item->id) selected @endif> {{ $item->city_name }} </option>

                                @endforeach
                            </select>
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Category
                                </label>
                            </div>
                            <select name="category_id" id="category_id"  class="form-control" >
                                <option value=""> _ </option>
                                @foreach (App\Models\Category::where('is_show',1)->get() as $item)
                                <option value="{{ $item->id }}" @if($request->category_id == $item->id) selected @endif> {{ $item->name_en }} </option>

                                @endforeach
                            </select>
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Expired after
                                </label>
                                <input type="number" value="{{ $request->number_date }}" placeholder="Expired after" class="form-control" id="number_date" name="number_date">

                            </div>
                            
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
        <h2 class="mb-3">{{ __('All Offers') }}</h2>

        <div class="form-group col-md-3">
            <input type="text" name="serach" id="serach" placeholder="search" class="form-control" />
        </div>
        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7">
    
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
                    <th>{{ __('Expired / Notexpired') }}</th>
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
                    @if(Carbon\Carbon::now() > $item->end_time)
                    <td> Exprie</td>
                    @else
                    <td> Not Exprie</td>
                    @endif

                    <td>{{ @$item->offertype->price}}</td>
                    <td>{{ @$item->offertype->price_after_discount}}</td>
                    <td>{{ @$item->offertype->discount_value}}</td>
                    <td>{{ @$item->offertype->offer_type}}</td>
                    <td>{{ @App\Models\Transaction::where('offer_id',$item->id)->count() }}</td>
                    <td>{{ get_count_client($item->id) }}</td>

                   
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
<script>
    $(function() {
        $("#kt_datatablenew").DataTable({
            // "pagingType": "full_numbers",
            "scrollX": true

        });
    });
    function fetch_data(page,  query,request)
            {
                var created_form = $('#created_form').val();
                var created_to = $('#created_to').val();
                var vendor_status = $('#vendor_status').val();
                var offer_status = $('#offer_status').val();
                var city_id = $('#city_id').val();
                var category_id = $('#category_id').val();
                var number_date = $('#number_date').val();


            $.ajax({
            url:"/en/offer_reports_fetch_data?page="+page+"&query="+query+"&created_form="+created_form+"&created_to="+created_to+"&vendor_status="+vendor_status+"&offer_status="+offer_status+"&city_id="+city_id+"&category_id="+category_id+"&number_date="+number_date
            success:function(data)
            {
                
                $('.set_date').html('');
                $('.set_date').html(data);
            }
            })
            }
            $(document).on('keyup', '#serach', function(){
            var query = $('#serach').val();
            var request = $("#filter_search").serialize();

            
            var page = $('#hidden_page').val();
            fetch_data(page, query,request);
            });
            $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
  

            var query = $('#serach').val();

            $('li').removeClass('active');
            $(this).parent().addClass('active');
            fetch_data(page, query,request);
            });
</script>
@endsection
