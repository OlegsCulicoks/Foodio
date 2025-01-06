<nav x-data="{ open: false }" class="bg-gray-200 border-b-2 border-yellow-400 shadow-md">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <!-- Logo redzams tikai mobilaja versija -->
                <a href="{{ route('home') }}" class="md:hidden text-2xl font-bold text-black hover:text-black font-lemon">Foodio</a>
                <!-- Datora navigacija -->
                <div class="hidden md:flex items-center space-x-4 font-lemon">
                    <a href="{{ route('home') }}" class="hover:text-yellow-400">Home</a>
                    <a href="{{ route('about') }}" class="hover:text-yellow-400">About</a>
                    <a href="{{ route('menu') }}" class="hover:text-yellow-400">Food Menu</a>
                    <a href="{{ route('reservations.create') }}" class="hover:text-yellow-400">Make Reservation</a>
                    <a href="{{ route('tables.index') }}" class="hover:text-yellow-400">Tables</a>

                </div>
            </div>
            <div class="hidden md:flex items-center space-x-4 font-lemon">
                @guest
                    <a href="{{ route('login') }}" class="hover:text-yellow-400">Login</a>
                @else
                    <span class="text-green-600 font-lemon">Welcome, {{ Auth::user()->name }}!</span>
                    <a href="{{ route('profile.edit') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 font-lemon">Edit Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 font-lemon">Log Out</button>
                    </form>
                @endguest
            </div>
            <div class="md:hidden">
                <button @click="open = !open" class="text-black hover:text-black focus:outline-none focus:text-black">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div x-show="open" class="md:hidden mt-4">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 font-lemon">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:text-yellow-400 hover:bg-gray-300">Home</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:text-yellow-400 hover:bg-gray-300">About</a>
                <a href="{{ route('menu') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:text-yellow-400 hover:bg-gray-300">Food Menu</a>
                <a href="{{ route('reservations.create') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:text-yellow-400 hover:bg-gray-300">Make Reservation</a>
                <a href="{{ route('tables.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:text-yellow-400 hover:bg-gray-300">Tables</a>
                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:text-yellow-400 hover:bg-gray-300">Admin Panel</a>
                    @endif
                @endauth
            </div>
            <div class="pt-4 pb-3 border-t border-gray-300">
                @guest
                    <div class="px-2 space-y-1 font-lemon">
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:text-yellow-400 hover:bg-gray-300">Login</a>
                    </div>
                @else
                    <div class="px-2 space-y-1 font-lemon">
                        <span class="block px-3 py-2 rounded-md text-base font-medium text-green-600">Welcome, {{ Auth::user()->name }}!</span>
                        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:text-yellow-400 hover:bg-gray-300">Edit Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium hover:text-yellow-400 hover:bg-gray-300">Log Out</button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>

