@extends('layout.default')
@section('styles')
<style>
    #loading {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 100;
  width: 100vw;
  height: 100vh;
  background-color: rgba(192, 192, 192, 0.5);
  background-image: url("https://i.stack.imgur.com/MnyxU.gif");
  background-repeat: no-repeat;
  background-position: center;}
</style>

@endsection
@section('content')

    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Profile 2-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->

                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">

                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Brands</span>
                            </h3>
                            @if (auth()->user()->isAbleTo(['create-vendor']))
                                <div class="card-toolbar">
                                    <a href="{{ route('vendor.create', ['locale' => app()->getLocale()]) }}"
                                        class="btn btn-info font-weight-bolder font-size-sm">New Brands</a>
                                </div>
                            @endif
                        </div>
                        <div id="loading"></div>

                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-0">
                            <!--begin::Table-->
                            <div class="card card-custom gutter-b">
                                <div class="card-body">
                                    <div class="form-group col-md-3">
                                        <input type="text" name="serach" id="serach" placeholder="search" class="form-control" />
                                       </div>
                                    <!--begin::Details-->
                                        <table class="table table-striped table-bordered">
                                    
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800">
                                                <th class="pr-0 text-center">{{ __('image') }}</th>
                                                <th class="pr-0 text-center">{{ __('name') }}</th>
                                                {{-- <th class="pr-0 text-center">{{ __('Email') }}</th> --}}
                                                {{-- <th>{{ __('commercial_registration_number') }}</th> --}}
                                                {{-- <th class="pr-0 text-center">{{ __('Phone') }}</th> --}}
                                                <th class="pr-0 text-center">{{ __('Branch number') }}</th>
                                                <th class="pr-0 text-center">{{ __('Category') }}</th>
                                                <th class="pr-0 text-center">{{ __('Created at') }}</th>
                                                <th class="pr-0 text-center">{{ __('Status') }}</th>
                                                <th class="pr-0 text-center">{{ __('Action') }}</th>

                                            </tr>
                                        </thead>
                                        
                                         @include('dashboard.vendor.pagination_data')

                                        
                                        <div class="modal fase" id="myModal" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        
                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                            {{ __('Categories') }}</h5>

                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div id="addToCart-modal-body">
                                                        <div class="c-preloader text-center p-3">
                                                            <i class="las la-spinner la-spin la-3x"></i>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn ok">Ok</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fase" id="myModaluser" data-backdrop="static"
                                        data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    
                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                        {{ __('create user') }}</h5>

                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div id="addToCart-modal-body-user">
                                                    <div class="c-preloader text-center p-3">
                                                        <i class="las la-spinner la-spin la-3x"></i>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn ok">Ok</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    </table>
                                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Advance Table Widget 5-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Profile 2-->
            </div>
            <!--end::Container-->
        </div>
    @endsection
    @section('scripts')
        <script>
            $(function() {

            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="{{ asset('crudjs/crud.js') }}"></script>
        <script>
            function performdelete(id) {
                var url = '{{ route('vendor.destroy', [':id', 'locale' => app()->getLocale()]) }}';
                url = url.replace(':id', id);


                confirmDestroy(url)
            }
        </script>
        <script>
            function make(id) {
                $("#myModal").show();

                // $('#staticBackdrop').modal();
                $('.c-preloader').show();

                $.ajax({
                    type: 'post',
                    url: "{{ route('showpostModal', app()->getLocale()) }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': id
                    },

                    success: function(data) {

                        $('#addToCart-modal-body').html(data);


                    }
                });

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
                        'id': id
                    },

                    success: function(data) {

                        $('#addToCart-modal-body-user').html(data);


                    }
                });

            }
        </script>
        <script>
            $(document).ready(function(){
            $('.js-switch').change(function () {
                let status = $(this).prop('checked') === true ? 'active' : 'deactive';
                let userId = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('vednor.update.status',app()->getLocale()) }}',
                    data: {'status': status, 'user_id': userId},
                    success: function (data) {
                        console.log(data.message);
                    }
                });
            });
        });
        function fetch_data(page,  query)
            {
            $.ajax({
            url:"/en/vendors/fetch_data?page="+page+"&query="+query,
            success:function(data)
            {
                
                $('tbody').html('');
                $('tbody').html(data);
            }
            })
            }
            $(document).on('keyup', '#serach', function(){
            var query = $('#serach').val();
    
            var page = $('#hidden_page').val();
            fetch_data(page, query);
            });
            $(document).on('click', '.pagination a', function(event){
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
