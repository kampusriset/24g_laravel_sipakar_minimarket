<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Dashboard - MartIn')
    </title>

    {{-- CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-[#f7f1e8] text-gray-800">

    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        @include('dashboard.partials.sidebar')


        {{-- AREA KONTEN --}}
        <div class="flex-1 min-w-0 flex flex-col">

            {{-- NAVBAR --}}
            @include('dashboard.partials.navbar')


            {{-- CONTENT --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8">

                @yield('dashboard-content')

            </main>

        </div>

    </div>


    {{-- SCRIPT --}}
    @stack('scripts')

</body>

</html>