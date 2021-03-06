<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }}
    {{ Metronic::printClasses('html') }}>

<head>
    <meta charset="utf-8" />

    {{-- Title Section --}}
    <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />
    <link href="{{ asset('/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    {{-- Fonts --}}
    {{ Metronic::getGoogleFontsInclude() }}




    {{-- Global Theme Styles (used by all pages) --}}
    @foreach (config('layout.resources.css') as $style)
        <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}"
            rel="stylesheet" type="text/css" />
    @endforeach

    {{-- Layout Themes (used by all pages) --}}
    @foreach (Metronic::initThemes() as $theme)
        <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}"
            rel="stylesheet" type="text/css" />
    @endforeach
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">

    {{-- Includable CSS --}}
    @yield('styles')
    <style>
        ol.breadcrumb {
            padding: 10px 16px;
            list-style: none;
            background-color: #fff;
        }

        ol.breadcrumb li {
            display: inline;
            font-size: 18px;
        }

        ol.breadcrumb li+li:before {
            padding: 8px;
            color: black;
            content: "/\00a0";
        }

        ol.breadcrumb li a {
            color: #0275d8;
            text-decoration: none;
        }

        ol.breadcrumb li a:hover {
            color: #01447e;
            text-decoration: underline;
        }

        .handle {
            min-width: 18px;
            /* background: #747474; */
            height: 15px;
            display: inline-block;
            cursor: move;
            margin-right: 10px;
        }

    </style>
</head>

<body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>

    @if (config('layout.page-loader.type') != '')
        @include('layout.partials._page-loader')
    @endif

    @include('layout.base._layout')

    <script>
        var HOST_URL = "{{ route('quick-search') }}";
    </script>

    {{-- Global Config (global config for global JS scripts) --}}
    <script>
        var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!};
    </script>

    {{-- Global Theme JS Bundle (used by all pages) --}}
    @foreach (config('layout.resources.js') as $script)
        <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach

    {{-- Includable JS --}}
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <script src="{{ asset('/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script>
        $(function() {
            $("#kt_datatable").DataTable({
                "pagingType": "full_numbers",
                // "scrollX": true

            });
        });
    </script>
    @yield('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
    <script>
        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
            let switchery = new Switchery(html, {
                size: 'small'
            });
        });
    </script>

</body>

</html>
