@extends('layout.default')
@section('styles')
<style>
    #loading_par {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 100;
  width: 65vw;
  height: 100vh;
  display: none;
  background-image: url("https://i.stack.imgur.com/MnyxU.gif");
  background-repeat: no-repeat;
  background-position: center;}
</style>
<style>
    .switchh {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }
    
    .switchh input { 
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    
    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }
    
    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }
    
    .slider.round:before {
      border-radius: 50%;
    }
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
                        <div id="loading_par"></div>

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
                                        
                                        
                                         @include('dashboard.vendor.pagination_data')

                                        
                                     
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
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
                    beforeSend : function(){
                    $('#loading_par').show();
                    },
                    success: function(data) {
                        $('#loading_par').hide();

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
            $('.switchh').change(function () {
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
