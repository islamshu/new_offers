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
                    @foreach ($member->subs->withTrashed() as $sub)
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
                            <form style="display: inline" action="{{ route('user_sub_delete.destroy',[get_lang(),$sub->id]) }}" method="post">
                                @method('delete') @csrf
                                
                                  
                                  <button class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange delete-confirm" type="submit" > <i class="material-icons">clear</i></button>
                                
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


@section('scripts')
    
 
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        <script>
         $('.delete-confirm').click(function(event) {
              var form =  $(this).closest("form");
              var name = $(this).data("name");
              event.preventDefault();
              swal({
                  title: `هل متأكد من حذف العنصر ؟`,
                icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                  form.submit();
                }
              });
          });
          </script>
  
@endsection
