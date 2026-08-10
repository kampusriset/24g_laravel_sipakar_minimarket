<x-guest-layout>

    <div class="min-h-screen bg-[#faf2e8] flex items-center justify-center px-5 py-10">

        <div class="w-full max-w-[680px]">

            <!-- LOGIN CARD -->
            <div class="relative bg-[#fdf6ee] rounded-[28px] px-7 py-12 sm:px-14 sm:py-14 shadow-[0_25px_60px_rgba(0,0,0,0.08)] border border-white/60">

                <!-- HEADER -->
                <div class="flex items-center justify-center gap-3 mb-12">

                    <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-black">
                        Next
                    </h1>

                    <span class="text-4xl sm:text-5xl font-extrabold text-[#FFD400] [text-shadow:1px_1px_0_#111]">
                        Market
                    </span>

                </div>


                <!-- SESSION STATUS -->
                <x-auth-session-status
                    class="mb-5"
                    :status="session('status')"
                />


                <!-- LOGIN FORM -->
                <form method="POST" action="{{ route('login') }}" class="space-y-7">

                    @csrf


                    <!-- EMAIL -->
                    <div>

                        <label for="email" class="sr-only">
                            Username
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Username"
                            class="block w-full h-[62px] px-8 rounded-full
                                   bg-white
                                   border-0
                                   text-lg sm:text-xl
                                   text-gray-900
                                   placeholder:text-gray-400
                                   shadow-[0_4px_10px_rgba(0,0,0,0.03)]
                                   focus:ring-4
                                   focus:ring-[#FFD400]/30
                                   focus:outline-none
                                   transition"
                        >

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2 px-5"
                        />

                    </div>


                    <!-- PASSWORD -->
                    <div>

                        <label for="password" class="sr-only">
                            Password
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Password"
                            class="block w-full h-[62px] px-8 rounded-full
                                   bg-white
                                   border-0
                                   text-lg sm:text-xl
                                   text-gray-900
                                   placeholder:text-gray-400
                                   shadow-[0_4px_10px_rgba(0,0,0,0.03)]
                                   focus:ring-4
                                   focus:ring-[#FFD400]/30
                                   focus:outline-none
                                   transition"
                        >

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2 px-5"
                        />

                    </div>


                    <!-- REMEMBER + FORGOT -->
                    <div class="flex items-center justify-between px-4">

                        <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">

                            <input
                                type="checkbox"
                                name="remember"
                                class="rounded border-gray-300 text-[#FFD400]
                                       focus:ring-[#FFD400]"
                            >

                            <span>Remember me</span>

                        </label>


                        @if (Route::has('password.request'))

                            <a
                                href="{{ route('password.request') }}"
                                class="text-sm font-medium text-gray-700 hover:text-black transition"
                            >
                                Forgot password?
                            </a>

                        @endif

                    </div>


                    <!-- LOGIN BUTTON -->
                    <div class="flex justify-center pt-2">

                        <button
                            type="submit"
                            class="group relative
                                   min-w-[220px]
                                   h-[62px]
                                   px-10
                                   rounded-full
                                   bg-[#FFD400]
                                   text-black
                                   text-xl
                                   font-extrabold
                                   shadow-[7px_8px_0px_#c7c2bc]
                                   hover:translate-y-[-2px]
                                   hover:shadow-[7px_10px_0px_#bdb8b2]
                                   active:translate-y-[2px]
                                   active:shadow-[4px_5px_0px_#c7c2bc]
                                   transition-all duration-200"
                        >
                            Login
                        </button>

                    </div>

                </form>


                <!-- DIVIDER -->
                <div class="flex items-center gap-4 my-8">

                    <div class="h-px flex-1 bg-gray-300"></div>

                    <span class="text-sm text-gray-400">
                        atau
                    </span>

                    <div class="h-px flex-1 bg-gray-300"></div>

                </div>


                <!-- GOOGLE LOGIN -->
                <a
                    href="{{ route('google.login') }}"
                    class="group relative flex items-center justify-center
                           w-full
                           h-[62px]
                           px-6
                           rounded-full
                           bg-white
                           text-black
                           text-lg sm:text-xl
                           font-bold
                           shadow-[7px_8px_0px_#c7c2bc]
                           hover:translate-y-[-2px]
                           hover:shadow-[7px_10px_0px_#bdb8b2]
                           active:translate-y-[2px]
                           active:shadow-[4px_5px_0px_#c7c2bc]
                           transition-all duration-200"
                >

                    <span>
                        Login as Google
                    </span>

                    <!-- GOOGLE LOGO -->
                    <div class="absolute right-5 flex items-center justify-center">

                        <svg
                            class="w-9 h-9"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill="#4285F4"
                                d="M21.35 12.23c0-.79-.07-1.55-.2-2.27H12v4.3h5.24a4.48 4.48 0 0 1-1.94 2.94v2.45h3.14c1.84-1.69 2.91-4.18 2.91-7.42z"
                            />

                            <path
                                fill="#34A853"
                                d="M12 21.7c2.63 0 4.84-.87 6.45-2.35l-3.14-2.45c-.87.58-1.98.92-3.31.92-2.54 0-4.69-1.72-5.46-4.03H3.3v2.53A9.75 9.75 0 0 0 12 21.7z"
                            />

                            <path
                                fill="#FBBC05"
                                d="M6.54 13.79A5.86 5.86 0 0 1 6.23 12c0-.62.11-1.23.31-1.79V7.68H3.3A9.75 9.75 0 0 0 2.25 12c0 1.57.38 3.05 1.05 4.32l3.24-2.53z"
                            />

                            <path
                                fill="#EA4335"
                                d="M12 6.18c1.43 0 2.71.49 3.72 1.46l2.79-2.79C16.84 3.24 14.63 2.3 12 2.3a9.75 9.75 0 0 0-8.7 5.38l3.24 2.53C7.31 7.9 9.46 6.18 12 6.18z"
                            />
                        </svg>

                    </div>

                </a>


                <!-- REGISTER -->
                @if (Route::has('register'))

                    <div class="text-center mt-8 text-sm text-gray-500">

                        Belum punya akun?

                        <a
                            href="{{ route('register') }}"
                            class="font-bold text-black hover:text-[#d6b400] transition"
                        >
                            Daftar sekarang
                        </a>

                    </div>

                @endif

            </div>

            <!-- FOOTER -->
            <p class="text-center text-xs text-gray-400 mt-6">
                © {{ date('Y') }} Mart In. All rights reserved.
            </p>

        </div>

    </div>

</x-guest-layout>