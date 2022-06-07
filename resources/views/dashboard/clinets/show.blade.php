@extends('layout.default')

@section('title')
    {{ __('Members') }}
@endsection


@section('styles')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/c3/c3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/animate-css/vivify.min.css') }}">
    <style>
        .col {
            margin: 1% !important
        }

        .text-muted {
            font-size: 16px
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="body">
                        <div class="  text-left p-4">
                            <div class="circle" style="font-size: 20px;
                                font-weight: 600;">
                                Client Info
                            </div>

                        </div>
                        <hr>
                        <div class="row" style="margin: 2% !important">
                            <div class="col">
                                <small class="text-muted">Phone: </small>
                                <p>{{ @$member->phone }}</p>
                                <hr>
                                <small class="text-muted">Email address: </small>
                                <p>{{ @$member->email == null ? '-' : @$member->email }}</p>
                                <hr>
                                <small class="text-muted">Last Visit: </small>
                                <p>{{ @$member->last_login }}</p>
                                <hr>
                                <small class="text-muted">Natonality: </small>
                                <p class="m-b-0">
                                    {{ @$member->nationality == null ? '-' : @$member->nationality }}</p>
                                <hr>

                                <small class="text-muted">Device: </small>
                                <p class="m-b-0">
                                <p class="m-b-0">
                                    {{ @$member->mobile_type == null ? '-' : @$member->mobile_type }}</p>

                                </p>
                            </div>

                            <div class="col">
                                <small class="text-muted">Country: </small>
                                <p>{{ @$member->country->country_name_ar == null ? '-' : @$member->country->country_name_ar }}
                                </p>
                                <hr>
                                <small class="text-muted">City: </small>
                                <p>{{ @$member->city->city_name == null ? '-' : @$member->city->city_name }}</p>
                                <hr>
                                <small class="text-muted">Created at : </small>
                                <p class="m-b-0">{{ @$member->created_at == null ? '-' : @$member->created_at }}
                                </p>
                                <hr>
                                <small class="text-muted">Gender: </small>
                                <p class="m-b-0">{{ @$member->gender == null ? '-' : @$member->gender }}</p>
                                <hr>

                            </div>
                        </div>
                        <hr>

                    </div>
                </div>

            </div>
        </div> <br>
        <div class="row clearfix">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="body">
                        <div class="  text-left p-4">
                            <div class="circle" style="font-size: 20px;
                                font-weight: 600;">
                               Subscription Info
                            </div>

                        </div>
                        <hr>
                        <div class="row" style="margin: 2% !important">
                            <div class="col">
                                <small class="text-muted">Number of Oparation: </small>
                                <p>{{ @$member->number_of_operations }}</p>
                                <hr>
                                <small class="text-muted">Type Of Subscribe: </small>
                                <p>{{ @$member->type_of_subscribe == null ? '-' : @$member->type_of_subscribe }}</p>
                                <hr>
                                <small class="text-muted">How to subscribe: </small>
                                <p>{{ __(@$member->subs->last()->payment_type)}}</p>
                                <hr>
                                <small class="text-muted">Status: </small>
                                <p class="m-b-0">
                                    {{  __(@$member->subs->last()->status)}}</p>
                                <hr>

                                <small class="text-muted">expiry date: </small>
                                <p class="m-b-0">
                                <p class="m-b-0">
                                    {{ $member->expire_date != null ?  $member->expire_date : '_'}}
                                </p>
                                <hr>
                            </div>

                            <div class="col">
                                <small class="text-muted">Points No: </small>
                                <p>{{ @$member->points_no }}
                                </p>
                                <hr>
                                <small class="text-muted">Offers saving: </small>
                                <p>{{ @$member->offers_saving  }}
                                </p>
                                <hr>
                                <small class="text-muted">Coupon Saving : </small>
                                <p class="m-b-0">{{ @$member->coupon_saving  }}
                                </p>
                                <hr>
                                <small class="text-muted">Used Offers No: </small>
                                <p class="m-b-0">{{ @$member->used_offers_no }}</p>
                                <hr>
                                <small class="text-muted">Credit: </small>
                                <p class="m-b-0">{{ @$member->credit  }}</p>
                                <hr>

                                

                            </div>
                        </div>
                        <hr>

                    </div>
                </div>

            </div>
        </div>
        <div class="row clearfix">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="body">
                        <div class="  text-left p-4">
                            <div class="circle" style="font-size: 20px;
                                font-weight: 600;">
                               Subscription history
                            </div>

                        </div>
                        <hr>
                       
            <table class="table  table-row-bordered gy-5 gs-7"
                id="">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>{{ __('package name') }}</th>
                        <th>{{ __('payment type') }}</th>
                        <th>{{ __('started at') }}</th>
                        <th>{{ __('end at') }}</th>
                        <th>{{ __('activiton code') }}</th>
                        <th>{{ __('promo code') }}</th>
                        <th>{{ __('redeem  number') }}</th>
                        <th>{{ __('paid') }}</th>
                        <th>{{ __('action') }}</th>




                       

                    </tr>
                </thead>
                <tbody>
                    @foreach ($member->subs as $sub)
                        @if(get_lang() == 'ar')
                       <td>{{ @$sub->subscripe->name_ar }}</td>
                        @else
                        <td>{{ @$sub->subscripe->name_en }}</td>
                        @endif


                        <td>{{ @$sub->payment_type }}</td>
                        <td>{{ @$sub->created_at->format('Y-m-d') }}</td>
                        <td>{{ @$sub->expire_date }}</td>
                        <td>{{ @$sub->code ? @$sub->code : '_' }}</td>
                        <td>{{ @$sub->promocode ? @$sub->promocode : '_' }}</td>
                        <td> <a target="_blank" href="{{ route('get_reedem_for_user',[get_lang(),$member->id,$sub->id]) }}">{{ @App\Models\OfferUser::where('sub_id',$sub->id)->where('client_id',$member->id)->count() }}</a></td>
                        <td>{{ @$sub->paid ? @$sub->paid : '_' }}</td>
                        <td>
                            <form method="post" style="display: inline">
                                <button type="button" onclick="performdelete('{{ $sub->id }}')"
                                    class="btn btn-icon btn-light btn-hover-primary btn-sm"><span
                                        class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span> </button>
                            </form>
                        </td>

                        </tr>
                    @endforeach


                </tbody>

            </table>
                        <hr>

                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection


@section('js')
    
    <script src="{{ asset('dashboard/assets/assets/bundles/chartist.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/assets/bundles/mainscripts.bundle.js') }}"></script>

    <script src="{{ asset('dashboard/assets/assets/bundles/flotscripts.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/assets/bundles/c3.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/assets/bundles/knob.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDL_Iurzw7shb69C_H4GLxzETOgHWrzHEw"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script>
        function performdelete(id) {
            var url = '{{ route('user_sub_delete.destroy', [':id', 'locale' => app()->getLocale()]) }}';
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
                url: '{{ route('update_cateory_sort', app()->getLocale()) }}',
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

      
    </script>
  
@endsection
