

<form class="form" method="post" action="{{ route('importBranch',[app()->getLocale(),$vendor->id]) }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Title') }} :</label>
                <input type="text" name="title" id="title" class="form-control form-control-solid"
                    placeholder="{{ __('Title') }}" required />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Body') }} :</label>
                <input type="text" name="body" id="body" class="form-control form-control-solid"
                    placeholder="{{ __('Body') }}" required />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <input type="submit"  class="form-control btn btn-primary" value="{{ __('Submit') }}"
                  />
            </div>
        </div>
    </div>
</form>