@extends('layout.default')
@section('content')
<div class="card card-docs mb-2">
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <div class="card-header">
          
               
            <ol class="breadcrumb">
                <li><a href="/{{ get_lang() }}/home"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
                
                <li class="active">{{ __('Vendors') }}</li>
            </ol>
        
        </div> 
        <div class="form-group col-md-3">
            <input type="text" name="serach" id="serach" placeholder="search" class="form-control" />
        </div>

       @include('dashboard.pefounds.pagination_data')


    </div>
</div>

@endsection

@section('styles')

 @endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{asset('crudjs/crud.js')}}"></script>
 <script>
    
    function performdelete(id) {
        var url = '{{ route('subscription.destroy',[ ":id" ,'locale'=>app()->getLocale()]) }}';
        url = url.replace(':id', id);


        confirmDestroy(url)
    }
    function fetch_data(page, query) {
                        $.ajax({
                            url: "/en/perfomed_fetch_data?page=" + page + "&query=" + query,
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