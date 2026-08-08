<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'MartIn')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-[#f7f1e8] text-gray-800">

    <div class="min-h-screen">

        {{-- SIDEBAR TETAP --}}
        <aside class="fixed left-0 top-0 w-64 h-screen z-40">

            @include('dashboard.partials.sidebar')

        </aside>


        {{-- AREA KANAN --}}
        <div class="ml-64 min-h-screen">

            {{-- NAVBAR TETAP DI ATAS --}}
            <header class="fixed top-0 right-0 left-64 h-20 z-30">

                @include('dashboard.partials.navbar')

            </header>


            {{-- ISI HALAMAN --}}
            <main class="pt-20 min-h-screen">

                <div class="p-8">

                    @yield('dashboard-content')

                </div>

            </main>

        </div>

    </div>

    @stack('scripts')

</body>

</html>