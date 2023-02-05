<nav x-data="{ open: false }" class="bg-white dark:bg-gray-700 border-b border-gray-100 dark:border-gray-700 print:hidden">
    <!-- Primary Navigation Menu -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center sm:hidden" id="siteLogo">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                </a>
            </div>


            <!-- Page Heading -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                @if (isset($submenu))
                    {{ $submenu }}
                @endif
            </div>

            <div class="flex">
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm font-medium text-gray-900 hover:text-gray-700 dark:text-white dark:hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div
                                    class="uppercase bg-blue-500 w-10 h-10 rounded-full flex justify-center items-center text-white font-bold mr-1">
                                    {{ Auth::user()->name[0] . Auth::user()->name[1] }}</div>
                                <p>{{ Auth::user()->name }}</p>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            {{-- <x-dropdown-link :href="route('home')">
                                    {{ __('Visit Site') }}
                            </x-dropdown-link> --}}
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>

                        </x-slot>
                    </x-dropdown>
                </div>

                <button id="theme-toggle" type="button" class="hidden sm:block sm:ml-4" onclick="darkModeToggle()">
                    <span class="iconify block dark:hidden text-gray-900 text-xl"
                        data-icon="material-symbols:dark-mode"></span>
                    <span class="iconify hidden dark:block text-white text-xl"
                        data-icon="material-symbols:light-mode"></span>
                </button>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <!-- Page Heading -->
        <div class="flex sm:hidden space-x-8 sm:-my-px sm:ml-10 p-4 bg-gray-200 dark:bg-gray-800 mt-4">
            @if (isset($submenu))
                {{ $submenu }}
            @endif
        </div>
        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500 dark:text-gray-200">{{ Auth::user()->email }}</div>
            </div>


            <div class="mt-3 space-y-1 flex justify-between px-4">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
                <button id="theme-toggle" type="button" class="" onclick="darkModeToggle()">
                    <span class="iconify block dark:hidden text-gray-900 text-xl"
                        data-icon="material-symbols:dark-mode"></span>
                    <span class="iconify hidden dark:block text-white text-xl"
                        data-icon="material-symbols:light-mode"></span>
                </button>
            </div>
        </div>
    </div>
</nav>
