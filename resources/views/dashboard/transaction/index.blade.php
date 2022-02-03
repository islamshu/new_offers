@extends('layout.default')
@section('content')
    <div class="
card card-docs mb-2">

        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">All Transaction</h2>

            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>{{ __('Client Name') }}</th>
                        <th>{{ __('Offer Name') }}</th>
                        <th>{{ __('Branch Name') }}</th>
                        <th>{{ __('Vendor Name') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $item)
                        <tr>
                            <td><a href="{{ route('clinets.show',[app()->getLocale(),$item->client_id]) }}" target="_blank">{{ $item->client->name }}</a></td>
                            <td><a href="{{ route('offers.show',[app()->getLocale(),$item->offer_id]) }}" target="_blank">{{ $item->offer->name_ar }}</a></td>
                            <td> <a href="{{ route('branch.show',[app()->getLocale(),$item->branch_id]) }}" target="_blank">{{ $item->branch->name_ar }}</a></td>
                            <td> <a href="{{ route('vendor.show',[app()->getLocale(),$item->vendor_id]) }}" target="_blank">{{ $item->vendor->name_ar }}</a></td>

                            <td class="pr-0 text-left">


                                <a href="{{ route('vendor.get_branch', [app()->getLocale(), $item->id]) }}"
                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                        <i class="fa fa-eye"></i>
                                        <!--end::Svg Icon-->
                                    </span>
                                </a>
                              


                            </td>

                        </tr>
                    @endforeach

                 
                </tbody>

            </table>


        </div>
    </div>

@endsection

@section('styles')

    <link href="{{ asset('/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
    <script src="{{ asset('/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script>


    </script>

 

@endsection
