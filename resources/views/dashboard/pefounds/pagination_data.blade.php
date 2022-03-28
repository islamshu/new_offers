<table class="table table-striped table-bordered">

<thead>
    <tr class="fw-bold fs-6 text-gray-800">
        <th>{{ __('logo') }}</th>
        <th>{{ __('Name en') }}</th>
        <th>{{ __('total groubs') }}</th>
        <th>{{ __('Active Codes') }}</th>
        <th>{{ __('Deactive Codes') }}</th>
        <th>{{ __('Action') }}</th>


     </tr>
</thead>
<tbody>
        @foreach ($vendors as $item) 
        <td><img src="{{ asset('images/brand/'.$item->image)}}" width="50" height="50" alt=""></td>

        <td>{{$item->name_en}}</td>
        <td>{{ $item->code_permfomed->count() }}</td>
        <td>{{ $item->code_permfomed->where('status',1)->count() }}</td>
        <td>{{ $item->code_permfomed->where('status',0)->count() }}</td>
        <td >

            <a href="{{ route('vendor.get_perfomed_vendor', [app()->getLocale(),$item->id]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
              <i class="fa fa-eye"></i>
            </a>
        
          
           
        </td>
   </tr>
      @endforeach
     

</tbody>

</table>