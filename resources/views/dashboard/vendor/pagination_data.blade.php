<table class="table table-striped table-bordered">

    <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th class="pr-0 text-center">{{ __('image') }}</th>
            <th class="pr-0 text-center">{{ __('name') }}</th>

            <th class="pr-0 text-center">{{ __('Branch number') }}</th>
            <th class="pr-0 text-center">{{ __('Offer number') }}</th>

            <th class="pr-0 text-center">{{ __('Category') }}</th>
            <th class="pr-0 text-center">{{ __('Created at') }}</th>
            <th class="pr-0 text-center">{{ __('Status') }}</th>
            <th class="pr-0 text-center">{{ __('Action') }}</th>

        </tr>
    </thead>
    <tbody>

        @foreach ($vendors as $item)
            <tr>
                <td class="pr-0 text-center"><img src="{{ asset('images/brand/' . $item->image) }}" width="50"
                        height="50" alt=""></td>
                <td class="pr-0 text-center">
                    {{ $item->get_name() }}

                </td>

                <td class="pr-0 text-center">{{ @$item->branches->count() }}</td>
                <td class="pr-0 text-center">{{ @$item->offers->count() }}</td>

                <td class="pr-0 text-center"><button data-toggle="modal" data-target="#myModal"
                        class="btn btn-outline-primary"
                        onclick="make('{{ $item->id }}')">{{ __('Category') }}</button>
                </td>



                <td class="pr-0 text-center">{{ $item->created_at->format('M d Y') }}
                </td>
                <td>
                    <label class="switchh" data-id="{{ $item->id }}"
                        @if ($item->status == 'active') data-check="true" @else data-check="false" @endif>
                        <input type="checkbox" type="checkbox" data-id="{{ $item->id }}" name="status"
                            {{ $item->status == 'active' ? 'checked' : '' }}>
                        <span class="slider round swatched"></span>
                    </label>
                    {{-- <input type="checkbox" data-id="{{ $item->id }}" name="status" class="js-switch" {{ $item->status == 'active' ? 'checked' : '' }}> --}}
                </td>
                <td class="pr-0 text-center">

                    {{-- <a data-toggle="modal"
    data-target="#myModaluser" class="btn btn-outline-primary"
    onclick="makeuser('{{ $item->id }}')" 
        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
        <i class="fa fa-user"></i>
    </a> --}}

                    <a target="_blank" href="{{ route('vendor.offer', [app()->getLocale(), $item->id]) }}"
                        class="btn btn-icon">
                        <img src="http://cdn.onlinewebfonts.com/svg/img_544032.png" width="70" height="40" alt="">
                    </a>
                    @if (auth()->user()->isAbleTo(['update-vendor']))
                        <a href="{{ route('vendor.edit', ['locale' => app()->getLocale(), 'vendor' => $item->id]) }}"
                            class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endif

                    <a href="{{ route('vendor.show', ['locale' => app()->getLocale(), 'vendor' => $item->id]) }}"
                        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                        <i class="fa fa-eye"></i>
                    </a>





                    @if (auth()->user()->isAbleTo(['delete-vendor']))
                        <form method="post" style="display: inline">
                            <button type="button" onclick="performdelete('{{ $item->id }}')"
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

        <div class="modal fase" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ __('Categories') }}</h5>

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
        <div class="modal fase" id="myModaluser" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ __('create user') }}</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="addToCart-modal-body-user">
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

</table>
<tr>
    <td colspan="3" align="center">
        {!! $vendors->appends(request()->input())->links() !!}
    </td>
</tr>


</tbody>
<script>
    $(document).ready(function() {
        $('.switchh').change(function() {
            let status = $(this).data('check') === false ? 'active' : 'deactive';
            let userId = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('vednor.update.status', app()->getLocale()) }}',
                data: {
                    'status': status,
                    'user_id': userId
                },
                success: function(data) {
                    console.log(data.message);
                }
            });
        });
    });
</script>
