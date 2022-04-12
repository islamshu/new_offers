@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <div class="card-header">
          
                <ol class="breadcrumb">
                    <li><a href="/{{ get_lang() }}/home"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
                    <li class="active"> {{ __('All Discount Code') }}</li>
            
                </ol>
            
            </div>

            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('name') }}</th>
                        <th>{{ __('name of package') }}</th>
                        <th>{{ __('price for package') }}</th>
                        <th>{{ __('price after descount') }}</th>
                        <th>{{ __('Descount value') }}</th>
                        <th>{{ __('Descount Persantage') }}</th>
                        <th>{{ __('Start Date') }}</th>
                        <th>{{ __('End Date') }}</th>
                        <td>{{ __('Status') }}</td>
                        <th>{{ __('number of codes') }}</th>
                        <th>{{ __('number of remain') }}</th>
                        <th>{{ __('number of useage') }}</th>
                        <th>{{ __('code') }}</th>
                        <th>{{ __('Action') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($codes as $code)
                    @php
                    $promo = App\Models\DiscountSubscription::where('discount_id',$code->id)->first()->code;
                           if ( $code->type_discount == 'percentage') {
                            $total =     @$code->package->price -  (@$code->package->price * $code->value_discount / 100);
                        } else {
                            $total =     @$code->package->price -  $code->value_discount;
                        }
                        $per = strval(100 * (@$code->package->price - $total) / @$code->package->price);
                        $number_code = App\Models\DiscountSubscription::where('discount_id',$code->id)->count();
                        $descount =App\Models\DiscountSubscription::where('discount_id',$code->id)->first();

                    @endphp
                  
                        <td>{{ $code->name_en }}</td>
                        <td>{{ @$code->package->name_en }}</td>
                        <td>{{ @$code->package->price }}</td>
                        <td>{{ @$total}}</td>
                        <td>{{ @$code->value_discount}}</td>


                        <td>{{bcdiv($per,1,2)}} %</td>
                        <td>{{ $code->start_at }}</td>
                        <td>{{ $code->end_at }}</td>
                        <td>
                            @if (auth()->user()->isAbleTo(['update-discount']))

                            <input type="checkbox" data-id="{{ $code->id }}" name="status" class="js-switch"
                                {{ $code->status == 1 ? 'checked' : '' }}>
                                @endif
                        </td>
                        <td style="font-size: 33px">{{  $code->type_of_limit == 'unlimit' ?  '∞' : $code->number_of_code  }}</td>
                        <td style="font-size: 33px">{{ $code->type_of_limit == 'unlimit' ?  '∞' : $code->total_remain  }}</td>
                        <td>{{ App\Models\PromocodeUser::where('promocode','like',$promo)->count() }}</td>
                        <td>
                                @if($number_code == 1)

                                <a data-toggle="modal" data-target="#myModal" class="btn btn-outline-primary"
                                onclick="make('{{ $descount->code }}')">
                                {{ $descount->code }}</a>
                                
                                @else
                                <form action="{{ route('showCodes',get_lang()) }}" method="get">
                                    @csrf
                                <input type="hidden"  name="id" value="{{ $code->id }}" id="">
                                <button type="submit"><i class="fa fa-eye"></i></button>
                                </form>
                                @endif

                        </td>
                        <td class="pr-0 text-left">
                            
                      
                                @if (auth()->user()->isAbleTo(['update-discount']))

                            <a href="{{ route('discount_code.edit', [$code->id, 'locale' => app()->getLocale()]) }}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                            <path
                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            @endif
   

                        </td>
                        </tr>
                    @endforeach


                </tbody>

            </table>
            <div class="modal fase" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width: 123%;">
                                <div class="modal-header">

                                    <h5 class="modal-title" id="staticBackdropLabel">
                                        {{ __('Promo Code') }}</h5>
                                    


                                   
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


        </div>
    </div>
@endsection

@section('styles')
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script>
        function make(promocode) {
            $("#myModal").show();

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'get',
                url: "{{ route('showCodesUser', app()->getLocale()) }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'promo': promocode
                },

                success: function(data) {
                    $('#addToCart-modal-body').html(data);

                }
            });

        }
    </script>
    <script>
       

        function performdelete(id) {
            var url = '{{ route('discount_code.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.js-switch').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('discount.update_status', app()->getLocale()) }}',
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.message);
                    }
                });
            });
        });
    </script>
@endsection
