<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta-description', 'Welcome to Mie Ganas - Best Indonesian Noodle Restaurant')">

    <title>@yield('title', 'Mie Ganas - Home')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen">
    <!-- Header with navigation -->
    <header class="w-full bg-white dark:bg-[#161615] shadow-md py-4 px-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Mie Ganas</span>
            </a>
            
            <nav>
                <ul class="flex space-x-6">
                    <!-- Customer name display when authenticated -->
                    @auth
                        <li class="flex items-center">
                            <span class="text-[#1b1b18] dark:text-[#EDEDEC] mr-4">
                                Halo, {{ Auth::user()->name }}
                            </span>
                        </li>
                        <li>
                            <a href="/history" 
                               class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-[#1b1b18] rounded-lg transition duration-300 text-sm dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-[#EDEDEC]">
                                Riwayat
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}" 
                               class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition duration-300 text-sm">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <!-- For unauthenticated users (e.g., via QR code), we'll show a generic name -->
                        <li class="flex items-center">
                            <span class="text-[#1b1b18] dark:text-[#EDEDEC] mr-4">
                                Selamat Datang
                            </span>
                        </li>
                        <li>
                            <a href="/history" 
                               class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-[#1b1b18] rounded-lg transition duration-300 text-sm dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-[#EDEDEC]">
                                Riwayat
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" 
                               class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                                Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w-full bg-white dark:bg-[#161615] py-8 px-6 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Mie Ganas</h3>
                    <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                        The best Indonesian noodle restaurant serving delicious and spicy noodles for passionate food lovers.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-md font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433]">Home</a></li>
                        <li><a href="/menu" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433]">Menu</a></li>
                        <li><a href="/about" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433]">About</a></li>
                        <li><a href="/contact" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433]">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-md font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">
                        <li>Email: info@mieganas.com</li>
                        <li>Phone: +62 123 4567 890</li>
                        <li>Address: Jl. Noodle Street No. 123, Indonesia</li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-md font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Opening Hours</h4>
                    <ul class="space-y-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">
                        <li>Monday - Sunday: 10:00 AM - 10:00 PM</li>
                        <li>Saturday - Sunday: 10:00 AM - 11:00 PM</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-[#e3e3e0] dark:border-[#3E3E3A] mt-8 pt-6 text-center">
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">© {{ date('Y') }} Mie Ganas. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>