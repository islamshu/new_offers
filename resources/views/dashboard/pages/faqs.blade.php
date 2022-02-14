@extends('layout.default')

@section('content')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            FAQS 
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <div>
    <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
    >
    <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>{{ __('sort') }}</th>
            <th>{{ __('question') }}</th>
            <th>{{ __('Answer') }}</th>
          
            {{-- <th>Actions</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($faqs as $item)
        
        
         <tr>
             {{-- {{ dd($item) }} --}}
             
             
           
            <td>{{$item->sort}}</td>
            @if(app()->getLocale() == 'ar')

            <td>{{$item->qus_ar}}</td>
            <td>{!! $item->answer_ar !!}</td>
            @else 
            <td>{{$item->qus_en}}</td>
            <td>{!! $item->answer_en !!}</td>
            @endif
           
       
            @endforeach


    </tbody>
 
</table>
</div>
    <form class="form" method="post" method="{{ route('faqs.store',app()->getLocale()) }}" enctype="multipart/form-data">
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
                    <label> {{ __('question ar') }} :</label>
                    <input type="text" name="qus_ar" id="qus_ar" class="form-control form-control-solid"
                        placeholder="Enter question" required />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('question en') }} :</label>
                    <input type="text" name="qus_en" id="qus_en" class="form-control form-control-solid"
                        placeholder="Enter question" required />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('Answer ar') }} :</label>
                    <textarea name="answer_ar" class="form-control" required id="" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('Answer en') }} :</label>
                    <textarea name="answer_en" class="form-control" required id="" cols="30" rows="5"></textarea>
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
