@extends('layout.default')

@section('content')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            Create Privacy
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <form class="form" method="post" method="{{ route('privacy.store',app()->getLocale()) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                {{-- <div class="form-group col-md-12">
                    <select class="form-control select2 vendor" id="kt_select2_1" name="param">
                        <option value='null'>{{ __('chose Vendor') }}</option>
                        @foreach ($vendor as $item)
                        <option value={{$item->id}}>{{$item->name_en}}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="form-group col-md-6">
                    <label> {{ __('title ar') }} :</label>
                    <input type="text" name="title_ar" id="name_ar" class="form-control form-control-solid"
                        placeholder="Enter Title" required />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('title en') }} :</label>
                    <input type="text" name="title_en" id="name_en" class="form-control form-control-solid"
                        placeholder="Enter Title" required />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('Content ar') }} :</label>
                    <textarea name="content_ar" class="form-control" required id="" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('Content en') }} :</label>
                    <textarea name="content_en" class="form-control" required id="" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group col-md-3">
                    <label>{{ __('sort') }} :</label>
                    <input type="number" name="sort" id="sort" class="form-control form-control-solid"
                        placeholder="Enter sort" required />
                </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
            </div>
    </form>
</div>
</div>
@endsection
