<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>{{ config('app.name', 'LAKON') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&display=swap" rel="stylesheet" />

        <link rel="icon"
        href="{{asset('images/Logo-Cilacap.png')}}"
        type="image/png">

    </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <script>
            if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
                document.querySelector('html').classList.remove('dark');
                document.querySelector('html').style.colorScheme = 'light';
            } else {
                document.querySelector('html').classList.add('dark');
                document.querySelector('html').style.colorScheme = 'dark';
            }
        </script>
        <script src="https://kit.fontawesome.com/ac8548371f.js" crossorigin="anonymous"></script>

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

        <!-- data tables -->

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.8.1"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    </head>
    <body
        class="font-inter antialiased overflow-hidden bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-400"
        :class="{ 'sidebar-expanded': sidebarExpanded }"
        x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }"
        x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))"
    >
            <!-- Success Message -->

       @if (session('success'))
            <script>
            Toastify({
                escapeMarkup: false,
                text: '<i class="fas fa-check-circle mr-2"></i>' + "{{ session('success') }}",
                duration: 3000,
                gravity: "top",
                position: "right",
                style: {
                    background: "linear-gradient(145deg, rgba(40, 167, 69, 0.8), rgba(25, 135, 84, 0.8))",
                    fontWeight: "500",
                    padding: "20px 32px",
                    borderRadius: "8px",
                    boxShadow: "0 4px 12px rgba(0, 0, 0, 0.1)",
                    fontSize: "16px",
                    color: "#ffffff"
                },
                onClick: function(){} // Callback after click
            }).showToast();
            </script>
        @endif

        @if ($errors->any())
            <script>
            Toastify({
                escapeMarkup: false,
                text: '<i class="fas fa-exclamation-triangle mr-2"></i>' + "{{ $errors->first() }}",
                duration: 4000,
                gravity: "top",
                position: "right",
                style: {
                    background: "linear-gradient(145deg, rgba(220, 53, 69, 0.8), rgba(200, 35, 51, 0.8))",
                    fontWeight: "500",
                    padding: "20px 32px",
                    borderRadius: "8px",
                    boxShadow: "0 4px 12px rgba(0, 0, 0, 0.15)",
                    fontSize: "16px",
                    color: "#ffffff"
                },
                close: true,
                stopOnFocus: true
            }).showToast();
            </script>
        @endif

        @if (session('error'))
            <script>
            Toastify({
                escapeMarkup: false,
                text: '<i class="fas fa-exclamation-circle mr-2"></i>' + "{{ session('error') }}",
                duration: 4000,
                gravity: "top",
                position: "right",
                style: {
                    background: "linear-gradient(145deg, rgba(220, 53, 69, 0.8), rgba(200, 35, 51, 0.8))",
                    fontWeight: "500",
                    padding: "20px 32px",
                    borderRadius: "8px",
                    boxShadow: "0 4px 12px rgba(0, 0, 0, 0.15)",
                    fontSize: "16px",
                    color: "#ffffff"
                },
                close: true,
                stopOnFocus: true
            }).showToast();
            </script>
        @endif 

        <script>
            if (localStorage.getItem('sidebar-expanded') == 'true') {
                document.querySelector('body').classList.add('sidebar-expanded');
            } else {
                document.querySelector('body').classList.remove('sidebar-expanded');
            }
        </script>

        <!-- Page wrapper -->
        <div class="flex h-[100dvh] overflow-hidden">

            <x-app.sidebar :variant="$attributes['sidebarVariant']" />

            <!-- Content area -->
            <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden @if($attributes['background']){{ $attributes['background'] }}@endif" x-ref="contentarea">

                <x-app.header :variant="$attributes['headerVariant']" />

                <main class="grow">
                    {{ $slot }}
                </main>

            </div>

        </div>
       

        @livewireScriptConfig

        
    </body>
</html>
