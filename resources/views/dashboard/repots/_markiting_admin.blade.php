<table class="datatable table ">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>{{ __('Name') }}</th>
            <th>{{ __('phone') }}</th>
            <th>{{ __('city') }}</th>
            <th style="width:100%">{{ __('register date') }}</th>
            <th>{{ __('subscribe status') }}</th>
            <th style="width:100%">{{ __('last subscribe') }}</th>
            <th style="width:100%">{{ __('first date of last subscribe') }}</th>
            <th style="width:100%">{{ __('last date of last subscribe') }}</th>
            <th>{{ __('Subscription event') }}</th>
            <th>{{ __('subscribe count') }}</th>
            <th>{{ __('Transaction count') }}</th>
            <th>{{ __('saving') }}</th>
            <th>{{ __('Payment method') }}</th>
            <th>{{ __('mobile type') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $item)
            @php
                $city = @App\Models\City::find($item->city_id);
            @endphp
      <td>{{ @$item->name }}</td>
    
        <td><button data-toggle="modal"
            data-target="#myModal" class="btn btn-outline-primary"
            onclick="make('{{ $item->id }}')"><i class="fa fa-search"></i></button></td>
    
            <td>
              {{ @$city->city_name ? @$city->city_name : '-' }}
        </td>
            <td>{{ @$item->register_date }}</td>
    
            <td>{{ @$item->type_of_subscribe }}</td>
            <td>{{@$item->subs->last()->created_at }}</td>
            <td>{{@$item->start_date }}</td>
            <td>{{@$item->expire_date }}</td>
            <td>-</td>
            <td>{{@$item->subs->count() }}</td>
            <td>{{@$item->trans->count() }}</td>
            <td>0</td>
            <td>{{ @$item->subs->last()->payment_type }}</td>
            <td>{{ @$item->mobile_type }}</td>
    
           
            </tr>
        @endforeach
    
    
    
    </tbody>
    
    </table>
    <div class="modal fase" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="staticBackdropLabel">
                    {{ __('Phone') }}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="addToCart-modal-body">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn ok">Ok</button>
            </div>
        </div>
    </div>
</div>
    {!! $clients->appends(request()->input())->links() !!}