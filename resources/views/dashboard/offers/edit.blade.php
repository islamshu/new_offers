@extends('layout.default')
@section('styles')
    <link href="{{ asset('css/pages/wizard/wizard-1.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-body p-0">
            <!--begin::Wizard-->
            <div class="wizard wizard-1" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="false">
                <!--begin::Wizard Nav-->
                <div class="wizard-nav border-bottom">
                    <div class="wizard-steps p-8 p-lg-10">
                        <!--begin::Wizard Step 1 Nav-->
                        <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                            <div class="wizard-label">
                                <i class="wizard-icon flaticon-bus-stop"></i>
                                <h3 class="wizard-title">1. {{ __('General Info') }}</h3>
                            </div>
                            <span class="svg-icon svg-icon-xl wizard-arrow">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <rect fill="#000000" opacity="0.3"
                                            transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                            x="11" y="5" width="2" height="14" rx="1" />
                                        <path
                                            d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Wizard Step 1 Nav-->
                        <!--begin::Wizard Step 2 Nav-->
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-label">
                                <i class="wizard-icon flaticon-list"></i>
                                <h3 class="wizard-title">2. {{ __('Datatime') }}</h3>
                            </div>
                            <span class="svg-icon svg-icon-xl wizard-arrow">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <rect fill="#000000" opacity="0.3"
                                            transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                            x="11" y="5" width="2" height="14" rx="1" />
                                        <path
                                            d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Wizard Step 2 Nav-->
                        <!--begin::Wizard Step 3 Nav-->
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-label">
                                <i class="wizard-icon flaticon-responsive"></i>
                                <h3 class="wizard-title">{{ __('Copoun and points') }}</h3>
                            </div>
                            <span class="svg-icon svg-icon-xl wizard-arrow">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <rect fill="#000000" opacity="0.3"
                                            transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                            x="11" y="5" width="2" height="14" rx="1" />
                                        <path
                                            d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Wizard Step 3 Nav-->
                        <!--begin::Wizard Step 4 Nav-->
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-label">
                                <i class="wizard-icon flaticon-truck"></i>
                                <h3 class="wizard-title">4. {{ __('Sort info') }}</h3>
                            </div>
                            <span class="svg-icon svg-icon-xl wizard-arrow">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <rect fill="#000000" opacity="0.3"
                                            transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                            x="11" y="5" width="2" height="14" rx="1" />
                                        <path
                                            d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Wizard Step 4 Nav-->
                        <!--begin::Wizard Step 5 Nav-->
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-label">
                                <i class="wizard-icon flaticon-globe"></i>
                                <h3 class="wizard-title">5. {{ __('Description and Terms') }}</h3>
                            </div>
                            <span class="svg-icon svg-icon-xl wizard-arrow last">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <rect fill="#000000" opacity="0.3"
                                            transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                            x="11" y="5" width="2" height="14" rx="1" />
                                        <path
                                            d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Wizard Step 5 Nav-->
                    </div>
                </div>
                <!--end::Wizard Nav-->
                <!--begin::Wizard Body-->
                <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
                    <div class="col-xl-12 col-xxl-7">
                        <!--begin::Wizard Form-->
                        {{-- <form class="form" id="kt_form"> --}}
                        <form class="form" method="post" id='kt_form' enctype="multipart/form-data">

                            <!--begin::Wizard Step 1-->
                            <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                <h3 class="mb-10 font-weight-bold text-dark">{{ __('General Info') }}</h3>
                                <!--begin::Input-->
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label>{{ __('Name ar') }}:</label>
                                            <input type="text" class="form-control form-control-solid form-control-lg"
                                                id="name_ar" value="{{ @$offer->name_ar }}" name="name_ar"
                                                placeholder="Name ar" />
                                            <span class="form-text text-muted">Please enter name in Arabic .</span>
                                        </div>
                                    </div>
                                    <!--end::Input-->
                                    <!--begin::Input-->
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label>{{ __('Name en') }}:</label>
                                            <input type="text" class="form-control form-control-solid form-control-lg"
                                                id="name_en" name="name_en" value="{{ @$offer->name_en }}"
                                                placeholder="Name en" />
                                            <span class="form-text text-muted">Please enter name in English .</span>
                                        </div>
                                    </div>
                                </div>
                                @if (auth()->user()->hasRole('Admin'))

                                    <div class="row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>{{ __('Offer type') }}</label>
                                                <select class="form-control form-control-solid form-control-lg"
                                                    id="offer_type" name="offer_type">
                                                    <option value="" selected disabled>{{ __('choose type') }}</option>
                                                    <option value="enterprice" @if (@$offer->offer_type == 'enterprice') selected @endif>{{ __('Enterprice') }}</option>
                                                    <option value="brand" @if (@$offer->offer_type == 'brand') selected @endif>{{ __('Brand') }}</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6 enterprice " id="enterprice" @if (@$offer->enterprises_id == null) style="display: none" @endif>
                                            <!--begin::Input-->
                                            <div class="form-group ">
                                                <label>{{ __('Enterprice') }}</label>
                                                <select class="form-control form-control-solid form-control-lg"
                                                    id="enterprises_id" name="enterprises_id">
                                                    <option value="" selected disabled>{{ __('choose enterprises') }}</option>
                                                    @foreach ($enterprise as $item)
                                                        <option value="{{ $item->id }}" @if (@$offer->enterprises_id == $item->id) selected @endif>
                                                            {{ $item->name_en }}</option>

                                                    @endforeach

                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>

                                        <div class="form-group col-md-6" id="brand_ajax" @if (@$offer->vendor_id == null) style="display: none" @endif>
                                            <label>{{ __('Brand') }}:</label>
                                            <select class="city custom-select " id="vendor_id" name="vendor_id">

                                                <option value="0" disabled="true" selected="true">{{ __('Brand name') }}</option>
                                            </select>
                                        </div>

                                    </div>
                                @endif
                                @if (auth()->user()->hasRole('Enterprises'))
                                    <div class="form-group col-md-6">
                                        <label>{{ __('Brand') }}:</label>
                                        <select class="city custom-select " id="vendor_id" name="vendor_id">
                                            <option value="" disabled="true" selected="true">{{ __('Brand name') }}</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}" @if (@$offer->vendor_id == $brand->id) selected @endif>
                                                    {{ $brand->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-xl-6">
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label>{{ __('Member type') }}</label>
                                            <select class="form-control form-control-solid form-control-lg" id="member_type"
                                                name="member_type">
                                                <option value="free" @if (@$offer->member_type == 'free') selected @endif>{{ __('free') }}</option>
                                                <option value="paid" @if (@$offer->member_type == 'paid') selected @endif>{{ __('paid') }}</option>
                                                <option value="all" @if (@$offer->member_type == 'all') selected @endif>{{ __('all') }}</option>

                                            </select>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <div class="col-xl-6">
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label>{{ __('Usege member') }}</label>
                                            <select class="form-control form-control-solid form-control-lg"
                                                id="usege_member" name="usege_member">
                                                <option value="limit" @if (@$offer->usege_member == 'limit') selected @endif>{{ __('limit') }}</option>
                                                <option value="unlimit" @if (@$offer->usege_member == 'unlimit') selected @endif>{{ __('unlimit') }}</option>

                                            </select>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input-->

                                <div class="row">
                                    <div class="col-xl-4">
                                        <!--begin::Select-->
                                        <div class="form-group">
                                            <label>{{ __('Usege system') }}</label>
                                            <select class="form-control form-control-solid form-control-lg"
                                                id="usege_system" name="usege_system">
                                                <option value="limit" @if (@$offer->usege_system == 'limit') selected @endif>{{ __('limit') }}</option>
                                                <option value="unlimit" @if (@$offer->usege_system == 'limit') selected @endif>{{ ('unlimit') }}</option>

                                            </select>
                                        </div>
                                        <!--end::Select-->
                                    </div>
                                    <div class="col-xl-4">
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label>{{ __('Usage member number') }}</label>
                                            <input type="number" value="{{ @$offer->usage_member_number }}"
                                                class="form-control form-control-solid form-control-lg"
                                                id="usage_member_number" name="usage_member_number"
                                                placeholder="Usage member number" />
                                        </div>
                                        <!--end::Input-->
                                    </div>

                                    <div class="col-xl-4">
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label>{{ __('Usage number system') }}</label>
                                            <input type="number" value="{{ @$offer->usage_number_system }}"
                                                class="form-control form-control-solid form-control-lg"
                                                id="usage_number_system" name="usage_number_system"
                                                placeholder="Usage member number" />
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <div class="form-group col-md-6">

                                        <div class="image-input image-input-outline" id="kt_image_4"
                                            style="background-image: url(assets/media/>users/blank.png)">
                                            <label>{{ __('Primary image') }}</label>

                                            <div class="image-input-wrapper" style="background-image: url({{ asset('images/primary_offer/'.@$offer->offerimage->primary_image)}})"></div>

                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="primary_image" id="primary_image"
                                                    accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="primary_image" id="primary_image" />
                                            </label>

                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>

                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">

                                        <div class="image-input image-input-outline" id="kt_image"
                                            style="background-image: url()">
                                            <label> {{ __('images') }}</label>

                                            <div class="image-input-wrapper" style="background-image: url()"></div>

                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" multiple name="image[]" id="image"
                                                    accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="image" id="image" />
                                            </label>

                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>

                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--end::Wizard Step 1-->
                            <!--begin::Wizard Step 2-->
                            <div class="pb-5" data-wizard-type="step-content">
                                <h4 class="mb-10 font-weight-bold text-dark">{{ __('DataTime info') }}</h4>
                                <!--begin::Input-->
                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Datetime use') }}</label>
                                            <select class="form-control form-control-solid form-control-lg"
                                                id="datetime_use" name="datetime_use">
                                                <option value="active" @if (@$offer->datetime_use == 'active') selected @endif>{{ __('active') }}</option>
                                                <option value="deactive" @if (@$offer->datetime_use == 'deactive') selected @endif>{{ __('deactive') }}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Datatime use type') }}</label>
                                            <select class="form-control form-control-solid form-control-lg"
                                                id="datatime_use_type" name="datatime_use_type">
                                                <option value="days" @if (@$offer->datatime_use_type == 'days') selected @endif>{{ __('days') }}</option>
                                                <option value="hours" @if (@$offer->datatime_use_type == 'hours') selected @endif>{{ __('hours') }}</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input-->
                                <!--begin::Input-->
                                <div class="form-group col-md-6">
                                    <label>{{ __('Datatime number') }}</label>
                                    <input type="number" value="{{ @$offer->datatime_number }}"
                                        class="form-control form-control-solid form-control-lg" id="datatime_number"
                                        name="datatime_number" placeholder="Usage member number" />
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Sort') }}</label>
                                    <input type="number" value="{{ @$offer->sort }}"
                                        class="form-control form-control-solid form-control-lg" name="sort" id="sort"
                                        placeholder="sort" />
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Start time') }}</label>
                                    <input type="datetime" class="form-control form-control-solid form-control-lg"
                                        name="start_time" value="{{ @$offer->start_time }}" id="start_time"
                                        placeholder="start_time" />
                                </div>
                                <!--end::Input-->
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>{{ __('End time') }}</label>
                                    <input type="datetime" class="form-control form-control-solid form-control-lg"
                                        name="end_time" id="end_time" value="{{ @$offer->end_time }}"
                                        placeholder="end_time" />
                                </div>
                                <!--end::Input-->

                            </div>
                            <!--end::Wizard Step 2-->
                            <!--begin::Wizard Step 3-->
                            <div class="pb-5" data-wizard-type="step-content">
                                <h4 class="mb-10 font-weight-bold text-dark">{{ __('Coupun and Points') }}</h4>
                                <!--begin::Select-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>{{ __('System Coupon use') }}</label>
                                            <select name="delivery" class="form-control form-control-solid form-control-lg"
                                                name="systemCoupon_use" id="systemCoupon_use">
                                                <option value="active" @if (@$offer->systemCoupon_use == 'active') selected @endif>{{ __('active') }}</option>
                                                <option value="deactive" @if (@$offer->systemCoupon_use == 'deactive') selected @endif>{{ __('deactive') }}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ __('Count system Coupon use') }}</label>
                                        <input type="number" value="{{ @$offer->count_systemCoupon_use }}"
                                            class="form-control form-control-solid form-control-lg"
                                            id="count_systemCoupon_use" name="count_systemCoupon_use"
                                            placeholder="Usage member number" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        <label>{{ __('points') }}</label>
                                        <input type="number" value="{{ @$offer->points }}"
                                            class="form-control form-control-solid form-control-lg" id="points"
                                            name="points" placeholder="Usage member number" />


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>{{ __('Exchange points') }}</label>
                                            <select name="delivery" class="form-control form-control-solid form-control-lg"
                                                name="exchange_points" id="exchange_points">
                                                <option value="active" @if (@$offer->exchange_points == 'active') selected @endif>{{ __('active') }}</option>
                                                <option value="deactive" @if (@$offer->exchange_points == 'deactive') selected @endif>{{ __('deactive') }}</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{ __('Exchange points number') }}</label>
                                        <input type="number" value="{{ @$offer->exchange_points_number }}"
                                            class="form-control form-control-solid form-control-lg"
                                            id="exchange_points_number" name="exchange_points_number"
                                            placeholder="Usage member number" />
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>{{ __('Exchange cash') }}</label>
                                            <select name="delivery" class="form-control form-control-solid form-control-lg"
                                                name="exchange_cash" id="exchange_cash">
                                                <option value="active" @if (@$offer->exchange_cash == 'active') selected @endif>{{ __('active') }}</option>
                                                <option value="deactive" @if (@$offer->exchange_cash == 'deactive') selected @endif>{{ __('deactive') }}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ __('Exchange cash number') }}</label>
                                        <input type="number" value="{{ @$offer->exchange_cash_number }}"
                                            class="form-control form-control-solid form-control-lg"
                                            id="exchange_cash_number" name="exchange_cash_number"
                                            placeholder="Usage member number" />
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>{{ __('Payment type') }}</label>
                                            <select name="delivery" class="form-control form-control-solid form-control-lg"
                                                name="payment_type" id="payment_type">
                                                <option value="cash" @if (@$offer->payment_type == 'cash') selected @endif>{{ __('cash') }}</option>
                                                <option value="visa" @if (@$offer->payment_type == 'visa') selected @endif>{{ __('visa') }}</option>

                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>{{ __('Offer type') }}</label>
                                            <select name="delivery" class="form-control form-control-solid form-control-lg"
                                                name="offer_type_2" id="offer_type_2">
                                                <option value="buyOneGetOne" @if (@$offer->offertype->offer_type == 'buyOneGetOne') selected @endif>{{ __('buyOneGetOne') }}</option>
                                                <option value="special_discount" @if (@$offer->offertype->offer_type == 'special_discount') selected @endif>{{ __('special_discount') }}
                                                </option>
                                                <option value="general_offer" @if (@$offer->offertype->offer_type == 'general_offer') selected @endif>{{ __('general_offer') }}
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ __('Price after discount') }}</label>
                                        <input type="number" class="form-control form-control-solid form-control-lg"
                                            id="price_after_discount"
                                            value="{{ @$offer->offertype->price_after_discount }}"
                                            name="price_after_discount" placeholder="Price after discount" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ __('Price befor discount') }}</label>
                                        <input type="number" class="form-control form-control-solid form-control-lg"
                                            id="price_befor_discount"
                                            value="{{ @$offer->offertype->price_befor_discount }}"
                                            name="price_befor_discount" placeholder="Price befor discount" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ __('Discount value') }}</label>
                                        <input type="number" class="form-control form-control-solid form-control-lg"
                                            id="discount_value" value="{{ @$offer->offertype->discount_value }}"
                                            name="discount_value" placeholder="Discount value" />
                                    </div>
                                </div>

                                <!--end::Select-->
                                <!--begin::Select-->

                                <!--end::Select-->
                                <!--begin::Select-->

                                <!--end::Select-->
                            </div>
                            <!--end::Wizard Step 3-->
                            <!--begin::Wizard Step 4-->
                            <div class="pb-5" data-wizard-type="step-content">
                                <h4 class="mb-10 font-weight-bold text-dark">{{ __('Sort Info') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_0" value="{{ @$offer->offerday->from_0 }}" name="from_0"
                                            placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label><label>{{ __('time to') }}</label></label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_0" value="{{ @$offer->offerday->to_0 }}" name="to_0"
                                            placeholder="<label>{{ __('time to') }}</label>" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_1" value="{{ @$offer->offerday->from_1 }}" name="from_1"
                                            placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label><label>{{ __('time to') }}</label></label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_1" value="{{ @$offer->offerday->to_1 }}" name="to_1"
                                            placeholder="<label>{{ __('time to') }}</label>" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_2" value="{{ @$offer->offerday->from_2 }}" name="from_2"
                                            placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label><label>{{ __('time to') }}</label></label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_2" value="{{ @$offer->offerday->to_2 }}" name="to_2"
                                            placeholder="<label>{{ __('time to') }}</label>" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_3" value="{{ @$offer->offerday->from_3 }}" name="from_3"
                                            placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label><label>{{ __('time to') }}</label></label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_3" value="{{ @$offer->offerday->to_3 }}" name="to_3"
                                            placeholder="<label>{{ __('time to') }}</label>" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_4" value="{{ @$offer->offerday->from_4 }}" name="from_4"
                                            placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label><label>{{ __('time to') }}</label></label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_4" value="{{ @$offer->offerday->to_4 }}" name="to_4"
                                            placeholder="<label>{{ __('time to') }}</label>" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_5" value="{{ @$offer->offerday->from_5 }}" name="from_5"
                                            placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label><label>{{ __('time to') }}</label></label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_5" value="{{ @$offer->offerday->to_5 }}" name="to_5"
                                            placeholder="<label>{{ __('time to') }}</label>" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_6" value="{{ @$offer->offerday->from_6 }}" name="from_6"
                                            placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label><label>{{ __('time to') }}</label></label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_6" value="{{ @$offer->offerday->to_6 }}" name="to_6"
                                            placeholder="<label>{{ __('time to') }}</label>" />
                                    </div>
                                </div>

                            </div>
                            <!--end::Wizard Step 4-->
                            <!--begin::Wizard Step 5-->
                            <div class="pb-5" data-wizard-type="step-content">
                                <!--begin::Section-->
                                <h4 class="mb-10 font-weight-bold text-dark">{{ __('Description and Terms') }}</h4>

                                <div class="separator separator-dashed my-5"></div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <div class="form-group">
                                    <label>{{ __('Desc ar') }}</label>

                                    <textarea class="form-control" name="desc_ar" id="desc_ar" cols="5"
                                        rows="5">{{ @$offer->desc_ar }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Desc en') }}</label>

                                    <textarea class="form-control" name="desc_en" id="desc_en" cols="5"
                                        rows="5">{{ @$offer->desc_en }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Terms ar') }}</label>

                                    <textarea class="form-control" name="terms_ar" id="terms_ar" cols="5"
                                        rows="5">{{ @$offer->terms_ar }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Terms en') }}</label>

                                    <textarea class="form-control" name="terms_en" id="terms_en" cols="5"
                                        rows="5">{{ @$offer->terms_ar }}</textarea>
                                </div>
                            </div>
                            <!--end::Wizard Step 5-->
                            <!--begin::Wizard Actions-->
                            <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                <div class="mr-2">
                                    <button type="button"
                                        class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4"
                                        data-wizard-type="action-prev">{{ __('Previous') }}</button>
                                </div>
                                <div>
                                    {{-- <button type="button" onclick="performStore()" class="btn btn-primary mr-2">Submit</button> --}}

                                    <button type="button"
                                        class="btn btn-success font-weight-bolder text-uppercase px-9 py-4"
                                        onclick="performStore()" data-wizard-type="action-submit">{{ __('Submit') }}</button>

                                    <button type="button"
                                        class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4"
                                        data-wizard-type="action-next">{{ __('Next') }}</button>
                                </div>
                            </div>
                            <!--end::Wizard Actions-->
                        </form>
                        <!--end::Wizard Form-->
                    </div>
                </div>
                <!--end::Wizard Body-->
            </div>
            <!--end::Wizard-->
        </div>
        <!--end::Wizard-->
    </div>
@endsection
@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDL_Iurzw7shb69C_H4GLxzETOgHWrzHEw"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script>
        @if (auth()->user()->hasRole('Admin'))
        
            $(document).ready(function() {
        
        
            let enterbrice_id = '{{ @$offer->enterprises_id }}';
        
            $.ajax({
            type: "get",
            url: '{{ route('get_brands', app()->getLocale()) }}',
            data: {
            "enteprice_id": enterbrice_id,
            },
            success: function(data) {
        
            $('#brand_ajax').css("display", "block")
        
            $('#vendor_id').html(new Option('chose brand', '0'));
            for (var i = 0; i < data.length; i++) { $('#vendor_id').append(new Option(data[i].name_en, data[i].id)); } } }); });
                @endif

        $('#offer_type').on('change', function() {
            let val = this.value;
            if (val == 'enterprice') {
                $('.enterprice').css("display", "block")
                $('.brand_class').css("display", "none")

            } else if (val == 'brand') {
                $('.enterprice').css("display", "none")

                $.ajax({
                    type: "get",
                    url: '{{ route('get_brands', app()->getLocale()) }}',
                    data: {
                        "enteprice_id": null
                    },
                    success: function(data) {

                        $('#brand_ajax').css("display", "block")

                        $('#vendor_id').html(new Option('chose brand', '0'));
                        for (var i = 0; i < data.length; i++) {
                            $('#vendor_id').append(new Option(data[i].name_en,
                                data[i].id));

                        }
                    }
                });

            }

        });
        $('#enterprises_id').on('change', function() {
            let valenterprice = this.value;
            $.ajax({
                type: "get",
                url: '{{ route('get_brands', app()->getLocale()) }}',
                data: {
                    "enteprice_id": valenterprice
                },
                success: function(data) {

                    $('#brand_ajax').css("display", "block")

                    $('#vendor_id').html(new Option('chose brand', '0'));
                    for (var i = 0; i < data.length; i++) {
                        $('#vendor_id').append(new Option(data[i].name_en,
                            data[i].id));

                    }
                }
            });



        });
    </script>
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <script>
        var avatar4 = new KTImageInput('kt_image_4');

        avatar4.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Image successfully canceled !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        avatar4.on('change', function(imageInput) {
            swal.fire({
                title: 'Image successfully changed !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        avatar4.on('remove', function(imageInput) {
            swal.fire({
                title: 'Image successfully removed !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Got it!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });
    </script>

    <script>
        var avatar4 = new KTImageInput('kt_image');

        avatar4.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Image successfully canceled !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        avatar4.on('change', function(imageInput) {
            swal.fire({
                title: 'Image successfully changed !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        avatar4.on('remove', function(imageInput) {
            swal.fire({
                title: 'Image successfully removed !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Got it!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>

    <script>
        function performStore() {
            let formData = new FormData();
            if (document.getElementById('enterprises_id') != null && document.getElementById('enterprises_id') != 0) {
                formData.append('enterprises_id', document.getElementById('enterprises_id').value);
            }
            if (document.getElementById('offer_type') != null  ) {
                formData.append('offer_type', document.getElementById('offer_type').value);
            }
            if (document.getElementById('vendor_id') != null && document.getElementById('vendor_id') != 0 ) {
                formData.append('vendor_id', document.getElementById('vendor_id').value);
            }
            if (document.getElementById('primary_image') != null) {
                formData.append('primary_image', document.getElementById('primary_image').files[0]);

            }





            let TotalImages = $('#image')[0].files.length; //Total Images
            let images = $('#image')[0];
            if (TotalImages > 0) {
                for (let i = 0; i < TotalImages; i++) {
                    formData.append('image' + i, images.files[i]);
                    formData.append('TotalImages', TotalImages);

                }
            }


            formData.append('name_ar', document.getElementById('name_ar').value);
            formData.append('name_en', document.getElementById('name_en').value);
            formData.append('desc_en', document.getElementById('desc_en').value);
            formData.append('desc_ar', document.getElementById('desc_ar').value);
            formData.append('terms_ar', document.getElementById('terms_ar').value);
            formData.append('terms_en', document.getElementById('terms_en').value);
            formData.append('member_type', document.getElementById('member_type').value);
            formData.append('usege_member', document.getElementById('usege_member').value);
            formData.append('usage_member_number', document.getElementById('usage_member_number').value);
            formData.append('usege_system', document.getElementById('usege_system').value);
            formData.append('usage_number_system', document.getElementById('usage_number_system').value);

            formData.append('datetime_use', document.getElementById('datetime_use').value);
            formData.append('datatime_use_type', document.getElementById('datatime_use_type').value);
            formData.append('datatime_number', document.getElementById('datatime_number').value);
            formData.append('points', document.getElementById('points').value);
            formData.append('exchange_points', document.getElementById('exchange_points').value);
            formData.append('exchange_points_number', document.getElementById('exchange_points_number').value);
            formData.append('exchange_cash', document.getElementById('exchange_cash').value);
            formData.append('count_systemCoupon_use', document.getElementById('count_systemCoupon_use').value);


            formData.append('exchange_cash_number', document.getElementById('exchange_cash_number').value);
            formData.append('payment_type', document.getElementById('payment_type').value);
            formData.append('sort', document.getElementById('sort').value);
            formData.append('start_time', document.getElementById('start_time').value);
            formData.append('end_time', document.getElementById('end_time').value);
            formData.append('offer_type_2', document.getElementById('offer_type_2').value);
            formData.append('price_after_discount', document.getElementById('price_after_discount').value);
            formData.append('price_befor_discount', document.getElementById('price_befor_discount').value);
            formData.append('discount_value', document.getElementById('discount_value').value);
            formData.append('from_0', document.getElementById('from_0').value);
            formData.append('to_0', document.getElementById('to_0').value);
            formData.append('from_1', document.getElementById('from_1').value);
            formData.append('to_1', document.getElementById('to_1').value);
            formData.append('from_2', document.getElementById('from_2').value);
            formData.append('to_2', document.getElementById('to_2').value);
            formData.append('from_3', document.getElementById('from_3').value);
            formData.append('to_3', document.getElementById('to_3').value);
            formData.append('from_4', document.getElementById('from_4').value);
            formData.append('to_4', document.getElementById('to_4').value);
            formData.append('from_5', document.getElementById('from_5').value);
            formData.append('to_5', document.getElementById('to_5').value);
            formData.append('from_6', document.getElementById('from_6').value);
            formData.append('to_6', document.getElementById('to_6').value);




            update("{{ route('update-offer', ['locale' => app()->getLocale(), @$offer->id]) }}", formData)
        }
    </script>
    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('js/pages/custom/wizard/wizard-1.js') }}"></script>
@endsection
