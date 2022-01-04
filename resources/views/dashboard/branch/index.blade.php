@extends('layout.default')
@section('content')
<div class="
card card-docs mb-2">

    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <h2 class="mb-3">All Branches</h2>

        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
            id="kt_datatable">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Active Branch') }}</th>
                    <th>{{ __('Deactive Branch') }}</th>
                    <th>{{ __('Action') }}</th>
                 </tr>
            </thead>
            <tbody>
                @foreach ($vendors as $item)
                    
                 <tr>
                    <td>{{$item->name_ar}}</td>
                    <td>{{$item->branches->where('status','active')->count()}}</td>
                    <td>{{$item->branches->where('status','deactive')->count()}}</td>
                 
                    <td class="pr-0 text-left">
                 
                      
                        <a href="{{ route('vendor.get_branch', [app()->getLocale(),$item->id]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
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

<link href="{{asset('/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
<script src="{{ asset('/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('crudjs/crud.js') }}"></script>
<script>
    
     
</script>
<script>
   function performdelete(id) {
            var url = '{{ route('branch.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
</script>

@endsection