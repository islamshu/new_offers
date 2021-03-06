@extends('layout.default')

@section('content')
<ol class="breadcrumb">
    <li><a href="/{{ get_lang() }}/home"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
    <li><a href="{{ route('promotion.index',get_lang()) }}"><i class="fa fa-dashboard"></i> {{ __('promotion') }}</a></li>
    <li><a href="{{ route('get_elemet_by_type',[get_lang(),'homeslider', $city_id]) }}"><i class="fa fa-dashboard"></i> {{ __('Home Sliders') }}</a></li>
    
    <li class="active">{{ __('create Home slider') }}</li>
</ol>
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All Offer for this slider') }}</h2>
            @if ( auth()->user()->isAbleTo(['home-slider']) )

                <fieldset style="    border: 2px solid lightgray !important;
                        padding: 36px;
                    ">
                    <legend>{{ __('add offer') }}</legend>

                    <form action="{{ route('create_offer', app()->getLocale()) }}" method="post">
                        @csrf
                        @php
                            $lang = app()->getLocale();
                        @endphp
                        <div class="row">
                            <div class="col-md-3">
                                <select name="vendor_id" id="vendor_id" class="selectpicker form-control"
                                    data-live-search="true">
                                    <option selected disabled>{{ __('choose') }}</option>
                                    @foreach ($brands as $item)
                                        <option value="{{ $item->id }}">
                                            @if ($lang == 'ar')
                                                {{ $item->name_ar }}
                                            @else
                                                {{ $item->name_en }}
                                            @endif
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <input type="text" name="homeslider_id" hidden value="{{ $homeslider->id }}" id="">
                            <div class="col-md-3">
                                <select value="offer_id" name="offer_id" id="offer_id" class="form-control">
                                    <option selected disabled>{{ __('choose') }}</option>


                                </select>
                            </div>
                           
                            <div class="col-md-2">
                                <input type="submit" class="form-control btn-info" value="{{ __('Submit') }}">
                            </div>
                        </div>
                    </form>

                </fieldset>
            @endif

            <br>
            <div class="mt-10">



                <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                   >
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th>{{ __('drop') }}</th>

                            <th>{{ __('brand name') }}</th>
                            <th>{{ __('offer name') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="sort_menu">
                        @php
                            $lang = app()->getLocale();
                        @endphp
                        @foreach ($slider_offer as $item)
                            <tr data-id="{{ $item->id }}">


                                <td> <i class="fa fa-bars handle" aria-hidden="true"></i></td>
                                @if($lang == 'ar')
                                <td>{{ $item->vendor->name_ar }}</td>
                                
                                <td>{{ $item->offer->name_ar }}</td>
                                @else
                                <td>{{ $item->vendor->name_en }}</td>
                                
                                <td>{{ $item->offer->name_en }}</td>
                                @endif


                                <td class="pr-0 text-left">
                                    {{-- <a href="{{ route('offer_slider', [app()->getLocale(), $item->id]) }}"
                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                    <i class="fa fa-plus"></i>
                                </a> --}}
                                    <form method="post" style="display: inline">
                                        <button type="button" onclick="performdelete('{{ $item->id }}')"
                                            class="btn btn-icon btn-light btn-hover-primary btn-sm"><span
                                                class="svg-icon svg-icon-md svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                                <i class="fa fa-trash"></i>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </button>
                                    </form>



                                </td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>


            </div>
        </div>

    @endsection

    @section('styles')
    @endsection

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
                integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

        <script src="{{ asset('crudjs/crud.js') }}"></script>
        <script>
            $(document).ready(function() {

                $('#vendor_id').on('change', function() {
                    // console.log("hmm its change");
                    var cat_id = $(this).val();
                    // console.log(cat_id);
                    var div = $(this).parent();

                    var op = " ";

                    $.ajax({
                        type: 'get',
                        url: "{{ route('get_offer_ajax_not_slider', ['locale' => app()->getLocale()]) }}",
                        data: {
                            'venodr_id': cat_id
                        },
                        success: function(data) {
                            $('#offer_id').html(new Option('choose', '', 'disabled', 'selected'));
                            for (var i = 0; i < data.length; i++) {
                                @if ($lang == 'ar')
                                    $('#offer_id').append(new Option(data[i].name_ar,
                                    data[i].id));
                                @else
                                    $('#offer_id').append(new Option(data[i].name_en,
                                    data[i].id));
                                @endif

                            }
                        },
                        error: function() {

                        }
                    });

                });
            });

            function performdelete(id) {
                var url = '{{ route('homeslider.destroy', [':id', 'locale' => app()->getLocale()]) }}';
                url = url.replace(':id', id);


                confirmDestroy(url)
            }

            function updateToDatabase(idString) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                $.ajax({
                    url: '{{ route('menu_slideroffer', app()->getLocale()) }}',
                    method: 'POST',
                    data: {
                        ids: idString
                    },
                    success: function() {
                        alert('Successfully updated')
                        //do whatever after success
                    }
                })
            }

            var target = $('.sort_menu');
            target.sortable({
                handle: '.handle',
                placeholder: 'highlight',
                axis: "y",
                update: function(e, ui) {
                    var sortData = target.sortable('toArray', {
                        attribute: 'data-id'
                    })
                    updateToDatabase(sortData.join(','))
                }
            });
        </script>
    @endsection
