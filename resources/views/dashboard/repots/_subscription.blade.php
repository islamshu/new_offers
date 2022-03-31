@extends('layout.default')

@section('content')
@php
    $lang = app()->getLocale();
@endphp
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Subscription users') }}
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    
</div>
<div class="card card-docs mb-2">
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">


        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
            id="kt_datatablenew">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">

                    <th>{{ __('username') }}</th>
                    <th>{{ __('email') }}</th>
                    <th>{{ __('phone') }}</th>
                    <th>{{ __('pakege name') }}</th>
                    <th>{{ __('price') }}</th>
                    <th>{{ __('created at') }}</th>
            
                </tr>
            </thead>
            <tbody>
                @foreach ($subs as $item)
                    <td>{{ @$item->client->name }}</td>

                    <td>{{@$item->client->email }}</td>
                    <td>{{@$item->client->phone }}</td>
                    <td>{{@$item->subscripe->name_en}}</td>
                    <td>{{@$item->paid}}</td>
                    <td>{{@$item->created_at}}</td>
                    

                   
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
<script>
    $(function() {
        $("#kt_datatablenew").DataTable({
            // "pagingType": "full_numbers",
            "scrollX": true

        });
    });
</script>
@endsection
