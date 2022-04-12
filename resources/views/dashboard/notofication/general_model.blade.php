


<form class="form" method="post" action="{{ route('update_notofication',[get_lang(),$not->id]) }}" enctype="multipart/form-data">
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
                <select name="type" id="vendor_id" class=" form-control"
                >
                    <option value="" selected disabled>{{ __('Choose') }}</option>
                    @foreach ($vendors as $item)
                        <option @if($item->id == $not->vendor_id) selected @endif value="{{ $item->id }}">
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
                @if( $not->offer_id != null)
                @php
                    $offers = App\Models\Offer::where('status',1)->where('vendor_id', $not->vendor_id )->get()
                @endphp
                <select name="type" id="offer_id" class=" form-control">
                    @foreach ($offers as $item)
                    <option value="{{ $item->id }}"  @if($item->id == $not->offer_id) selected @endif >{{ $item->name_en }}</option>

                    @endforeach
                    


                </select>
                @else
                <select name="type" id="offer_id" class=" form-control">
                    <option value="" selected disabled>{{ __('Offer') }}</option>
                </select>
                @endif

                
                

            </div>
            <div class="form-group col-md-6">
                <label>{{ __('Title ar') }}:</label>
                <input type="text" name="title_ar" value="{{ $not->title_ar }}" id="title_ar" class="form-control form-control-solid"
                    placeholder="{{ __('title ar') }}" required />
            </div>
            <div class="form-group col-md-6">
                <label>{{ __('Title en') }}:</label>
                <input type="text" name="title_en" value="{{ $not->title_en }}" id="title_en" class="form-control form-control-solid"
                    placeholder="{{ __('title en') }}" required />
            </div>
           
            <div class="form-group col-md-6">
                <label>{{ __('body ar') }}:</label>
                <textarea name="body_ar"  class="form-control form-control-solid" id="body_ar" rows="3">{{ $not->body_ar }}</textarea>
            </div>
            <div class="form-group col-md-6">
                <label>{{ __('body en') }}:</label>
                <textarea name="body_en" class="form-control form-control-solid" id="body_en" rows="3">{{ $not->body_en }}</textarea>
            </div>
          

         

        </div>





        <div class="card-footer">
            <button type="submit" onclick="performStore()" class="btn btn-primary mr-2">Submit</button>
        </div>

</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function() {

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