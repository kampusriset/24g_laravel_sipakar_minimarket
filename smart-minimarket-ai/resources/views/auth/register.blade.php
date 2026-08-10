<x-guest-layout>

    <div class="min-h-screen bg-[#faf2e8] flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-[560px]">

            <!-- CARD -->
            <div
                class="bg-[#fdf7ef]
                       rounded-[30px]
                       px-8 py-9
                       sm:px-12 sm:py-10
                       border border-white/80
                       shadow-[0_15px_40px_rgba(0,0,0,0.07)]"
            >

                <!-- LOGO -->
                <div class="flex items-center justify-center mb-9">

                    <h1
                        class="text-[42px] sm:text-[48px]
                               leading-none
                               font-extrabold
                               tracking-[-2px]
                               text-black"
                    >
                        Next
                    </h1>

                    <span
                        class="ml-2
                               text-[42px] sm:text-[48px]
                               leading-none
                               font-extrabold
                               tracking-[-2px]
                               text-[#FFD400]
                               [text-shadow:1px_1px_0px_#111]"
                    >
                        Market
                    </span>

                </div>


                <!-- FORM -->
                <form
                    method="POST"
                    action="{{ route('register') }}"
                    class="space-y-4"
                >

                    @csrf


                    <!-- NAME -->
                    <div>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Name"
                            class="w-full
                                   h-[58px]
                                   px-8
                                   rounded-full
                                   border-0
                                   bg-white
                                   text-[18px]
                                   text-gray-800
                                   placeholder:text-[#9ca3b4]
                                   shadow-[0_4px_12px_rgba(0,0,0,0.035)]
                                   outline-none
                                   focus:ring-2
                                   focus:ring-[#FFD400]/40
                                   transition"
                        >

                        <x-input-error
                            :messages="$errors->get('name')"
                            class="mt-1 px-5"
                        />

                    </div>


                    <!-- EMAIL -->
                    <div>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                            placeholder="Email"
                            class="w-full
                                   h-[58px]
                                   px-8
                                   rounded-full
                                   border-0
                                   bg-white
                                   text-[18px]
                                   text-gray-800
                                   placeholder:text-[#9ca3b4]
                                   shadow-[0_4px_12px_rgba(0,0,0,0.035)]
                                   outline-none
                                   focus:ring-2
                                   focus:ring-[#FFD400]/40
                                   transition"
                        >

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-1 px-5"
                        />

                    </div>


                    <!-- PASSWORD -->
                    <div>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Password"
                            class="w-full
                                   h-[58px]
                                   px-8
                                   rounded-full
                                   border-0
                                   bg-white
                                   text-[18px]
                                   text-gray-800
                                   placeholder:text-[#9ca3b4]
                                   shadow-[0_4px_12px_rgba(0,0,0,0.035)]
                                   outline-none
                                   focus:ring-2
                                   focus:ring-[#FFD400]/40
                                   transition"
                        >

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-1 px-5"
                        />

                    </div>


                    <!-- CONFIRM PASSWORD -->
                    <div>

                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Confirm Password"
                            class="w-full
                                   h-[58px]
                                   px-8
                                   rounded-full
                                   border-0
                                   bg-white
                                   text-[18px]
                                   text-gray-800
                                   placeholder:text-[#9ca3b4]
                                   shadow-[0_4px_12px_rgba(0,0,0,0.035)]
                                   outline-none
                                   focus:ring-2
                                   focus:ring-[#FFD400]/40
                                   transition"
                        >

                        <x-input-error
                            :messages="$errors->get('password_confirmation')"
                            class="mt-1 px-5"
                        />

                    </div>


                    <!-- REGISTER BUTTON -->
                    <div class="flex justify-center pt-3 pb-2">

                        <button
                            type="submit"
                            class="w-[220px]
                                   h-[58px]
                                   rounded-full
                                   bg-[#FFD400]
                                   text-black
                                   text-[19px]
                                   font-bold
                                   shadow-[6px_7px_0px_#bdb9b3]
                                   hover:-translate-y-[2px]
                                   hover:shadow-[6px_9px_0px_#bdb9b3]
                                   active:translate-y-[1px]
                                   active:shadow-[3px_4px_0px_#bdb9b3]
                                   transition-all duration-200"
                        >
                            Register
                        </button>

                    </div>

                </form>


                <!-- DIVIDER -->
                <div class="flex items-center gap-4 my-6">

                    <div class="h-px flex-1 bg-[#d5d0ca]"></div>

                    <span class="text-[14px] text-[#9ca3b4]">
                        atau
                    </span>

                    <div class="h-px flex-1 bg-[#d5d0ca]"></div>

                </div>


                <!-- GOOGLE -->
                <a
                    href="{{ route('google.login') }}"
                    class="relative
                           flex items-center justify-center
                           w-full
                           h-[58px]
                           rounded-full
                           bg-white
                           text-black
                           text-[18px]
                           font-semibold
                           shadow-[6px_7px_0px_#bdb9b3]
                           hover:-translate-y-[2px]
                           hover:shadow-[6px_9px_0px_#bdb9b3]
                           active:translate-y-[1px]
                           active:shadow-[3px_4px_0px_#bdb9b3]
                           transition-all duration-200"
                >

                    <span>
                        Register as Google
                    </span>

                    <!-- GOOGLE ICON -->
                    <svg
                        class="absolute right-5 w-[32px] h-[32px]"
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

                </a>


                <!-- LOGIN -->
                <div class="text-center mt-7">

                    <span class="text-[14px] text-[#8f8b88]">
                        Sudah punya akun?
                    </span>

                    <a
                        href="{{ route('login') }}"
                        class="text-[14px]
                               font-bold
                               text-black
                               hover:text-[#d5b400]
                               transition"
                    >
                        Login sekarang
                    </a>

                </div>

            </div>


            <!-- FOOTER -->
            <p class="text-center text-[11px] text-[#aaa5a0] mt-5">
                © {{ date('Y') }} Mart In. All rights reserved.
            </p>

        </div>

    </div>

</x-guest-layout>