@extends('layout.default')
@section('styles')
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #abb9ac;
        }

    </style>
@endsection
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All Users') }}</h2>
            <div class="card-header">
          
               
                <ol class="breadcrumb">
                    <li><a href="/{{ get_lang() }}/home"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
                    <li><a href="/{{ get_lang() }}/all_client"><i class="fa fa-dashboard"></i> {{ __('All Clients') }}</a></li>

                    <li class="active">{{ __('All ') }} {{ $type }} {{ 'client' }}</li>
                </ol>
            
            </div> 
    

            @if (Session::has('success'))
                <div class="row mr-2 ml-2">
                    <button type="text" class="btn btn-lg btn-block btn-outline-success btn-success white mb-2"
                        id="type-error">{{ Session::get('success') }}
                    </button>
                </div>
            @endif
            <form action="{{ route('show_clients',[app()->getLocale(),$type]) }}" method="get">
                <div class="row">
                    <div class="input-group col-md-5 mb-3">
                        <div class="input-group-prepend" style="display:block">
                            <label class="input-group-text" for="inputGroupSelect01">
                                Register From
                            </label>
                        </div>
                      <input type="date" value="{{ $request->regestar_from }}" id="regestar_from" placeholder="Created From" class="form-control" name="regestar_from">
                    </div>
                   
                    <div class="input-group col-md-5 mb-3">
                        <div class="input-group-prepend" style="display:block">
                            <label class="input-group-text" for="inputGroupSelect01">
                                Register To
                            </label>
                        </div>
                      <input type="date" value="{{ $request->regestar_to }}" id="regestar_to" placeholder="Created To" class="form-control" name="regestar_to">
                    </div>

                    {{-- <div class="input-group col-md-5 mb-3">
                        <div class="input-group-prepend" style="display:block">
                            <label class="input-group-text" for="inputGroupSelect01">
                                Subscribe From
                            </label>
                        </div>
                      <input type="date" value="{{ $request->subscribe_from }}" id="subscribe_from" placeholder="Created From" class="form-control" name="subscribe_from">
                    </div>
                   
                    <div class="input-group col-md-5 mb-3">
                        <div class="input-group-prepend" style="display:block">
                            <label class="input-group-text" for="inputGroupSelect01">
                                Subscribe To
                            </label>
                        </div>
                      <input type="date" value="{{ $request->subscribe_to }}" id="subscribe_to" placeholder="Created To" class="form-control" name="subscribe_to">
                    </div> --}}
                    <div class="input-group col-md-2">
                        <input type="submit" value="submit" class="form-control btn btn-info" >
                    </div>
            </div>

            </form>

            <div class="form-group col-md-3">
                <input type="text" name="serach" id="serach" placeholder="search" class="form-control" />
                <input type="hidden" name="type" id="type" value="{{ $type }}" />

            </div>

            <div class="set_date">

                @include('dashboard.clinets.pagination_data')
            </div>
           


        </div>
    </div>
    <div class="modal fase" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ __('Send Notofication') }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="addToCart-modal-body">
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
    <div class="modal fase" id="addSub" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ __('Add Subscribe') }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="addToCart-modal-body_sub">
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
        function make(id) {
            $("#myModal").show();

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'post',
                url: "{{ route('send_notification', app()->getLocale()) }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },

                success: function(data) {

                    $('#addToCart-modal-body').html(data);


                }
            });

        }
        function makenew_fun(id) {
            $("#addSub").show();

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'post',
                url: "{{ route('add_sub_to_client', app()->getLocale()) }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },

                success: function(data) {

                    $('#addToCart-modal-body_sub').html(data);


                }
            });

        }


        

        function performdelete(id) {
            var url = '{{ route('offers.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }

        function fetch_data(page, query) {
            var type = $('#type').val();
            var regestar_from = $('#regestar_from').val();
            var regestar_to = $('#regestar_to').val();
                $.ajax({
                    url:"/{{ get_lang() }}/get_type_client?page=" + page + "&query=" + query,
                    data: {
                    'type': type,
                    'regestar_from': regestar_from,
                    'regestar_to': regestar_to,
                },
                    success: function(data) {

                        $('.set_date').html('');
                        $('.set_date').html(data);
                    }
                })
            }
            $(document).on('keyup', '#serach', function() {
                var query = $('#serach').val();

                var page = $('#hidden_page').val();
                fetch_data(page, query);
            });
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);


                var query = $('#serach').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, query);
            });
    </script>
@endsection
