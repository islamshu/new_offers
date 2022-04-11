@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <div class="card-header">

                <ol class="breadcrumb">
                    <li><a href="/{{ get_lang() }}/home"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
                    <li class="active"> {{ __('All Discount Code') }}</li>

                </ol>

            </div>
            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>{{ __('code') }}</th>
                        <th>{{ __('total') }}</th>
                        <th>{{ __('total usage') }}</th>
                        <th>{{ __('User Usage this') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($codes as $item)
                        @php
                            $dis = App\Models\Discount::find($item->discount_id);
                        @endphp
                        <tr>
                            <td>{{ $item->code }}</td>
                            <td>{{ $dis->value }}</td>
                            <td>{{ App\Models\PromocodeUser::where('promocode', $item->code)->count() }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#myModal" class="btn btn-outline-primary"
                                onclick="make('{{  $item->code }}')"><i class="fa fa-eye"></i></a></td>
                            
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fase" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 123%;">
            <div class="modal-header">

                <h5 class="modal-title" id="staticBackdropLabel">
                    {{ __('User') }}</h5>
                


               
            </div>
            

            <div id="addToCart-modal-body">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('styles')
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script>
        function make(promocode) {
            $("#myModal").show();

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'get',
                url: "{{ route('showCodesUser', app()->getLocale()) }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'promo': promocode
                },

                success: function(data) {
                    $('#addToCart-modal-body').html(data);

                }
            });

        }
    </script>
    <script>
        function performdelete(id) {
            var url = '{{ route('discount_code.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.js-switch').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('discount.update_status', app()->getLocale()) }}',
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.message);
                    }
                });
            });
        });
    </script>
@endsection
