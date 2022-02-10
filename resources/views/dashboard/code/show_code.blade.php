@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All Code') }}</h2>
            {{ dd(Route::currentRouteName()) }}
            <a href="{{ route('export_code',[app()->getLocale(),'used', $code_id]) }}" class="btn btn-primary">{{ __('Export') }}</a>



            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>{{ __('code') }}</th>
                        <th>{{ __('is used') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($codes as $item)
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->is_used == '0' ? 'Not Used' : 'Used' }}</td>
                        </tr>
                    @endforeach


                </tbody>

            </table>


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
        $(document).ready(function(){
        $('.js-switch').change(function () {
            let status = $(this).prop('checked') === true ? 1 : 0 ;
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('code.update_status',app()->getLocale()) }}',
                data: {'status': status, 'id': id},
                success: function (data) {
                    console.log(data.message);
                }
            });
        });
    });
    </script>
    <script>
        $(function() {
            
        });

        function performdelete(id) {
            var url = '{{ route('code.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
    </script>
@endsection
