<table class="table table-striped table-bordered">

<thead>
    <tr class="fw-bold fs-6 text-gray-800">
        <th>{{ __('Name') }}</th>
        <th>{{ __('Active Branch') }}</th>
        <th>{{ __('Deactive Branch') }}</th>

        <th>{{ __('Action') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($vendors as $item)
        <tr>
            <td>{{ $item->name_ar }}</td>
            <td>{{ $item->branches->where('status', 'active')->count() }}</td>
            <td>{{ $item->branches->where('status', 'deactive')->count() }}</td>


            <td class="pr-0 text-left">


                <a href="{{ route('vendor.get_branch', [app()->getLocale(), $item->id]) }}"
                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                    <span class="svg-icon svg-icon-md svg-icon-primary">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                        <i class="fa fa-eye"></i>
                        <!--end::Svg Icon-->
                    </span>
                </a>
                @if (auth()->user()->isAbleTo(['create-branch']))

                <a data-toggle="modal" data-target="#myModal" class="btn btn-outline-primary"
                    onclick="make('{{ $item->id }}')">
                    {{ __('upload') }}
                </a>
                @endif


            </td>

        </tr>
    @endforeach

    <div class="modal fase" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 123%;">
                <div class="modal-header">

                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ __('Upload Branch') }}</h5>
                    <a style="    margin-right: -234px;"
                        href="{{ route('download.branches', app()->getLocale()) }}"
                        class="btn btn-info">{{ __('Dawnlod Sample') }}</a>


                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
</tbody>

</table>