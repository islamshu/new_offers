<table class="table table-striped table-bordered">

    <thead>
        <tr class="fw-bold fs-6 text-gray-800">

            <th>{{ __('image') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('branch number') }}</th>
            <th>{{ __('offer number') }}</th>
            <th>{{ __('Active Offer') }}</th>
            <th>{{ __('Paid Offer') }}</th>
            <th>{{ __('Free Offer') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vendors as $item)
            <td><img src="{{ asset('images/brand/' . $item->image) }}" width="50" height="50"
                    alt=""></td>
            <td>{{ $item->get_name() }}</td>
            <td>{{ $item->branches->count() }}</td>
            <td>{{ $item->offers->count() }}</td>
            <td>{{ App\Models\Offer::where('vendor_id', $item->id)->where('end_time', '>', \Carbon\Carbon::now())->where('start_time', '<', \Carbon\Carbon::now())->count() }}
            </td>
            <td>{{ App\Models\Offer::where('vendor_id', $item->id)->where('member_type', 'Premium')->count() }}
            </td>
            <td>{{ App\Models\Offer::where('vendor_id', $item->id)->where('member_type', 'free')->count() }}
            </td>


            <td class="pr-0 text-left">



                <a href="{{ route('vendor.offer', [app()->getLocale(), $item->id]) }}"
                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                    <i class="fa fa-eye"> </i>
                </a>
                <a data-toggle="modal" data-target="#myModal" class="btn btn-outline-primary"
                    onclick="make('{{ $item->id }}')">
                    {{ __('upload') }}
                </a>




            </td>
            </tr>
        @endforeach
        <div class="modal fase" id="myModal" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 123%;">
                    <div class="modal-header">

                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ __('Upload Offer') }}</h5>



                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div>

                    </div>

                    <div id="addToCart-modal-body">
                        <div class="c-preloader text-center p-3">
                            <i class="las la-spinner la-spin la-3x"></i>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>


    </tbody>

</table>
<tr>
    <td colspan="3" align="center">
     {!! $vendors->appends(request()->input())->links() !!}
    </td>
   </tr>