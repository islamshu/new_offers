@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All User') }}</h2>
            <a data-toggle="modal"
            data-target="#myModaluser" class="btn btn-outline-primary"
            onclick="makeuser('{{ $id }}')" 
                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                Add User
            </a>

            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('username') }}</th>
                        <th>{{ __('email') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <td>{{ $user->username }}</td>

                        <td>{{ $user->email }}</td>
                        <td class="pr-0 text-left">


                            <a data-toggle="modal"
                            data-target="#updetusermodel" class="btn btn-outline-primary"
                            onclick="updateuser('{{ $user->id }}')" 
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <i class="fa fa-user"></i>
                            </a>


                        </td>
                        </tr>
                    @endforeach


                </tbody>

            </table>


        </div>
    </div>
    <div class="modal fase" id="myModaluser" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="staticBackdropLabel">
                    {{ __('create user') }}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="addToCart-modal-body-user">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn ok">Ok</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fase" id="updetusermodel" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="staticBackdropLabel">
                    {{ __('Update user') }}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="addToCart-modal-body-update">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn ok">Ok</button>
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
        $(function() {

        });

        function performdelete(id) {
            var url = '{{ route('user.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
        function makeuser(id) {
                $("#myModaluser").show();

                // $('#staticBackdrop').modal();
                $('.c-preloader').show();

                $.ajax({
                    type: 'post',
                    url: "{{ route('updateuser', app()->getLocale()) }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': {{ $id }}
                    },

                    success: function(data) {

                        $('#addToCart-modal-body-user').html(data);


                    }
                });

            }
            function updateuser(id) {
                $("#updetusermodel").show();

                // $('#staticBackdrop').modal();
                $('.c-preloader').show();

                $.ajax({
                    type: 'post',
                    url: "{{ route('showmodeluser', app()->getLocale()) }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': id
                    },

                    success: function(data) {

                        $('#addToCart-modal-body-update').html(data);


                    }
                });

            }

            
    </script>
@endsection
