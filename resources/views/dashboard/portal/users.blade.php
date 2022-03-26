@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <div class="card-header">
          
               
                <ol class="breadcrumb">
                    <li><a href="/{{ get_lang() }}/home"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
                    <li><a href="/{{ get_lang() }}/portal"><i class="fa fa-dashboard"></i> {{ __('Portal') }}</a></li>
                    
                    <li class="active">{{ __('All User') }}</li>
                </ol>
            
            </div>            @if (auth()->user()->isAbleTo(['create-portal']))

            <a data-toggle="modal"
            data-target="#myModaluser" class="btn btn-outline-primary"
            onclick="makeuser('{{ $id }}')" 
                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                Add User
            </a>
            @endif

            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('username') }}</th>
                        <th>{{ __('email') }}</th>
                        <th>{{ __('Is Primary') }}</th>

                        <th>{{ __('status') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <td>{{ $user->username }}</td>

                        <td>{{ $user->email }}</td>
                        <td>
                            <input type="checkbox" data-id="{{ $user->id }}" name="is_primary" class="js-switch switch2" @if($user->is_priamry == 1 ) checked @endif >
                            </td>
                        <td>
                        <input type="checkbox" data-id="{{ $user->id }}" name="status" class="js-switch switch1" @if($user->status == 1 ) checked @endif >
                        </td>
                        <td class="pr-0 text-left">

                            @if (auth()->user()->isAbleTo(['update-portal']))

                            <a data-toggle="modal"
                            data-target="#updetusermodel" class="btn btn-outline-primary"
                            onclick="updateuser('{{ $user->id }}')" 
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <i class="fa fa-user"></i>
                            </a>
                            @endif


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
          $('.switch1').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let userid = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('userpand.update',app()->getLocale()) }}',
            data: {'status': status, 'user_id': userid},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
    $('.switch2').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let userid = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('set_Primary.update',app()->getLocale()) }}',
            data: {'status': status, 'user_id': userid,'vendor_id':{{ $id }}},
            success: function (data) {
                location.reload()
            }
        });
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
                    url: "{{ route('showmodeluser', app()->getLocale()) }}",
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
                    url: "{{ route('updateuser', app()->getLocale()) }}",
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
