@extends('layout.default')
@section('content')
 
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <div class="card-header">
          
               
                <ol class="breadcrumb">
                    <li><a href="/{{ get_lang() }}/home"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
                    
                    <li class="active">{{ __('All Clients') }}</li>
                </ol>
            
            </div> 
    
            <div class="mt-10">

                <div class="row">
                    <div class="col-md-3 bg-light-primary w-100 h-100 px-6 py-8 rounded-2 mb-7 mr-7 ml-7 ">
                        <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                        <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">
                            {{-- <i class=" fa-4x"></i> --}}
                          
                            <i class="fa fa-users fa-4x"></i>
                        </span>
                        <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2"  style="font-size: 18px">
                            {{-- <i class=" fa-4x"></i> --}}
                          
                            {{ App\Models\Clinet::orderBy('register_date','desc')->count()}}
                        </span>
                        
                        <!--end::Svg Icon-->
                        <a href="{{ route('show_clients',[app()->getLocale(),'all']) }}" style="font-weight: bold;" class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">{{ __('All_Clients') }}</a>
                    </div>
                    <div class="col-md-3 bg-light-success w-100 h-100 px-6 py-8 rounded-2 mb-7 mr-7 ml-7 ">
                        <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                        <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">
                            {{-- <i class=" fa-4x"></i> --}}
                          
                            <i class="fa fa-users fa-4x"></i>
                        </span>
                        <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2"  style="font-size: 18px">
                            {{-- <i class=" fa-4x"></i> --}}
                          
                            {{ App\Models\Clinet::where('is_verify',1)->orderBy('register_date','desc')->count()}}
                        </span>
                        
                        <!--end::Svg Icon-->
                        <a href="{{ route('show_clients',[app()->getLocale(),'verify']) }}" style="font-weight: bold;" class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">{{ __('Verify Clients') }}</a>
                    </div>
                    <div class="col-md-3 bg-light-secondary w-100 h-100 px-6 py-8 rounded-2 mb-7 mr-7 ml-7 ">
                        <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                        <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">
                            {{-- <i class=" fa-4x"></i> --}}
                          
                            <i class="fa fa-users fa-4x"></i>
                        </span>
                        <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2"  style="font-size: 18px">
                            {{-- <i class=" fa-4x"></i> --}}
                          
                            {{ App\Models\Clinet::where('is_verify',0)->orderBy('register_date','desc')->count()}}
                        </span>
                        
                        <!--end::Svg Icon-->
                        <a href="{{ route('show_clients',[app()->getLocale(),'unverify']) }}" style="font-weight: bold;" class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">{{ __('UnVerfiy Clients') }}</a>
                    </div>
            
               
     
        
                <div class="col-md-3 bg-light-info px-6 py-8 rounded-2 mb-7 mr-7 ml-7">
                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                    <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">
                        {{-- <i class="fa fa-user fa-4x"></i> --}}
                        <i class="fas fa-user fa-4x"></i>
                    </span>
                    <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2"  style="font-size: 18px">
                        {{-- <i class=" fa-4x"></i> --}}
                      
                        {{ App\Models\Clinet::where('type_of_subscribe','PREMIUM')->orderBy('register_date','desc')->count()}}
                    </span>
                    <!--end::Svg Icon-->
                    <a href="{{ route('show_clients',[app()->getLocale(),'premium']) }}" style="font-weight: bold;" class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">{{ __('premium Clients') }}</a>
                </div>
                <div class="col-md-3 bg-light-warning px-6 py-8 rounded-2 mb-7 mr-7 ml-7">
                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                    <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">
                        {{-- <i class="fa fa-user fa-4x"></i> --}}
                        <i class="fas fa-user fa-4x"></i>
                    </span>
                    <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2"  style="font-size: 18px">
                        {{-- <i class=" fa-4x"></i> --}}
                      
                        {{ App\Models\Clinet::where('type_of_subscribe','TRIAL')->orderBy('register_date','desc')->count()}}
                                        </span>
                    <!--end::Svg Icon-->
                    <a href="{{ route('show_clients',[app()->getLocale(),'trail']) }}" style="font-weight: bold;" class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">{{ __('Trail Clients') }}</a>
                </div>
                <div class="col-md-3 bg-light-danger px-6 py-8 rounded-2 mb-7 mr-7 ml-7">
                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                    <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">
                        {{-- <i class="fa fa-user fa-4x"></i> --}}
                        <i class="fas fa-user fa-4x"></i>
                    </span>
                    <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2"  style="font-size: 18px">
                        {{-- <i class=" fa-4x"></i> --}}
                      
                        {{ App\Models\Clinet::where('type_of_subscribe','Expir_premium')->orderBy('register_date','desc')->count() + App\Models\Clinet::where('type_of_subscribe','FREE')->orderBy('register_date','desc')->count() }}
                    </span>
                    <!--end::Svg Icon-->
                    <a href="{{ route('show_clients',[app()->getLocale(),'none']) }}" style="font-weight: bold;" class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">{{ __('Free Clients') }}</a>
                </div>
        </div>

            {{-- <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('name') }}</th>
                        <th>{{ __('country code') }}</th>
                        <th>{{ __('alph') }}</th>
                        <th>{{ __('Action') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $cou)

                        <td>{{ $cou->country->country_name_en }}</td>
                        <td>{{ $cou->country->country_code }}</td>
                        <td>{{ $cou->country->alph3code }}</td>
                        <td class="pr-0 text-left">
                                <a href="{{ route('get_city_for_country', [ $cou->country->id, 'locale' => app()->getLocale()]) }}"
                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                      <i class="fa fa-eye"></i>
                                    </span>
                                </a>

                               

                        </td>
                        </tr>
                    @endforeach


                </tbody>

            </table> --}}


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
        $(function() {

        });

        function performdelete(id) {
            var url = '{{ route('offers.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
    </script>
@endsection
