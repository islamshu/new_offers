<table class="datatable table ">
<thead>
    <tr class="fw-bold fs-6 text-gray-800">

        <th>{{ __('Name') }}</th>
        <th>{{ __('Phone') }}</th>
        <th>{{ __('city') }}</th>
        <th>{{ __('registration date') }}</th>
        <th>{{ __('Subscription type') }}</th>
        <th>{{ __('Mobile type') }}</th>
        {{-- <th>{{ __('acount status') }}</th> --}}

        <th>{{ __('Date Of Birth') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
</thead>
<tbody>

        @foreach ($clinets as $item)
            <td>{{ $item->name }}</td>
            <td>{{ $item->phone }}</td>
            <td>{{ @App\Models\City::find($item->email) }}</td>
            <td>{{ $item->register_date ? $item->register_date : $item->created_at }}</td>
            <td>{{ $item->type_of_subscribe }}</td>
            <td>{{ $item->mobile_type }}</td>
            <td>{{ $item->birth_date }}</td>

            <td class="pr-0 text-left">
                @if (auth()->user()->isAbleTo(['create-client']))

                <div class="dropdown">
                    <button class="dropbtn">{{ __('Action') }}</button>
                    <div class="dropdown-content">
                        <a
                            href="{{ route('clinets.show', [app()->getLocale(), $item->id]) }}">{{ __('show') }}</a>
                        <a data-toggle="modal" data-target="#myModal"
                            onclick="make('{{ $item->id }}')">Send Notofication</a>
                        
                        <a data-toggle="modal" data-target="#addSub"
                            onclick="makenew_fun({{ $item->id }})">Add Subscribe</a>

                    </div>
                    @endif


                    {{-- <a href="{{ route('clinets.show', [app()->getLocale(), $item->id]) }}"
            class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
            <i class="fa fa-eye"> </i>
        </a> --}}




            </td>
            </tr>
        @endforeach

</tbody>

</table>
<tr>
    <td >
     {!! $clinets->appends(request()->input())->links() !!}
    </td>
   </tr>