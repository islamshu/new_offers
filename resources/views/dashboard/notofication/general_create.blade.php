@extends('layout.default')

@section('content')
    <div class="card card-custom">

        <div class="card-header">
            <h3 class="card-title">
                {{ __('Create General Notofication') }}
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
                    <div class="form-group col-md-6">
                        <label>{{ __('Title ar') }}:</label>
                        <input type="text" name="title_ar" id="title_ar" class="form-control form-control-solid"
                            placeholder="{{ __('title ar') }}" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Title en') }}:</label>
                        <input type="text" name="title_en" id="title_en" class="form-control form-control-solid"
                            placeholder="{{ __('title en') }}" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('body ar') }}:</label>
                        <textarea name="body_ar" class="form-control form-control-solid" id="body_ar"  rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('body en') }}:</label>
                        <textarea name="body_en" class="form-control form-control-solid" id="body_en"  rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Type') }}:</label>
                        <select name="type" id="type" class="form-control">
                            <option value="" selected disabled>{{ __('Choose') }}</option>
                            <option value="brand" >{{ __('brand') }}</option>
                            <option value="offer" >{{ __('offer') }}</option>
                            <option value="nothing" >{{ __('nothing') }}</option>
                        </select>

                    </div>
                    <div class="form-group col-md-6 vendor"style="display: none">
                        <label>{{ __('Choose Vendor') }}:</label>
                        <select name="type" id="type" class="form-control">
                            <option value="" selected disabled>{{ __('Choose') }}</option>
                            @foreach ($vendors as $item)
                            <option value="{{ $item->id }}" >{{ $item->name_en }}</option>

                            @endforeach
                           
                        </select>

                    </div>
                    <div class="form-group col-md-6 offer" style="display: none">
                        <label>{{ __('Choose Offer') }}:</label>
                        <select name="type" id="type" class="form-control">
                            <option value="" selected disabled>{{ __('Offer') }}</option>
                            @foreach ($offers as $item)
                            <option value="{{ $item->id }}" >{{ $item->name_en }}</option>

                            @endforeach
                           
                        </select>

                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Mobile Type') }}:</label>
                        <select name="mobile_type" id="mobile_type" class="form-control">
                            <option value="" selected disabled>{{ __('Choose') }}</option>
                            <option value="ios" >{{ __('ios') }}</option>
                            <option value="android" >{{ __('android') }}</option>
                            <option value="all" >{{ __('all') }}</option>
                        </select>

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

            if (type == 'brand') {
                $('.vendor').css("display", "block")
                $('.offer').css("display", "none")

            } else if(type == 'offer') {
                $('.offer').css("display", "block")
                $('.vendor').css("display", "none")
            }else{
                $('.offer').css("display", "none")
                $('.vendor').css("display", "none")
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

            formData.append('title_en', document.getElementById('title_en').value);
            formData.append('title_ar', document.getElementById('title_ar').value);
            formData.append('body_en', document.getElementById('body_en').value);
            formData.append('body_ar', document.getElementById('body_ar').value);
            formData.append('type', document.getElementById('type').value);
            formData.append('mobile_type', document.getElementById('mobile_type').value);


            if (document.getElementById('vendor_id') != null) {
                formData.append('vendor_id', document.getElementById('vendor_id').value);
            }
            if (document.getElementById('offer_id') != null) {
                formData.append('offer_id', document.getElementById('offer_id').value);
            }
            

            store("{{ route('general_notofication.store', ['locale' => app()->getLocale()]) }}", formData);

        }
    </script>
@endsection
