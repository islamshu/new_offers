
<div class="set_date">
 
@foreach ($vendors as $item)
<tr>
<td class="pr-0 text-center"><img src="{{ asset('images/brand/' . $item->image) }}" width="50" height="50" alt=""></td>
<td class="pr-0 text-center">
    @if (app()->getLocale() == 'en')
        {{ $item->name_en }}
    @elseif(app()->getLocale() == "ar")
        {{ $item->name_ar }}
    @endif
</td>

<td class="pr-0 text-center">{{ $item->branches->count() }}</td>
<td class="pr-0 text-center"><button data-toggle="modal"
        data-target="#myModal" class="btn btn-outline-primary"
        onclick="make('{{ $item->id }}')">{{ __('Category') }}</button>
</td>



<td class="pr-0 text-center">{{ $item->created_at->format('M d Y') }}
</td>
<td>
    <label class="switchh">
        <input type="checkbox" type="checkbox" data-id="{{ $item->id }}" name="status" {{ $item->status == 'active' ? 'checked' : '' }}>
        <span class="slider round swatched"></span>
      </label>
    {{-- <input type="checkbox" data-id="{{ $item->id }}" name="status" class="js-switch" {{ $item->status == 'active' ? 'checked' : '' }}> --}}
</td>
<td class="pr-0 text-center">

    <a data-toggle="modal"
    data-target="#myModaluser" class="btn btn-outline-primary"
    onclick="makeuser('{{ $item->id }}')" 
        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
        <i class="fa fa-user"></i>
    </a>

    <a target="_blank" href="{{ route('vendor.offer', [ app()->getLocale(),$item->id]) }}"
        class="btn btn-icon">
        <img src="http://cdn.onlinewebfonts.com/svg/img_544032.png" width="70" height="40" alt="">
    </a>
    @if (auth()->user()->isAbleTo(['update-vendor']))

    <a href="{{ route('vendor.edit', [ 'locale' => app()->getLocale(),'vendor' => $item->id]) }}"
        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
        <i class="fa fa-edit"></i>
    </a>
    @endif

    <a href="{{ route('vendor.show', [ 'locale' => app()->getLocale(),'vendor' => $item->id]) }}"
        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
        <i class="fa fa-eye"></i>
    </a>
  




    @if (auth()->user()->isAbleTo(['delete-vendor']))

    <form method="post" style="display: inline">
        <button type="button"
            onclick="performdelete('{{ $item->id }}')"
            class="btn btn-icon btn-light btn-hover-primary btn-sm"><span
                class="svg-icon svg-icon-md svg-icon-primary">
                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                <i class="fa fa-trash"></i>
                <!--end::Svg Icon-->
            </span> </button>
    </form>
    @endif
    <a href="{{ route('cover.show', [app()->getLocale(), $item->id]) }}"
        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
        <i class="fa fa-image"></i>
    </a>
</td>
</tr>

@endforeach
</div>
<tr>
    <td colspan="3" align="center">
     {!! $vendors->appends(request()->input())->links() !!}
    </td>
   </tr>
</tbody>

