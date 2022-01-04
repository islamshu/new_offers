@extends('layout.default')

@section('content')
    <div class="card card-custom">

        <div class="card-header">
            <h3 class="card-title">
                {{ __('Create Subscribe') }}
            </h3>
            <div class="card-toolbar">
                <div class="example-tools justify-content-center">
                    <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                    <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                </div>
            </div>
        </div>
        <form class="form" method="post" id='create_form' enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    @if (Auth::user()->hasRole('Admin'))
                        <div class="form-group col-md-12 customer_type">
                            <div class="rule">
                                <label>{{ __('Custome Type') }}:</label>
                                <select class="form-control form-control-solid visibility" name="model_type"
                                    id="model_type">
                                    <option value="" selected disabled>{{ __('chose') }}</option>

                                    <option value="enterprice" @if($coupun->model_type == 'enterprice') selected @endif>{{ __('Enterprise') }}</option>
                                    <option value="brands" @if($coupun->model_type == 'brands') selected @endif>{{ __('Brand') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6 Enterprise"  @if($coupun->model_type == 'enterprice') style="display: none" @endif >
                            <div class="Enterprise">
                                <label>{{ __('Enterprise') }}:</label>
                                <select class="form-control form-control-solid enterprise" name="enterprise_id"
                                    id="enterprise_id">
                                    <option value="" selected disabled>{{ __('Chose enterprise') }}</option>

                                    @foreach ($enterprises as $item)
                                        <option value="{{ $item->id }}" @if($coupun->enterprise_id == $item->id) selected @endif>{{ $item->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12" id="brand_ajax"  >
                            <label>{{ __('brand') }}:</label>
                            <select class="city custom-select vendor_id " id="vendor_id" name="vendor_id">
                                @foreach (\App\Models\Vendor::where('enterprise_id',$coupun->enterprise_id)->get() as $item)
                                    <option value="{{ $item->id }}" @if($item->id ==$coupun->vendor_id ) selected @endif>{{ $item->name_en }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    @endif

                    @if (Auth::user()->hasRole('Enterprises'))



                        <div class="form-group col-md-12" id="brand_ajax">
                            <label>{{ __('brand') }}:</label>
                            <select class="city custom-select vendor_id " id="vendor_id" name="vendor_id">
                                <option value="0" disabled="true" selected="true">{{ __('Brand name') }}</option>
                                @foreach ($brands as $item)
                                    <option value="{{ $item->id }}" @if($coupun->vendor_id == $item->id) selected @endif>{{ $item->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="form-group col-md-6">
                        <label>{{ __('Name ar') }}:</label>
                        <input type="text" name="name_ar" id="name_ar" value="{{ $coupun->name_ar }}" class="form-control form-control-solid"
                            placeholder="Enter Name" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Name en') }}:</label>
                        <input type="text" name="name_en" id="name_en" value="{{ $coupun->name_en }}" class="form-control form-control-solid"
                            placeholder="Enter Name" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleTextarea">{{ __('Desc ar') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="desc_ar" rows="3"> {{ $coupun->desc_ar }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleTextarea">{{ __('Desc en') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="desc_en" rows="3">{{ $coupun->desc_en }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleTextarea">{{ __('Terms ar') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="tearm_ar" rows="3">{{ $coupun->tearm_ar }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleTextarea">{{ __('Terms en') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="tearm_en" rows="3">{{ $coupun->tearm_en }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('type') }}:</label>
                        <select class="form-control form-control-solid restricted" name="type" id="type">
                            <option value="amount" @if($coupun->type == 'amount') selected @endif>{{ __('amount') }}</option>
                            <option value="percentage" @if($coupun->type =='percentage') selected @endif>{{ __('percentage') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 trial_class">
                        <label>{{ __('Value') }}:</label>
                        <input type="number" name="value" value="{{ $coupun->value }}" id="value" class="form-control form-control-solid"
                            placeholder="value" required />
                    </div>
                    <div class=" form-group col-md-6 form-group">
                        <label>{{ __('Start time') }}</label>
                        <input type="datetime" value="{{ $coupun->start_at }}" class="form-control form-control-solid form-control-lg" name="start_at"
                            id="start_at" placeholder="start_at" />
                    </div>
                    <!--end::Input-->
                    <!--begin::Input-->
                    <div class="form-group col-md-6 form-group">
                        <label>{{ __('End time') }}</label>
                        <input type="datetime" value="{{ $coupun->end_at }}" class="form-control form-control-solid form-control-lg" name="end_at"
                            id="end_at" placeholder="end_at" />
                    </div>
                   
                    <div class="form-group col-md-6">
                        <div class="rule">
                            <label>{{ __('special days') }}:</label>
                            <select class="form-control form-control-solid restricted" name="special_days"
                                id="special_days">
                                <option value="" disabled selected>{{ __('choose') }}</option>

                                <option value="active" @if($coupun->special_days == 'active') selected @endif>{{ __('active') }}</option>
                                <option value="deactive" @if($coupun->special_days == 'deactive') selected @endif>{{ __('deactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 days" @if($coupun->special_days == 'deactive') style="display: none" @endif >
                        <div class="rule">
                            <label>{{ __('days') }}:</label>
                            
                            <select class="form-control form-control-solid restricted" multiple name="days[]" id="days">
                                <option value="Saturday" @if(in_array('Saturday',json_decode($coupun->days) )) selected @endif >{{ __('Saturday') }}</option>
                                <option value="Sunday" @if(in_array('Sunday', json_decode($coupun->days))) selected @endif >{{ __('Sunday') }}</option>
                                <option value="Monday" @if(in_array('Monday', json_decode($coupun->days))) selected @endif >{{ __('Monday') }}</option>
                                <option value="Tuesday"@if(in_array('Tuesday', json_decode($coupun->days))) selected @endif >{{ __('Tuesday') }}</option>
                                <option value="Wednesday"@if(in_array('Wednesday', json_decode($coupun->days))) selected @endif >{{ __('Wednesday') }}</option>
                                <option value="Thursday"@if(in_array('Thursday', json_decode($coupun->days))) selected @endif >{{ __('Thursday') }}</option>
                                <option value="Friday"@if(in_array('Friday', json_decode($coupun->days))) selected @endif >{{ __('Friday') }}</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="rule">
                            <label>{{ __('special days') }}:</label>
                            <select class="form-control form-control-solid restricted" name="special_time"
                                id="special_time">
                                <option value="" disabled selected>{{ __('choose') }}</option>

                                <option value="active" @if($coupun->special_time == 'active') selected @endif>{{ __('active') }}</option>
                                <option value="deactive" @if($coupun->special_time == 'deactive') selected @endif>{{ __('deactive') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row times"  @if($coupun->special_time == 'deactive') style="display: none" @endif >
                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_0" name="from_0"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_0" name="to_0"
                            placeholder="time to" />
                    </div>

                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_1" name="from_1"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_1" name="to_1"
                            placeholder="time to" />
                    </div>

                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_2" name="from_2"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_2" name="to_2"
                            placeholder="time to" />
                    </div>

                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_3" name="from_3"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_3" name="to_3"
                            placeholder="time to" />
                    </div>

                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_4" name="from_4"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_4" name="to_4"
                            placeholder="time to" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_5" name="from_5"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_5" name="to_5"
                            placeholder="time to" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_6" name="from_6"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_6" name="to_6"
                            placeholder="time to" />
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <div class="image-input image-input-outline" id="kt_image_4"
                        style="background-image:url({{ asset('images/coupun/'.$coupun->image) }})">
                        <div class="image-input-wrapper" style="background-image: url()"></div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="image" id="image" />
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="remove" data-toggle="tooltip" title="Remove avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                </div>

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
       
        $('#enterprise_id').on('change', function() {
            let valenterprice = this.value;
            $.ajax({
                type: "get",
                url: '{{ route('get_brands', app()->getLocale()) }}',
                data: {
                    "enteprice_id": valenterprice
                },
                success: function(data) {

                    $('#brand_ajax').css("display", "block")
                    $('.vendor_id').html(new Option('chose brand', '0'));
                    for (var i = 0; i < data.length; i++) {
                        $('.vendor_id').append(new Option(data[i].name_en,
                            data[i].id));

                    }
                }
            });



        });
        $('#model_type').on('change', function() {
            let val = this.value;
            if (val == 'enterprice') {
                $('.Enterprise').css("display", "block")
                $('.Vendor').css("display", "none")
                $('#brand_ajax').css("display", "block")

            } else if (val == 'brands') {
                $.ajax({
                    type: "get",
                    url: '{{ route('get_brands', app()->getLocale()) }}',
                    data: {
                        "enteprice_id": null
                    },
                    success: function(data) {

                        $('#brand_ajax').css("display", "block")
                        $('.Enterprise').css("display", "none")

                        $('.vendor_id').html(new Option('chose brand', '0'));
                        for (var i = 0; i < data.length; i++) {
                            $('.vendor_id').append(new Option(data[i].name_en,
                                data[i].id));

                        }
                    }
                });

            }

        });
        $('#special_days').on('change', function() {
            let val = this.value;
            if (val == 'active') {
                $('.days').css("display", "block")
            } else if (val == 'deactive') {
                $('.days').css("display", "none")

            }
        });
        $('#special_time').on('change', function() {
            let val = this.value;
            if (val == 'active') {
                $('.times').css("display", "flex")
            } else if (val == 'deactive') {
                $('.times').css("display", "none")

            }
        });
    </script>
    <script>
        var avatar4 = new KTImageInput('kt_image_4');

        avatar4.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Image successfully canceled !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        avatar4.on('change', function(imageInput) {
            swal.fire({
                title: 'Image successfully changed !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        avatar4.on('remove', function(imageInput) {
            swal.fire({
                title: 'Image successfully removed !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Got it!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });
    </script>

    <script>
        $("#type").change(function() {
            var paid = $(this).children("option:selected").val();
            if (paid == "trial") {
                $('.trial_class').show();

            } else if (paid == "paid") {
                $('.trial_class').hide();

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
            formData.append('desc_en', document.getElementById('desc_en').value);
            formData.append('desc_ar', document.getElementById('desc_ar').value);
            formData.append('tearm_ar', document.getElementById('tearm_ar').value);
            formData.append('tearm_en', document.getElementById('tearm_en').value);
            formData.append('special_days', document.getElementById('special_days').value);
            formData.append('special_time', document.getElementById('special_time').value);
            formData.append('type', document.getElementById('type').value);
            formData.append('value', document.getElementById('value').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('vendor_id', document.getElementById('vendor_id').value);

            if (document.getElementById('vendor_id') != null) {

                formData.append('vendor_id', document.getElementById('vendor_id').value);
            }
            if (document.getElementById('days') != null) {
                var value = $('#days').val();
                formData.append('days', JSON.stringify(value));
            }
            if (document.getElementById('start_at') != null) {
                formData.append('start_at', document.getElementById('start_at').value);
            }
            if (document.getElementById('end_at') != null) {
                formData.append('end_at', document.getElementById('end_at').value);
            }
            if (document.getElementById('enterprise_id') != null) {
                formData.append('enterprise_id', document.getElementById('enterprise_id').value);
            }
        

                if (document.getElementById('model_type') != null) {

                    formData.append('model_type', document.getElementById('model_type').value);
                }

                if (document.getElementById('from_0') != null) {
                    formData.append('from_0', document.getElementById('from_0').value);
                }
                if (document.getElementById('from_1') != null) {
                    formData.append('from_1', document.getElementById('from_1').value);
                }
                if (document.getElementById('from_2') != null) {
                    formData.append('from_2', document.getElementById('from_2').value);
                }
                if (document.getElementById('from_3') != null) {
                    formData.append('from_3', document.getElementById('from_3').value);
                }
                if (document.getElementById('from_4') != null) {
                    formData.append('from_4', document.getElementById('from_4').value);
                }
                if (document.getElementById('from_5') != null) {
                    formData.append('from_5', document.getElementById('from_5').value);
                }
                if (document.getElementById('from_6') != null) {
                    formData.append('from_6', document.getElementById('from_6').value);
                }
                if (document.getElementById('to_0') != null) {
                    formData.append('to_0', document.getElementById('to_0').value);
                }
                if (document.getElementById('to_1') != null) {
                    formData.append('to_1', document.getElementById('to_1').value);
                }
                if (document.getElementById('to_2') != null) {
                    formData.append('to_2', document.getElementById('to_2').value);
                }
                if (document.getElementById('to_3') != null) {
                    formData.append('to_3', document.getElementById('to_3').value);
                }
                if (document.getElementById('to_4') != null) {
                    formData.append('to_4', document.getElementById('to_4').value);
                }
                if (document.getElementById('to_5') != null) {
                    formData.append('to_5', document.getElementById('to_5').value);
                }
                if (document.getElementById('to_6') != null) {
                    formData.append('to_6', document.getElementById('to_6').value);
                }
                update("{{ route('update-coupun.coupun', [app()->getLocale() , $coupun->id]) }}", formData);

            }
    </script>
@endsection
