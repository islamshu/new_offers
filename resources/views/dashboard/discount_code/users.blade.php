@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <div class="card-header">

                <ol class="breadcrumb">
                    <li><a href="/{{ get_lang() }}/home"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
                  

                </ol>

            </div>

            <table class="table" style="overflow-y:auto;">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('name') }}</th>
                        <th>{{ __('email') }}</th>
                        <th>{{ __('phone') }}</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ @$user->client->name }}</td>
                        <td>{{ @$user->client->email }}</td>
                        <td>{{ @$user->client->phone }}</td>

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
    
@endsection
