<div class="flex bg-gray-100 min-h-screen">

    {{-- Sidebar --}}
    @include('dashboard.sidebar')

    {{-- Content --}}
    <div class="flex-1 ml-64">

        {{-- Navbar --}}
        @include('dashboard.navbar')

        <main class="p-8">

            @yield('dashboard-content')

        </main>

    </div>

</div>