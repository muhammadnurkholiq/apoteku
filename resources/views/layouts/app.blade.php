<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex flex-row justify-between items-center">
                    {{ $header }}
                </div>
            </header>
        @endif

        {{-- notification --}}
        @if (session('Success'))
            <div id="notification" class="fixed top-25 right-0 z-50 w-1/6 m-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('Success') }}</span>
                    <button onclick="closeNotification()" class="absolute top-0 right-0 px-4 py-3 focus:outline-none">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a1 1 0 0 1-1.414 0L10 11.414l-2.929 2.435a1 1 0 1 1-1.237-1.566l2.929-2.435-2.93-2.434a1 1 0 0 1 1.237-1.566L10 8.586l2.929-2.434a1 1 0 0 1 1.414 1.414L11.414 10l2.93 2.434a1 1 0 0 1 0 1.415z" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif


        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script>
        function closeNotification() {
            document.getElementById('notification').style.display = 'none';
        }
    </script>

</body>

</html>
