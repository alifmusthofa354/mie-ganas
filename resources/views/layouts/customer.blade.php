<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta-description', 'Welcome to Mie Ganas - Best Indonesian Noodle Restaurant')">

    <title>@yield('title', 'Mie Ganas - Home')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/customer-order-status-echo.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen">
    <header class="w-full bg-white dark:bg-[#161615] shadow-md py-4 px-4 sm:px-6">
        <div class="container mx-auto flex justify-between items-center relative">

            <a href="/" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Mie Ganas</span>
            </a>

            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>

            <div class="hidden md:flex md:w-auto 
            absolute md:static top-full right-0 z-50 mt-1"
                id="navbar-sticky">
                <nav>
                    <ul
                        class="flex flex-col justify-around font-medium rounded-lg 
            /* Mobile: Floating Menu */
            bg-gray-800 dark:bg-gray-900 shadow-xl  min-w-[150px] gap-y-2 p-2

            /* Desktop: Static Menu */
            md:p-0 md:mt-0 md:gap-x-2 md:flex-row md:bg-transparent md:dark:bg-transparent md:shadow-none">

                        <li class="md:p-0 md:flex md:items-center **md:ml-4**">
                            <a href="/customer/menu"
                                class="w-full block px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md transition duration-300 text-sm text-center md:w-auto">
                                Menu
                            </a>
                        </li>

                        <li class="md:p-0 md:flex md:items-center **md:ml-4**">
                            <a href="{{ route('customer.history') }}"
                                class="w-full block px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md transition duration-300 text-sm text-center md:w-auto">
                                Riwayat
                            </a>
                        </li>

                        <li class="md:p-0 md:flex md:items-center **md:ml-4**">
                            <form action="{{ route('customer.logout') }}" method="POST" class="w-full md:block">
                                @csrf
                                <button type="submit"
                                    class="w-full px-4 py-2 bg-red-800 hover:bg-red-900 text-white rounded-md transition duration-300 text-sm text-center md:w-auto">
                                    Logout
                                </button>
                            </form>
                        </li>



                    </ul>
                </nav>
            </div>

        </div>
    </header>

    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="w-full bg-white dark:bg-[#121212] py-6 px-6 border-t border-red-500/20 dark:border-red-600/30">
        <div class="container mx-auto max-w-7xl text-center">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                © {{ date('Y') }} <span class="font-semibold text-red-600 dark:text-red-500">Mie Ganas.</span> Semua
                Hak Dilindungi.
            </p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
