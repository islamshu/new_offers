@extends('layout.default')

@section('content')
@php
    $lang = app()->getLocale();
@endphp
<style>
    .table th, .table td {
    padding: 0.50rem !important;
    vertical-align: top !important;
    border-top: 1px solid #EBEDF3 !important;
}
</style>
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Client admin Repots') }}
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
                          <input type="date" value="{{ $request->register_form }}" id="register_form" placeholder="Registar From" class="form-control" name="register_form">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Registar To
                                </label>
                            </div>
                          <input type="date" value="{{ $request->register_to}}" id="register_to" placeholder="Registar To" class="form-control" name="register_to">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    last subscribe from 
                                </label>
                            </div>
                          <input type="date" value="{{ $request->last_from }}" id="last_from" placeholder="last subscribe from" class="form-control" name="last_from">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    last subscribe to 
                                </label>
                            </div>
                          <input type="date" value="{{ $request->last_to}}" id="last_to" placeholder="last subscribe to " class="form-control" name="last_to">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    transaction from 
                                </label>
                            </div>
                          <input type="date" value="{{ $request->transaction_from }}" id="transaction_from" placeholder="Transaction from " class="form-control" name="transaction_from">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    transaction to 
                                </label>
                            </div>
                          <input type="date" value="{{ $request->transaction_to}}" id="transaction_to" placeholder="Transaction To" class="form-control" name="transaction_to">
                        </div>
                        <div class="input-group col-md-5 mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    Type
                                </label>
                            </div>
                            <select name="type" class="form-control" id="type">
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
        <div class="form-group col-md-3">
            <input type="text" name="serach" id="serach" placeholder="offer name" class="form-control" />
        </div>

        <div class="set_date " style="overflow: scroll;">

            @include('dashboard.repots._clients_admin')
        </div>
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
function fetch_data(page, query) {
            var register_form = $('#register_form').val();
            var register_to = $('#register_to').val();
            var last_from = $('#last_from').val();
            var last_to = $('#last_to').val();
            var transaction_from = $('#transaction_from').val();
            var transaction_to = $('#transaction_to').val();
            var type = $('#type').val();



            $.ajax({
                url:"/{{ get_lang() }}/fetch_data_admin_client?page=" + page + "&query=" + query + "&register_form=" +
                register_form + "&register_to=" + register_to + "&last_from=" + last_from +
                    "&last_to=" + last_to + "&transaction_from=" + transaction_from + "&transaction_to=" + transaction_to +
                    "&type=" + type,
                success: function(data) {

                    $('.set_date').html('');
                    $('.set_date').html(data);
                }
            })
        }
        $(document).on('keyup', '#serach', function() {
            var query = $('#serach').val();
            var request = $("#filter_search").serialize();


            var page = $('#hidden_page').val();
            fetch_data(page, query, request);
        });
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);


            var query = $('#serach').val();

            $('li').removeClass('active');
            $(this).parent().addClass('active');
            fetch_data(page, query);
        });
</script>
@endsection
