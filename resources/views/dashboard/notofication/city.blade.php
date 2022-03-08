@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All Promotion') }}</h2>
            <div class="mt-10">

                <div class="row">
                    @foreach ($cities as $item)
                    <div class="col-md-3 bg-light-primary w-100 h-100 px-6 py-8 rounded-2 mb-7 mr-7 ml-7 ">
                        <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                        <div class=" symbol-75px mb-5 text-center">
                            <img src="{{  $item->image  }}" width="80" height="80" alt="">
                        </div>
                        <!--end::Svg Icon-->
                        <a href="" style="font-weight: bold;" class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">{{ $item->city_name }}</a>
                    </div>
                        
                    @endforeach


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
            $(function() {

            });

            function performdelete(id) {
                var url = '{{ route('code.destroy', [':id', 'locale' => app()->getLocale()]) }}';
                url = url.replace(':id', id);


                confirmDestroy(url)
            }
        </script>
    @endsection
