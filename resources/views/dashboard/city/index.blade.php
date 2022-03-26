@extends('layout.default')
@section('content')
<div class="
card card-docs mb-2">
    
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('All Cities') }}
        </h3>

        <ol class="breadcrumb">
            <li><a href="/{{ get_lang() }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li class="active">{{ __('All Cities') }}</li>
        </ol>

    </div>
        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
            id="kt_datatable">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th>{{ __('Name ar') }}</th>
                    <th>{{ __('Name en') }}</th>
                    <th>{{ __('latitude') }}</th>
                    <th>{{ __('longitude') }}</th>
                    <th>{{ __('Country') }}</th>
                    <th>{{ __('City') }}</th>
                    {{-- <th>Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($cities as $item)
                
                
                 <tr>
                     {{-- {{ dd($item) }} --}}
                     @if(auth()->user()->hasRole('Enterprises') || auth()->user()->hasPermission('read-city'))
                   
                    <td>{{@$item->city->city_name}}</td>
                    <td>{{@$item->city->city_name_english}}</td>
                    <td>{{@$item->city->lat}}</td>
                    <td>{{@$item->city->lng}}</td>
                    <td>{{@$item->city->country->country_name_en}}</td>
                    <td>
                        <input type="checkbox" data-id="{{ $item->id }}" name="status" class="js-switch" {{ $item->status == 'active' ? 'checked' : '' }}>
                        </td>
                    </tr>
                    @else
                    <td>{{$item->city_name}}</td>
                    <td>{{$item->city_name_english}}</td>
                    <td>{{$item->lat}}</td>
                    <td>{{$item->lng}}</td>
                    <td>{{@$item->country->country_name_en}}</td>
                    <td>
                        <input type="checkbox" data-id="{{ $item->id }}" name="status" class="js-switch" {{ $item->status == 'active' ? 'checked' : '' }}>
                        </td>
                    </tr>
                    @endif
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
    $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 'active' : 'deactive';
        let id = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('enter_pricecity.update_status',app()->getLocale()) }}',
            data: {'status': status, 'id': id},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
});
</script>
@endsection