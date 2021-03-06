@extends('layout.default')

@section('content')
    <div class="card card-custom">

        <div class="card-header">
          
            <ol class="breadcrumb">
                <li><a href="/{{ get_lang() }}/home"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
                <li ><a href="{{ route('discount_code.index',get_lang()) }}"><i class="fa fa-dashboard"></i> {{ __('All Discount code') }}</a></li>
                <li class="active"> {{ __('Create Discount code') }}</li>
        
            </ol>
        
        </div>
        <form class="form" method="post" id='create_form' enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{ __('Name ar') }}:</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control form-control-solid"
                            placeholder="Enter Name" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Name en') }}:</label>
                        <input type="text" name="name_en" id="name_en" class="form-control form-control-solid"
                            placeholder="Enter Name" required />
                    </div>
                    <div class="form-group col-md-6 Enterprise">
                        <div class="Enterprise">
                            <label>{{ __('Choose the package') }}:</label>
                            <select class="form-control form-control-solid enterprise" name="sub_id" id="sub_id">
                                @foreach ($subs as $item)


                                    <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="form-group col-md-6 Enterprise">
                        <div class="Enterprise">
                            <label>{{ __('Type') }}:</label>
                            <select class="form-control form-control-solid enterprise" name="type" id="type">
                                <option value="" selected disabled>{{ __('chose option') }}</option>

                                <option value="single">{{ __('single') }}</option>
                                <option value="multi">{{ __('multi') }}</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group col-md-6 typecode">
                        <div class="Enterprise">
                            <label>{{ __('type of code') }}:</label>
                            <select class="form-control form-control-solid enterprise" name="type_code" id="type_code">
                                <option value="" selected disabled>{{ __('chose option') }}</option>

                                <option value="auto">{{ __('auto') }}</option>
                                <option value="manual">{{ __('manual') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 code" style="display: none">
                        <div class="code">
                            <label>{{ __('code') }}:</label>
                            <input type="text" name="code" class="form-control" id="code">
                        </div>
                    </div>
                    <div class="form-group col-md-6 codenumber" style="display: none">
                        <label>{{ __('number of code') }}</label>
                        <input type="text" class="form-control form-control-solid form-control-lg" name="number_of_code"
                            id="number_of_code" placeholder="number of code" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 Enterprise">
                        <div class="Enterprise">
                            <label>{{ __('Typeof limit') }}:</label>
                            <select class="form-control form-control-solid enterprise" name="type_of_limit"
                                id="type_of_limit">
                                <option value="" selected disabled>{{ __('chose option') }}</option>

                                <option value="limit">{{ __('limit') }}</option>
                                <option value="unlimit">{{ __('unlimit') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 limit_value" style="display: none">
                        <div class="value">
                            <label>{{ __('Value') }}</label>
                            <br>
                            <input type="number" class="form-control form-control-solid form-control-lg" name="value"
                                id="value" placeholder="value" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 Enterprise">
                        <div class="Enterprise">
                            <label>{{ __('Discount Type') }}:</label>
                            <select class="form-control form-control-solid enterprise" name="type_discount"
                                id="type_discount">
                                <option value="" selected disabled>{{ __('chose option') }}</option>

                                <option value="percentage">{{ __('percentage') }}</option>
                                <option value="fixed">{{ __('fixed') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 ">
                        <div class="value">
                            <label>{{ __('Discount Value') }}</label>
                            <br>
                            <input type="number" class="form-control form-control-solid form-control-lg"
                                name="value_discount" id="value_discount" placeholder="value" />
                        </div>
                    </div>
                </div>
                <div class="row timelimit">
                    <div class="form-group col-md-6">
                        <label>{{ __('Start date') }}</label>
                        <input type="date" class="form-control form-control-solid form-control-lg" name="start_at"
                            id="start_time" placeholder="start_time" />
                    </div>
                    <!--end::Input-->
                    <!--begin::Input-->
                    <div class="form-group col-md-6">
                        <label>{{ __('End date') }}</label>
                        <input type="date" class="form-control form-control-solid form-control-lg" name="end_time"
                            id="end_time" placeholder="end_time" />
                    </div>
                </div>






                <div class="card-footer">
                    <button type="button" onclick="performStore()" class="btn btn-primary mr-2">Submit</button>
                </div>

        </form>
    </div>
    </div>
@endsection


@section('scripts')
    <script>
        $('#type').on('change', function() {

            var type = $('#type').val();

            var typeOfCode = $('#type_code').val();
            if (type == 'multi') {
                $('.codenumber').css("display", "block")
                $('.typecode').css("display", "none");
                $('.code').css("display", "none");

                

            } else {
                $('.codenumber').css("display", "none")
                $('.typecode').css("display", "block")

            }


        });
        $('#type_code').on('change', function() {

            var type = $('#type').val();
            var typeOfCode = $('#type_code').val();

            if (type == 'single' && typeOfCode == 'manual') {
                $('.code').css("display", "block")
                $('.codenumber').css("display", "none")

            } else if (type == 'multi') {
                $('.codenumber').css("display", "none")
                $('.typecode').css("display", "none")

            } else {
                $('.code').css("display", "none")
                $('.codenumber').css("display", "block")

            }

        });
        $('#type_of_limit').on('change', function() {

            var type = $('#type_of_limit').val();

            if (type == 'limit') {
                $('.limit_value').css("display", "flex")

            } else {
                $('.limit_value').css("display", "none")

            }

        });
    </script>



    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script>
       

        function performStore() {
            let formData = new FormData();

            formData.append('name_ar', document.getElementById('name_ar').value);
            formData.append('name_en', document.getElementById('name_en').value);
            formData.append('sub_id', document.getElementById('sub_id').value);
            formData.append('type', document.getElementById('type').value);
            formData.append('type_code', document.getElementById('type_code').value);
            formData.append('type_of_limit', document.getElementById('type_of_limit').value);
            formData.append('start_time', document.getElementById('start_time').value);
            formData.append('end_time', document.getElementById('end_time').value);
            formData.append('type_discount', document.getElementById('type_discount').value);
            formData.append('value_discount', document.getElementById('value_discount').value);



            if (document.getElementById('value') != null) {
                formData.append('value', document.getElementById('value').value);
            }
            if (document.getElementById('number_of_code') != null) {

                formData.append('number_of_code', document.getElementById('number_of_code').value);
            }
            if (document.getElementById('code') != null) {

                formData.append('code', document.getElementById('code').value);
            }




            store("{{ route('discount_code.store', ['locale' => app()->getLocale()]) }}", formData);

        }
    </script>
@endsection
