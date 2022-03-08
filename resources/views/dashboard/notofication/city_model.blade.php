<form class="form" method="post" action="{{ route('send_client_notofication',[app()->getLocale(),$city->id]) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="client_id" value="{{ $city->id }}">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Title ar') }} :</label>
                <input type="text" name="title_ar" id="title" class="form-control form-control-solid"
                    placeholder="{{ __('Title') }}" required />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Title en') }} :</label>
                <input type="text" name="title_en" id="title" class="form-control form-control-solid"
                    placeholder="{{ __('Title') }}" required />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Body') }} :</label>
         
                    <textarea name="body" id="body" required class="form-control form-control-solid" cols="10" rows="5"></textarea>
            </div>
        </div>
        <div class="form-group col-md-6 vendor">
            <label>{{ __('Choose Vendor') }}:</label>
            <select name="type" id="vendor_id" class="form-control">
                <option value="" selected disabled>{{ __('Choose') }}</option>
                @foreach ($vendors as $item)
                <option value="{{ $item->id }}" >{{ $item->name_en }}</option>

                @endforeach
               
            </select>

        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <input type="submit"  class="form-control btn btn-primary" value="{{ __('Submit') }}"
                  />
            </div>
        </div>
    </div>
</form>