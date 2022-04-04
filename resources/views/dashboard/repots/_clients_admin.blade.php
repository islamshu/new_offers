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

    <td>{{ @$item->phone }}</td>

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
        <td>{{ saving_offer($item->id) }}</td>
        <td>{{ @$item->subs->last()->payment_type }}</td>
        <td>{{ @$item->mobile_type }}</td>

       
        </tr>
    @endforeach



</tbody>

</table>
{!! $clients->appends(request()->input())->links() !!}