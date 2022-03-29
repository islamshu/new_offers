<table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7">
    
    <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th style="width: 100px">{{ __('Brand name') }}</th>
            <th style="width: 100px">{{ __('Brand created at') }}</th>
            <th style="width: 100px">{{ __('Brand status') }}</th>
            <th style="width: 100px">{{ __('Offer Count') }}</th>
            <th style="width: 100px">{{ __('offer name') }}</th>
            <th style="width: 100px">{{ __('offer created at') }}</th>
            <th style="width: 100px">{{ __('expired at') }}</th>
            <th style="width: 100px">{{ __('offer status') }}</th>
            <th style="width: 100px">{{ __('Expired / Notexpired') }}</th>
            <th style="width: 100px">{{ __('price') }}</th>
            <th style="width: 100px">{{ __('price after discount') }}</th>
            <th style="width: 100px">{{ __('percentage discount') }}</th>
            <th style="width: 100px">{{ __('Type') }}</th>
            <th style="width: 100px">{{ __('Buy Count') }}</th>
            <th style="width: 100px">{{ __('client Count') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($offers as $item)
           @if(get_lang() == 'ar')
            <td>{{ @$item->vendor->name_ar }}</td>
            @else
            <td>{{ @$item->vendor->name_en }}</td>
            @endif


            <td>{{ @$item->vendor->created_at }}</td>
            <td>{{ @$item->vendor->status }}</td>
            <td>{{ @$item->vendor->offers->count() }}</td>
            @if(get_lang() == 'ar')
            <td>{{ @$item->name_ar }}</td>
            @else
            <td>{{ @$item->name_en }}</td>
            @endif
            <td>{{ @$item->created_at }}</td>
            <td>{{ @$item->end_time }}</td>
            <td>{{ $item->status == 0 ? 'deactive' :'active' }}</td>
            @if(Carbon\Carbon::now() > $item->end_time)
            <td> Exprie</td>
            @else
            <td> Not Exprie</td>
            @endif

            <td>{{ @$item->offertype->price}}</td>
            <td>{{ @$item->offertype->price_after_discount}}</td>
            <td>{{ @$item->offertype->discount_value}}</td>
            <td>{{ @$item->offertype->offer_type}}</td>
            <td>{{ @App\Models\Transaction::where('offer_id',$item->id)->count() }}</td>
            <td>{{ get_count_client($item->id) }}</td>

           
            </tr>
        @endforeach
   


    </tbody>

</table>
{!! $offers->appends(request()->input())->links() !!}