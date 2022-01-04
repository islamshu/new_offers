@extends('layout.default')
@section('content')
<div class="
card card-docs mb-2">
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <h2 class="mb-3">{{ __('All Cities') }}</h2>
        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
            id="kt_datatable">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th>{{ __('Name ar') }}</th>
                    <th>{{ __('Name en') }}</th>
                    <th>{{ __('latitude') }}</th>
                    <th>{{ __('longitude') }}</th>
                    <th>{{ __('Country') }}</th>
                    {{-- <th>Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($cities as $item)
                 <tr>
=                     @if(Auth::user()->hasRole('Enterprises'))
                     
                    @php
                        $city = App\Models\City::find($item->city_id);
                    @endphp
                    <td>{{@$city->city_name}}</td>
                    <td>{{@$city->city_name_english}}</td>
                    <td>{{@$city->lat}}</td>
                    <td>{{@$city->lng}}</td>
                    <td>{{@$city->country->country_name_en}}</td>
                    @else
                    <td>{{$item->city_name}}</td>
                    <td>{{$item->city_name_english}}</td>
                    <td>{{$item->lat}}</td>
                    <td>{{$item->lng}}</td>
                    <td>{{@$item->country->country_name_en}}</td>
                    @endif
                     {{-- <td><a href="{{route('city.edit',['city'=>1,'locale'=>'en'])}}" class="btn btn-secondary">Edit</a>
                        <form action="">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td> --}}
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