@extends('layout.default')
@section('content')
    <div class="
card card-docs mb-2">

        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">All Branches</h2>
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="form-group col-md-3">
                        <input type="text" name="serach" id="serach" placeholder="search" class="form-control" />
                    </div>
            <div class="set_date">

                @include('dashboard.branch.pagination_data')
            </div>

        </div>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
    <script src="{{ asset('/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script>


    </script>
    <script>
        function make(id) {
            $("#myModal").show();

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'post',
                url: "{{ route('showpostModalBranch', app()->getLocale()) }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },

                success: function(data) {

                    $('#addToCart-modal-body').html(data);


                }
            });

        }
    </script>
    <script>
        function performdelete(id) {
            var url = '{{ route('branch.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
        function fetch_data(page,  query)
            {
            $.ajax({
            url:"/en/branch_paginate?page="+page+"&query="+query,
            success:function(data)
            {
                
                $('.set_date').html('');
                $('.set_date').html(data);
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
