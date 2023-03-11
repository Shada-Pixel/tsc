<nav x-data="{ open: false }" class="bg-white dark:bg-gray-700 border-b border-gray-100 dark:border-gray-700 print:hidden">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center" id="siteLogo">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-600 dark:text-white" />
                </a>
            </div>
            <!-- Hamburger -->
            <div class="-mr-2 hidden sm:flex items-center rotate-180" id="sidemenutoggle">
                <button class="rotate-180 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="" id="toggleIcon" width="1em" height="1em"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m15 4l-8 8l8 8" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
<div class="sidenav relative print:hidden">
    <x-sidenav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        <span class="iconify" data-icon="mingcute:dashboard-2-line"></span>
        <p class="sidelinktext">Dashboard</p>
    </x-sidenav-link>


    <hr class="border border-gray-400 dark:border-gray-600 my-1">
    <x-sidenav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
        <span class="iconify" data-icon="mdi:package-variant-closed"></span>
        <p class="sidelinktext">Products</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')">
        <span class="iconify" data-icon="mdi:package-variant-closed-plus"></span>
        <p class="sidelinktext">Supplier</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('purchases.index')" :active="request()->routeIs('purchases.*')">
        <span class="iconify" data-icon="carbon:purchase"></span>
        <p class="sidelinktext">Purchases</p>
    </x-sidenav-link>



    <x-sidenav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">
        <span class="iconify" data-icon="fluent:people-money-20-regular"></span>
        <p class="sidelinktext">Clients</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('sales.index')" :active="request()->routeIs('sales.*')">
        <span class="iconify" data-icon="material-symbols:shopping-cart-outline"></span>
        <p class="sidelinktext">Sales</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('sales.index')" :active="request()->routeIs('sales.*')">
        <span class="iconify" data-icon="vaadin:stock"></span>
        <p class="sidelinktext">Stock</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('sales.index')" :active="request()->routeIs('sales.*')">
        <span class="iconify" data-icon="mdi:bank-outline"></span>
        <p class="sidelinktext">Bank</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('sales.index')" :active="request()->routeIs('sales.*')">
        <span class="iconify" data-icon="mdi:report-line"></span>
        <p class="sidelinktext">Reports</p>
    </x-sidenav-link>
    <hr class="border border-gray-400 dark:border-gray-600 my-1">

    <x-sidenav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
        <span class="iconify text-eve" data-icon="ph:users"></span>
        <p class="sidelinktext">Users</p>
    </x-sidenav-link>

    <x-sidenav-link :href="route('permissions.index')" :active="request()->routeIs('permissions.*')">
        <span class="iconify text-eve" data-icon="fluent:key-20-regular"></span>
        <p class="sidelinktext">Permissions</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('roles.index')" :active="request()->routeIs('roles.*')">
        <span class="iconify text-eve" data-icon="fluent:phone-key-24-regular"></span>
        <p class="sidelinktext">Roles</p>
    </x-sidenav-link>

    <hr class="border border-gray-400 dark:border-gray-600 my-1">
</div>
