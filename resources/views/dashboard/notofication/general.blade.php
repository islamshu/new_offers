@extends('layout.default')
@section('content')
    <div class="
card card-docs mb-2">
        <div class="card-header">


            <ol class="breadcrumb">
                <li><a href="/{{ get_lang() }}/home"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>

                <li class="active">{{ __('All Notofication') }}</li>
            </ol>

        </div>
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <div style="float:right;">
                <a href="{{ route('general_notofication.create', app()->getLocale()) }}"
                    class="btn btn-info">{{ __('Create new notofication') }}</a>
            </div>
            <br>
            <h2 class="mb-3">{{ __('All Notofication') }}</h2>
            @if(Session::has('success'))
    <div class="row mr-2 ml-2">

            <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"
                    id="type-error">{{Session::get('success')}}
            </button>
    </div>
@endif
            <table class=" table ">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Body') }}</th>
                        <th>{{ __('vendor') }}</th>
                        <th>{{ __('offer') }}</th>
                        <th>{{ __('created at') }}</th>
                        <th>{{ __('action') }}</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($notofications as $item)
                        <tr>
                            <td>{{ @$item->title_en }}</td>
                            <td>{{ @$item->body_en }}</td>
                            <td>{{ @$item->vendor->name_en != null ? @$item->vendor->name_en : '-' }}</td>
                            <td>{{ @$item->offer->name_en != null ? @$item->offer->name_en : '-' }}</td>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#myModal" class="btn btn-outline-primary"
                                    onclick="make('{{ $item->id }}')"><i class="fa fa-share"></i>
                                </a>
                                {{-- <form action="{{ route('resend_gendernotofication',[get_lang(),$item->id]) }}" method="post">
                                @csrf
                                <button type="submit"><i class="fa fa-share"></i></button>
                                </form> --}}
                        </tr>
                    @endforeach


                </tbody>

            </table>
            {{ $notofications->links() }}


        </div>
    </div>
@endsection
<div class="modal fase" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="staticBackdropLabel">
                    {{ __('Edit and Resend Notofication') }}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="addToCart-modal-body">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn ok">Ok</button>
            </div>
        </div>
    </div>
</div>

@section('styles')
    <link href="{{ asset('/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
    <script src="{{ asset('/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script>


    </script>
    <script>
        function performdelete(id) {
            var url = '{{ route('currency.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
    </script>
    <script>
        function make(id) {
            $("#myModal").show();

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'post',
                url: "{{ route('shownotoficationmodel', app()->getLocale()) }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },

                success: function(data) {

                    $('#addToCart-modal-body').html(data);


                }
            });

        }
    </script>
@endsection
