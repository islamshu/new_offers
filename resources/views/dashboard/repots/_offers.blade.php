<table class=" table" >
    
    <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th >{{ __('Brand name') }}</th>
            <th  >{{ __('Brand created at') }}</th>
            <th >{{ __('Brand status') }}</th>
            <th >{{ __('Offer Count') }}</th>
            <th >{{ __('offer name') }}</th>
            <th >{{ __('offer created at') }}</th>
            <th>{{ __('expired at') }}</th>
            <th >{{ __('offer status') }}</th>
            <th >{{ __('Expired / Notexpired') }}</th>
            <th >{{ __('price') }}</th>
            <th >{{ __('price after discount') }}</th>
            <th >{{ __('percentage discount') }}</th>
            <th >{{ __('Type') }}</th>
            <th >{{ __('Buy Count') }}</th>
            <th >{{ __('client Count') }}</th>
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
            <td>{{ @$item->created_at->format('Y-m-d') }}</td>
            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->end_time)->format('Y-m-d') }}</td>
            
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