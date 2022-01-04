@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All Offer') }}</h2>


            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('City') }}</th>
                        <th>{{ __('last Login Date') }}</th>
                        <th>{{ __('last Action Date') }}</th>
                        <th>{{ __('Type of Subscribe') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clinets as $item)
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->city->city_name_english }}</td>
                        <td>{{  date('d-m-Y', strtotime($item->last_login)) }}</td>
                        <td>{{ __('last Action Date') }}</td>
                        <th>{{ $item->type_of_subscribe }}</th>
                        <td class="pr-0 text-left">



                            <a href="{{ route('clinets.show', [app()->getLocale(), $item->id]) }}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <i class="fa fa-eye"> </i>
                            </a>




                        </td>
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
            var url = '{{ route('offers.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
    </script>
@endsection
