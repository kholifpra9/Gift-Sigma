<nav x-data="{ openMenu: false }" class="h-screen w-64 fixed left-0 top-0 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
    <div class="flex flex-col h-full">

        <!-- Logo -->
        <div class="flex items-center justify-center h-16 border-b border-gray-200 dark:border-gray-700">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto text-gray-800 dark:text-gray-200" />
            </a>
        </div>

        <!-- Menu Utama -->
        <div class="flex-1 overflow-y-auto">
            <ul class="mt-4 space-y-1">

                {{-- Dashboard --}}
                <li>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="block w-full px-4 py-2">
                        Dashboard
                    </x-nav-link>
                </li>

                {{-- Gift Order --}}
                <li>
                    <x-nav-link :href="route('gift-orders.index')" 
                                :active="request()->routeIs('gift-orders.*')"
                        class="block w-full px-4 py-2">
                        Customer Gift
                    </x-nav-link>
                </li>

            </ul>
        </div>

        <!-- User Menu -->
        <div class="border-t border-gray-200 dark:border-gray-700 p-4">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700 dark:text-gray-200 font-medium">
                    {{ Auth::user()->name }}
                </div>

                <button @click="openMenu = !openMenu">
                    <svg class="h-4 w-4 text-gray-600 dark:text-gray-300" fill="currentColor">
                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 
                        111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 
                        010-1.414z" />
                    </svg>
                </button>
            </div>

            <!-- Dropdown -->
            <div x-show="openMenu" x-transition class="mt-2 space-y-1">

                <x-nav-link :href="route('profile.edit')" class="block px-2 py-1 text-sm">
                    Profile
                </x-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-nav-link :href="route('logout')" 
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block px-2 py-1 text-sm">
                        Log Out
                    </x-nav-link>
                </form>

            </div>
        </div>

    </div>
</nav>
