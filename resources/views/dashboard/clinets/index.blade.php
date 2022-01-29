@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All Users') }}</h2>


            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('email') }}</th>
                        <th>{{ __('last Login Date') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($type == 'subs')
                    @foreach ($clinets as $item)
                    
                        <td>{{ $item->client->name }}</td>
                        <td>{{ $item->client->phone }}</td>
                        <td>{{ $item->client->email }}</td>
                        <td>{{ $item->client->last_login }}</td>
                         <td class="pr-0 text-left">



                            <a href="{{ route('clinets.show', [app()->getLocale(), $item->client->id]) }}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <i class="fa fa-eye"> </i>
                            </a>




                        </td> 
                        </tr>
                    @endforeach
                    @elseif($type == 'client')
                    @foreach ($clinets as $item)
                    
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->last_login }}</td>
                     <td class="pr-0 text-left">



                        <a href="{{ route('clinets.show', [app()->getLocale(), $item->id]) }}"
                            class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                            <i class="fa fa-eye"> </i>
                        </a>




                    </td> 
                    </tr>
                @endforeach
                @endif

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
