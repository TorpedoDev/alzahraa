<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
         <link rel="preconnect" href="https://fonts.googleapis.com"> 
         <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
         <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet"> 
    <meta name="Keywords"
        content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4" />
    @include('layout.inc.head')

    <style>
        @media print {

            body {
                background-color: #ffffff !important;
                color: #000000 !important;
            }

            * {
                background: transparent !important;
                /* Remove dark backgrounds */
                color: #000000 !important;
                /* Ensure readable text */
                box-shadow: none !important;
            }

            #header,
            #footer,
            #nav,
            .no-print {
                display: none !important;
            }

            #print * {
                visibility: visible;
                /* display: block !important; */
                margin: 0;
                padding: 3px;
                /* width: 100%; */
            }

            table th:last-child {
                display: none;
            }

            table td:last-child {
                display: none;
            }
        }

        /* This code written by me ENG-Mohammed Fayez */

        @media (max-width: 768px) {
            .button-group {
                display: flex;
                justify-content: flex-start;
                gap: 8px;
                padding-top: 8px;
            }
        }

        body {
            font-family: "Cairo", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
            font-variation-settings:
                "slnt" 0;
        }
    </style>





<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>


</head>

<body class="main-body app sidebar-mini"> <!-- We can add class .dark-theme in body to convert to dark mode -->
    <script>
        if (localStorage.theme === 'dark') {
            document.body.classList.add('dark-theme')
        } else {
            document.body.classList.remove('dark-theme')
        }
    </script>
    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ URL::asset('assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->
    @include('layout.inc.main-sidebar')
    <!-- main-content -->
    <div class="main-content app-content">
        @include('layout.inc.main-header')
        <!-- container -->
        <div class="container-fluid">
            @if (Route::is('login'))
                @yield('content')
            @else
                @yield('page-header')
                @yield('content')
                @include('layout.inc.sidebar')
                @include('layout.inc.models')
                @include('layout.inc.footer')
                @include('layout.inc.footer-scripts')
            @endif

            <script>
                $("#theme").click(function() {
                    if (document.body.classList.contains("dark-theme")) {
                        document.querySelector('body').classList.remove('dark-theme');
                        localStorage.setItem("theme", "light")

                    } else {
                        document.body.classList.add("dark-theme");
                        localStorage.setItem("theme", "dark")

                    }
                });
            </script>


            <!-- Select2 JS -->
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>
            <script>
                $(document).ready(function() {
                    $('.select2').select2({
                        width: '100%',
                    });

                    $('.select2-selection--single').css('height' , '40px');

                });
            </script>
<script>
    flatpickr("#date", {
        locale: "ar", // Set Arabic locale
        dateFormat: "Y-m-d", // Customize the format if needed
        touch: true,
        disableMobile: true
        
    });
</script>



<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
<script>
    $('#redirectMSG').fadeOut(10000);
</script>
@stack('css')
@stack('scripts')
</body>

</html>
