<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','MartIn AI')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('partials.sidebar')

    {{-- Content --}}
    <div class="flex-1 flex flex-col">

        {{-- Navbar --}}
        @include('partials.navbar')

        <main class="p-6">

            @yield('content')

        </main>

    </div>

</div>

</body>

</html>