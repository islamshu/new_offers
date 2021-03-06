@extends('layout.default')
<style>
    .dropdown-menu show{
        top: 157px !important;
}
</style>
@section('content')

    <div class="card card-custom">

        <div class="card-header">
          
        
            <ol class="breadcrumb">
                <li><a href="/{{ get_lang() }}/home"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
                <li><a href="{{ route('general_notofication.index',get_lang()) }}"><i class="fa fa-dashboard"></i> {{ __('Notofication') }}</a></li>

                <li class="active">{{ __('Create Custom Notofication') }}</li>
            </ol>
        
        </div> 
        @if(Session::has('success'))
        <div class="row mr-2 ml-2">
    
                <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"
                        id="type-error">{{Session::get('success')}}
                </button>
        </div>
    @endif
        <form class="form" method="post" action="{{ route('create_custom_notofication_post',get_lang()) }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 vendor">
                        <label>{{ __('Choose Vendor') }}:</label>
                        <style>
                            .dropdown-menu{
                                top: 20px !important
                            }
                        </style>
                        <select name="vendor_id" id="vendor_id " class="selectpicker form-control"
                        data-live-search="true">
                            <option value="" selected disabled>{{ __('Choose') }}</option>
                            @foreach ($vendors as $item)
                                <option value="{{ $item->id }}">
                                    @if(get_lang() == 'ar')
                                    {{ $item->name_ar }} 
                                @else
                                {{ $item->name_en }} 
                                @endif
                            </option>
                            @endforeach

                        </select>

                    </div>
                    <div class="form-group col-md-6 offer">
                        <label>{{ __('Choose Offer') }}:</label>
                        <select name="offer_id" id="offer_id " class=" form-control">
                            <option value="" selected disabled>{{ __('Offer') }}</option>


                        </select>

                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Register form') }}:</label>
                        <input type="date" name="register_from" id="register_from" class="form-control form-control-solid get_client"
                            placeholder="{{ __('Register form') }}"  />
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Register to') }}:</label>
                        <input type="date" name="register_to" id="register_to" class="form-control form-control-solid get_client"
                            placeholder="{{ __('Register to') }}"  />
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ __('Transaction number from') }}:</label>
                        <input type="number" name="tra_form" id="tra_form" class="form-control form-control-solid get_client"
                            placeholder="{{ __('Transaction number from') }}"  />
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ __('Transaction number to') }}:</label>
                        <input type="number" name="tra_to" id="tra_to" class="form-control form-control-solid get_client"
                            placeholder="{{ __('Transaction number to') }}"  />
                    </div>
                    <div class="form-group col-md-6 ">
                        <label>{{ __('Choose type') }}:</label>
                        <select name="type" id="type"  class=" form-control get_client">
                            <option value="" selected disabled>{{ __('choose') }}</option>
                            <option value="">ALL</option>
                            <option value="PREMIUM">PREMIUM</option>
                            <option value="FREE">FREE</option>
                            <option value="TRIAL">TRIAL</option>
                            <option value="Expir_premium">Expire PREMIUM</option>
                        </select>

                    </div>

                    <div class="form-group col-md-6">
                        <label>{{ __('Title ar') }}:</label>
                        <input type="text" name="title_ar" id="title_ar" class="form-control form-control-solid "
                            placeholder="{{ __('title ar') }}" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Title en') }}:</label>
                        <input type="text" name="title_en" id="title_en" class="form-control form-control-solid "
                            placeholder="{{ __('title en') }}" required />
                    </div>
                   
                    <div class="form-group col-md-6">
                        <label>{{ __('body ar') }}:</label>
                        <textarea name="body_ar" class="form-control form-control-solid" id="body_ar" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('body en') }}:</label>
                        <textarea name="body_en" class="form-control form-control-solid" id="body_en" rows="3"></textarea>
                    </div>

                  

                 

                </div>
                number of client <span class="number_client"></span>





                <div class="card-footer">
                    <button type="submit"  class="btn btn-primary mr-2">Submit</button>
                </div>

        </form>
    </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {


            $('.get_client').on('change', function() {

            var type = $('#type').val();
            var register_from = $('#register_from').val();
            var register_to = $('#register_to').val();
            var tra_to = $('#tra_to').val();
            var tra_form = $('#tra_form').val();
            $.ajax({
                    type: 'get',
                    url: "{{ route('get_count', ['locale' => app()->getLocale()]) }}",
                    data: {
                        'type': type,'register_from':register_from,'register_to':register_to,'tra_to':tra_to,'tra_form':tra_form
                    },
                    success: function(data) {
                        $('.number_client').empty();

                        $('.number_client').append(data);
                        
                    }
                });
            });
            $('#vendor_id').on('change', function() {
                // console.log("hmm its change");
                var cat_id = $(this).val();
                // console.log(cat_id);
                var div = $(this).parent();

                var op = " ";

                $.ajax({
                    type: 'get',
                    url: "{{ route('get_offer_ajax', ['locale' => app()->getLocale()]) }}",
                    data: {
                        'venodr_id': cat_id
                    },
                    success: function(data) {
                        $('#offer_id').html(new Option('choose', '', 'disabled', 'selected'));
                        for (var i = 0; i < data.length; i++) {

                            $('#offer_id').append(new Option(data[i].name_en,
                                data[i].id));

                        }
                    },
                    error: function() {

                    }
                });

            });
        });
        $('#type').on('change', function() {

            var type = $('#type').val();

            if (type == 'brand') {
                $('.vendor').css("display", "block")
                $('.offer').css("display", "none")

            } else if (type == 'offer') {
                $('.offer').css("display", "block")
                $('.vendor').css("display", "none")
            } else {
                $('.offer').css("display", "none")
                $('.vendor').css("display", "none")
            }


        });
    </script>



    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="{{ asset('crudjs/crud.js') }}"></script>
    
@endsection
