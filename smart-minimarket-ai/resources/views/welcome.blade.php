<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Next Market - Belanja Mudah dan Nyaman</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="bg-[#faf2e8] text-black antialiased">


    <!-- ================= NAVBAR ================= -->

    <header class="w-full px-5 sm:px-8 lg:px-12 pt-5">

        <nav
            class="max-w-7xl mx-auto
                   bg-[#fdf7ef]
                   border border-white/80
                   rounded-full
                   px-5 sm:px-7
                   py-3
                   shadow-[0_8px_25px_rgba(0,0,0,0.05)]
                   flex items-center justify-between"
        >

            <!-- LOGO -->

            <a
                href="{{ url('/') }}"
                class="flex items-center gap-1"
            >

                <span
                    class="text-2xl sm:text-3xl
                           font-extrabold
                           tracking-[-1.5px]"
                >
                    Next
                </span>

                <span
                    class="text-2xl sm:text-3xl
                           font-extrabold
                           tracking-[-1.5px]
                           text-[#FFD400]
                           [text-shadow:1px_1px_0px_#111]"
                >
                    Market
                </span>

            </a>


            <!-- MENU -->

            <div class="hidden md:flex items-center gap-8">

                <a
                    href="#home"
                    class="text-sm font-medium
                           text-gray-700
                           hover:text-black
                           transition"
                >
                    Home
                </a>

                <a
                    href="#about"
                    class="text-sm font-medium
                           text-gray-700
                           hover:text-black
                           transition"
                >
                    About
                </a>

                <a
                    href="#features"
                    class="text-sm font-medium
                           text-gray-700
                           hover:text-black
                           transition"
                >
                    Features
                </a>

                <a
                    href="#contact"
                    class="text-sm font-medium
                           text-gray-700
                           hover:text-black
                           transition"
                >
                    Contact
                </a>

            </div>


            <!-- AUTH -->

            <div class="flex items-center gap-2 sm:gap-3">

                <a
                    href="{{ route('login') }}"
                    class="hidden sm:block
                           px-5 py-2.5
                           text-sm font-semibold
                           text-black
                           hover:text-[#c8a900]
                           transition"
                >
                    Login
                </a>

                <a
                    href="{{ route('register') }}"
                    class="px-5 sm:px-6
                           py-2.5
                           rounded-full
                           bg-[#FFD400]
                           text-sm
                           font-bold
                           shadow-[4px_5px_0px_#bdb9b3]
                           hover:-translate-y-[1px]
                           hover:shadow-[4px_6px_0px_#bdb9b3]
                           transition"
                >
                    Register
                </a>

            </div>

        </nav>

    </header>



    <!-- ================= HERO ================= -->

    <main id="home">

        <section
            class="max-w-7xl mx-auto
                   px-6 sm:px-10 lg:px-12
                   pt-16 sm:pt-20 lg:pt-24
                   pb-20"
        >

            <div
                class="grid
                       lg:grid-cols-2
                       gap-12 lg:gap-16
                       items-center"
            >


                <!-- LEFT -->

                <div class="text-center lg:text-left">

                    <!-- SMALL LABEL -->

                    <div
                        class="inline-flex
                               items-center
                               gap-2
                               px-4 py-2
                               rounded-full
                               bg-white
                               shadow-[0_5px_15px_rgba(0,0,0,0.05)]
                               text-sm
                               font-medium
                               text-gray-600
                               mb-6"
                    >

                        <span
                            class="w-2.5 h-2.5
                                   rounded-full
                                   bg-[#FFD400]"
                        ></span>

                        Selamat datang di NextMarket

                    </div>


                    <!-- HEADING -->

                    <h1
                        class="text-5xl
                               sm:text-6xl
                               lg:text-7xl
                               font-extrabold
                               tracking-[-3px]
                               leading-[0.98]"
                    >

                        Belanja Mudah,

                        <br>

                        <span
                            class="text-[#FFD400]
                                   [text-shadow:2px_2px_0px_#111]"
                        >
                            Cepat & Nyaman.
                        </span>

                    </h1>


                    <!-- DESCRIPTION -->

                    <p
                        class="mt-7
                               max-w-xl
                               mx-auto lg:mx-0
                               text-base
                               sm:text-lg
                               leading-7
                               text-gray-600"
                    >
                        Temukan berbagai kebutuhan sehari-hari
                        dengan mudah di Mart In. Nikmati pengalaman
                        berbelanja yang sederhana, cepat, dan nyaman.
                    </p>


                    <!-- BUTTON -->

                    <div
                        class="mt-9
                               flex
                               flex-col sm:flex-row
                               items-center lg:justify-start
                               justify-center
                               gap-4"
                    >

                        <a
                            href="{{ route('register') }}"
                            class="w-full sm:w-auto
                                   min-w-[190px]
                                   text-center
                                   px-8 py-4
                                   rounded-full
                                   bg-[#FFD400]
                                   text-black
                                   font-bold
                                   text-lg
                                   shadow-[6px_7px_0px_#bdb9b3]
                                   hover:-translate-y-[2px]
                                   hover:shadow-[6px_9px_0px_#bdb9b3]
                                   transition"
                        >
                            Mulai Sekarang
                        </a>


                        <a
                            href="#features"
                            class="w-full sm:w-auto
                                   min-w-[150px]
                                   text-center
                                   px-8 py-4
                                   rounded-full
                                   bg-white
                                   text-black
                                   font-semibold
                                   shadow-[5px_6px_0px_#d0cbc5]
                                   hover:-translate-y-[2px]
                                   transition"
                        >
                            Lihat Fitur
                        </a>

                    </div>

                </div>



                <!-- RIGHT / VISUAL -->

                <div
                    class="flex
                           justify-center
                           lg:justify-end"
                >

                    <div
                        class="relative
                               w-[300px]
                               sm:w-[380px]
                               lg:w-[450px]
                               aspect-square"
                    >

                        <!-- BACKGROUND CIRCLE -->

                        <div
                            class="absolute
                                   inset-5
                                   rounded-[35%]
                                   bg-[#FFD400]
                                   rotate-6"
                        ></div>


                        <!-- MAIN CARD -->

                        <div
                            class="absolute
                                   inset-0
                                   rounded-[35%]
                                   bg-[#fdf7ef]
                                   border border-white
                                   shadow-[12px_15px_0px_#c4bfb9]
                                   flex
                                   flex-col
                                   items-center
                                   justify-center
                                   -rotate-3"
                        >

                            <!-- CART -->

                            <div
                                class="w-28 h-28
                                       sm:w-36 sm:h-36
                                       rounded-full
                                       bg-white
                                       shadow-[0_10px_25px_rgba(0,0,0,0.08)]
                                       flex
                                       items-center
                                       justify-center
                                       mb-6"
                            >

                                <svg
                                    class="w-16 h-16 sm:w-20 sm:h-20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >

                                    <path
                                        d="M3 4H5L7.4 15.2C7.6 16.1 8.4 16.7 9.3 16.7H17.5C18.4 16.7 19.2 16.1 19.4 15.2L21 8H6"
                                        stroke="#111111"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />

                                    <circle
                                        cx="9.5"
                                        cy="20"
                                        r="1.5"
                                        fill="#FFD400"
                                        stroke="#111111"
                                        stroke-width="1.5"
                                    />

                                    <circle
                                        cx="17.5"
                                        cy="20"
                                        r="1.5"
                                        fill="#FFD400"
                                        stroke="#111111"
                                        stroke-width="1.5"
                                    />

                                </svg>

                            </div>


                            <!-- LOGO -->

                            <div class="flex items-center">

                                <span
                                    class="text-4xl
                                           sm:text-5xl
                                           font-extrabold
                                           tracking-[-2px]"
                                >
                                    Next
                                </span>

                                <span
                                    class="ml-2
                                           text-4xl
                                           sm:text-5xl
                                           font-extrabold
                                           tracking-[-2px]
                                           text-[#FFD400]
                                           [text-shadow:1px_1px_0px_#111]"
                                >
                                    Market
                                </span>

                            </div>


                            <p
                                class="mt-3
                                       text-sm
                                       text-gray-500"
                            >
                                Simple • Fast • Convenient
                            </p>

                        </div>


                        <!-- FLOATING ITEM -->

                        <div
                            class="absolute
                                   -top-3
                                   -right-3
                                   sm:-right-6
                                   w-16 h-16
                                   rounded-2xl
                                   bg-white
                                   shadow-[6px_7px_0px_#c4bfb9]
                                   flex
                                   items-center
                                   justify-center
                                   rotate-6"
                        >

                            <span class="text-3xl">
                                🛒
                            </span>

                        </div>


                        <!-- FLOATING CHECK -->

                        <div
                            class="absolute
                                   -bottom-4
                                   -left-3
                                   sm:-left-6
                                   px-5 py-3
                                   rounded-full
                                   bg-white
                                   shadow-[6px_7px_0px_#c4bfb9]
                                   flex items-center gap-2
                                   text-sm font-bold"
                        >

                            <span
                                class="flex
                                       items-center
                                       justify-center
                                       w-6 h-6
                                       rounded-full
                                       bg-[#FFD400]"
                            >
                                ✓
                            </span>

                            Belanja nyaman

                        </div>

                    </div>

                </div>

            </div>

        </section>



        <!-- ================= FEATURES ================= -->

        <section
            id="features"
            class="bg-[#fdf7ef]
                   border-y border-white
                   py-20"
        >

            <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-12">


                <!-- TITLE -->

                <div class="text-center max-w-2xl mx-auto mb-12">

                    <span
                        class="text-sm
                               font-bold
                               text-[#c2a600]
                               uppercase
                               tracking-widest"
                    >
                        Kenapa NextMarket?
                    </span>

                    <h2
                        class="mt-3
                               text-3xl
                               sm:text-4xl
                               font-extrabold
                               tracking-tight"
                    >
                        Semua jadi lebih mudah.
                    </h2>

                    <p
                        class="mt-4
                               text-gray-500"
                    >
                        Kami membuat pengalaman berbelanja menjadi
                        lebih sederhana dan menyenangkan.
                    </p>

                </div>



                <!-- FEATURES -->

                <div
                    class="grid
                           md:grid-cols-3
                           gap-6"
                >


                    <!-- CARD 1 -->

                    <div
                        class="bg-white
                               rounded-[28px]
                               p-7
                               shadow-[0_8px_25px_rgba(0,0,0,0.05)]
                               hover:-translate-y-1
                               transition"
                    >

                        <div
                            class="w-14 h-14
                                   rounded-2xl
                                   bg-[#FFD400]
                                   flex
                                   items-center
                                   justify-center
                                   text-2xl
                                   mb-5"
                        >
                            🛒
                        </div>

                        <h3
                            class="text-xl
                                   font-bold"
                        >
                            Pilihan Lengkap
                        </h3>

                        <p
                            class="mt-3
                                   text-sm
                                   leading-6
                                   text-gray-500"
                        >
                            Temukan berbagai kebutuhan yang
                            kamu perlukan dalam satu tempat.
                        </p>

                    </div>



                    <!-- CARD 2 -->

                    <div
                        class="bg-white
                               rounded-[28px]
                               p-7
                               shadow-[0_8px_25px_rgba(0,0,0,0.05)]
                               hover:-translate-y-1
                               transition"
                    >

                        <div
                            class="w-14 h-14
                                   rounded-2xl
                                   bg-[#FFD400]
                                   flex
                                   items-center
                                   justify-center
                                   text-2xl
                                   mb-5"
                        >
                            ⚡
                        </div>

                        <h3
                            class="text-xl
                                   font-bold"
                        >
                            Cepat & Praktis
                        </h3>

                        <p
                            class="mt-3
                                   text-sm
                                   leading-6
                                   text-gray-500"
                        >
                            Nikmati proses yang cepat dengan
                            tampilan yang sederhana dan mudah digunakan.
                        </p>

                    </div>



                    <!-- CARD 3 -->

                    <div
                        class="bg-white
                               rounded-[28px]
                               p-7
                               shadow-[0_8px_25px_rgba(0,0,0,0.05)]
                               hover:-translate-y-1
                               transition"
                    >

                        <div
                            class="w-14 h-14
                                   rounded-2xl
                                   bg-[#FFD400]
                                   flex
                                   items-center
                                   justify-center
                                   text-2xl
                                   mb-5"
                        >
                            🔒
                        </div>

                        <h3
                            class="text-xl
                                   font-bold"
                        >
                            Aman & Nyaman
                        </h3>

                        <p
                            class="mt-3
                                   text-sm
                                   leading-6
                                   text-gray-500"
                        >
                            Data akun kamu dijaga dengan sistem
                            autentikasi yang aman.
                        </p>

                    </div>

                </div>

            </div>

        </section>



        <!-- ================= ABOUT ================= -->

        <section
            id="about"
            class="max-w-7xl mx-auto
                   px-6 sm:px-10 lg:px-12
                   py-20"
        >

            <div
                class="bg-[#FFD400]
                       rounded-[35px]
                       p-8 sm:p-12 lg:p-16
                       shadow-[10px_12px_0px_#c4bfb9]
                       flex
                       flex-col
                       md:flex-row
                       items-center
                       justify-between
                       gap-10"
            >

                <div class="max-w-2xl">

                    <span
                        class="text-sm
                               font-bold
                               uppercase
                               tracking-widest"
                    >
                        Tentang NextMarket
                    </span>

                    <h2
                        class="mt-3
                               text-3xl
                               sm:text-4xl
                               font-extrabold
                               tracking-tight"
                    >
                        Satu tempat untuk
                        kebutuhan sehari-hari.
                    </h2>

                    <p
                        class="mt-4
                               text-black/70
                               leading-7"
                    >
                        Mart In hadir untuk memberikan pengalaman
                        berbelanja yang mudah, cepat, dan nyaman.
                        Dengan tampilan yang sederhana, siapa pun
                        dapat menggunakan Mart In dengan mudah.
                    </p>

                </div>


                <a
                    href="{{ route('register') }}"
                    class="shrink-0
                           bg-black
                           text-white
                           px-8 py-4
                           rounded-full
                           font-bold
                           shadow-[5px_6px_0px_rgba(255,255,255,0.5)]
                           hover:-translate-y-1
                           transition"
                >
                    Gabung Sekarang
                </a>

            </div>

        </section>



        <!-- ================= FOOTER ================= -->

        <footer
            id="contact"
            class="border-t border-[#e7ded4]
                   py-8"
        >

            <div
                class="max-w-7xl mx-auto
                       px-6 sm:px-10 lg:px-12
                       flex
                       flex-col sm:flex-row
                       items-center
                       justify-between
                       gap-4"
            >

                <div class="flex items-center">

                    <span class="font-extrabold">
                        Next
                    </span>

                    <span
                        class="ml-1
                               font-extrabold
                               text-[#FFD400]
                               [text-shadow:1px_1px_0px_#111]"
                    >
                        Market
                    </span>

                </div>


                <p
                    class="text-xs
                           text-gray-400"
                >
                    © {{ date('Y') }} Mart In.
                    All rights reserved.
                </p>


                <div class="flex gap-5">

                    <a
                        href="{{ route('login') }}"
                        class="text-sm
                               text-gray-500
                               hover:text-black"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="text-sm
                               text-gray-500
                               hover:text-black"
                    >
                        Register
                    </a>

                </div>

            </div>

        </footer>

    </main>

</body>

</html>