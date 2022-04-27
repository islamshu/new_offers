@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <div class="card-header">


                <ol class="breadcrumb">
                    <li><a href="/{{ get_lang() }}/home"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
                    <li><a href="/{{ get_lang() }}/all_client"><i class="fa fa-dashboard"></i>
                            {{ __('All Clients') }}</a></li>

                </ol>

            </div>

            <h2 class="mb-3">{{ __('All Copuon') }}</h2>



            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('offer name') }}</th>
                        <th>{{ __('vendor name') }}</th>
                        <th>{{ __('branch name') }}</th>
                        <th>{{ __('date') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $lang = app()->getLocale();
                    @endphp
                    @foreach ($offers as $item)
                    <tr>
                        @if ($lang == 'ar')
                        <td>{{ @$item->offer->name_ar }}</td>
                        <td>{{ @$item->vendor->name_ar }}</td>
                        <td>{{ @$item->branch->name_ar }}</td>
                        <td>{{ @$item->created_at }}</td>

                        @else
                        @endif
                        <td>{{ @$item->offer->name_en }}</td>
                        <td>{{ @$item->vendor->name_en }}</td>
                        <td>{{ @$item->branch->name_en }}</td>
                        <td>{{ @$item->created_at }}</td>

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
        $(function() {

        });

        function performdelete(id) {
            var url = '{{ route('coupun.destroy', [':id', 'locale' => app()->getLocale()]) }}';
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
                    url: '{{ route('coupon.update_status', app()->getLocale()) }}',
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
