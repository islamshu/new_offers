<table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
id="kt_datatable">
<thead>
    <tr class="fw-bold fs-6 text-gray-800">
        <th>{{ __('code') }}</th>
        <th>{{ __('total') }}</th>
        <th>{{ __('total usage') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($codes as $item)
    @php
        $dis = App\Models\Discount::find($item->)
    @endphp
    <td>{{ $item->code }}</td>
    <td>{{ $item->city->id }}</td>
    @php
       $neighborhoods = App\Models\enterprise_neighborhood::where('enterprise_id',$vendor->enterprise_id)->where('status',1)->with('neighborhood')
        ->whereHas('neighborhood', function ($q) use ($item) {
            $q->where('city_id', $item->city->id);
          })->get()
          @endphp
          <td>
          @foreach ($neighborhoods as $key => $value) 
          
            {{ 'name : ' }}  {{ $value->neighborhood->neighborhood_name }} {{ '  '  }}{{ '  Id: ' }} {{ $value->neighborhood->id }} <br>
          
          @endforeach
        </td>
            
          
    
        
    @endforeach
</tbody>
</table>