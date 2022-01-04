@extends('layout.default')
@section('content')
<div class="
card card-docs mb-2">

    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <h2 class="mb-3">{{ __('All Neighborhoods') }}</h2>

        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
            id="kt_datatable">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th>{{ __('Name ar') }}</th>
                    <th>{{ __('Name en') }}</th>
                    <th>{{ __('Latitude') }}</th>
                    <th>{{ __('Longitude') }}</th>
                    <th>{{ __('City') }}</th>
                 </tr>
            </thead>
            <tbody>
                @foreach ($Neighborhoods as $item)
                    @php
                        $Neighborhood = App\Models\Neighborhood::find($item->neighborhood_id);
                    @endphp
                 <tr>
                    <td>{{@$Neighborhood->neighborhood_name}}</td>
                    <td>{{@$Neighborhood->neighborhood_name_english}}</td>
                    <td>{{@$Neighborhood->lat}}</td>
                    <td>{{@$Neighborhood->lng}}</td>
                    <td>{{@$Neighborhood->city->city_name_english}}</td>

                    </tr>
                    @endforeach


            </tbody>
 
        </table>


    </div>
</div>

@endsection

@section('styles')

<link href="{{asset('/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
<script src="{{ asset('/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script>
    
</script>
@endsection