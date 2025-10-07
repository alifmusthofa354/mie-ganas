<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta-description', 'Aplikasi Dashboard untuk Mie Ganas')">

    <title>@yield('title', 'Dashboard - Mie Ganas')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex min-h-screen">
    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-white dark:bg-[#161615] shadow-md">
        <div class="h-full px-3 py-4 overflow-y-auto bg-white dark:bg-[#161615]">
            <a href="/dashboard" class="flex items-center ps-2.5 mb-6">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Mie Ganas</span>
            </a>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="/admin"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 18.134H19V12a1 1 0 0 0-1-1h-6V3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v8H2a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h2v-4a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v4Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/menus"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 20">
                            <path
                                d="M17 5.576v5.924a1 1 0 0 1-.3.7l-3.27 3.27a1 1 0 0 1-.7.3H2.194a1 1 0 0 1-.7-.3L.3 12.2a1 1 0 0 1 0-1.4l6.67-6.67a1 1 0 0 1 1.4 0l4.33 4.33a1 1 0 0 0 1.4 0l1.4-1.4a1 1 0 0 0 0-1.4L11.6 2.204a1 1 0 0 0-1.4 0L5.576 6.83a1 1 0 0 0 0 1.4l1.4 1.4a1 1 0 0 1 0 1.4l-1.4 1.4a1 1 0 0 1-.7.3H3.076a1 1 0 0 1-.7-.3L1.076 10.7a1 1 0 0 1 0-1.4l2.6-2.6a1 1 0 0 1 1.4 0l3.27 3.27a1 1 0 0 0 1.4 0l1.4-1.4a1 1 0 0 0 0-1.4L7.976 4.43a1 1 0 0 0-1.4 0L2.204 8.8a1 1 0 0 0 0 1.4l1.4 1.4a1 1 0 0 1 0 1.4l-1.4 1.4a1 1 0 0 1-.7.3H1.676a1 1 0 0 1-.7-.3L.3 12.2a1 1 0 0 1 0-1.4l1.4-1.4a1 1 0 0 1 1.4 0l.7.7a1 1 0 0 0 1.4 0l.7-.7a1 1 0 0 0 0-1.4l-1.4-1.4a1 1 0 0 0-1.4 0L.3 8.8a1 1 0 0 0 0-1.4l.67-.67a1 1 0 0 0 .7-.3h.7a1 1 0 0 0 .7.3l1.4 1.4a1 1 0 0 0 1.4 0l1.4-1.4a1 1 0 0 0 0-1.4L6.83 2.204a1 1 0 0 0-1.4 0L.3 7.324a1 1 0 0 0 0 1.4l.67.67a1 1 0 0 0 .7.3h.7a1 1 0 0 0 .7-.3l5.12-5.12a1 1 0 0 1 1.4 0l1.4 1.4a1 1 0 0 1 0 1.4L10.3 8.8a1 1 0 0 1-1.4 0L8.8 7.4a1 1 0 0 1 0-1.4l1.4-1.4a1 1 0 0 1 1.4 0l1.4 1.4a1 1 0 0 1 0 1.4L11.6 9.9a1 1 0 0 1-1.4 0L8.8 8.5a1 1 0 0 1 0-1.4l1.4-1.4a1 1 0 0 1 1.4 0l1.4 1.4a1 1 0 0 1 0 1.4Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Menu</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/categories"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 20">
                            <path
                                d="M17 5.576v5.924a1 1 0 0 1-.3.7l-3.27 3.27a1 1 0 0 1-.7.3H2.194a1 1 0 0 1-.7-.3L.3 12.2a1 1 0 0 1 0-1.4l6.67-6.67a1 1 0 0 1 1.4 0l4.33 4.33a1 1 0 0 0 1.4 0l1.4-1.4a1 1 0 0 0 0-1.4L11.6 2.204a1 1 0 0 0-1.4 0L5.576 6.83a1 1 0 0 0 0 1.4l1.4 1.4a1 1 0 0 1 0 1.4l-1.4 1.4a1 1 0 0 1-.7.3H3.076a1 1 0 0 1-.7-.3L1.076 10.7a1 1 0 0 1 0-1.4l2.6-2.6a1 1 0 0 1 1.4 0l3.27 3.27a1 1 0 0 0 1.4 0l1.4-1.4a1 1 0 0 0 0-1.4L7.976 4.43a1 1 0 0 0-1.4 0L2.204 8.8a1 1 0 0 0 0 1.4l1.4 1.4a1 1 0 0 1 0 1.4l-1.4 1.4a1 1 0 0 1-.7.3H1.676a1 1 0 0 1-.7-.3L.3 12.2a1 1 0 0 1 0-1.4l1.4-1.4a1 1 0 0 1 1.4 0l.7.7a1 1 0 0 0 1.4 0l.7-.7a1 1 0 0 0 0-1.4l-1.4-1.4a1 1 0 0 0-1.4 0L.3 8.8a1 1 0 0 0 0-1.4l.67-.67a1 1 0 0 0 .7-.3h.7a1 1 0 0 0 .7.3l1.4 1.4a1 1 0 0 0 1.4 0l1.4-1.4a1 1 0 0 0 0-1.4L6.83 2.204a1 1 0 0 0-1.4 0L.3 7.324a1 1 0 0 0 0 1.4l.67.67a1 1 0 0 0 .7.3h.7a1 1 0 0 0 .7-.3l5.12-5.12a1 1 0 0 1 1.4 0l1.4 1.4a1 1 0 0 1 0 1.4L10.3 8.8a1 1 0 0 1-1.4 0L8.8 7.4a1 1 0 0 1 0-1.4l1.4-1.4a1 1 0 0 1 1.4 0l1.4 1.4a1 1 0 0 1 0 1.4L11.6 9.9a1 1 0 0 1-1.4 0L8.8 8.5a1 1 0 0 1 0-1.4l1.4-1.4a1 1 0 0 1 1.4 0l1.4 1.4a1 1 0 0 1 0 1.4Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Categories</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/users"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V2a2 2 0 0 0-2-2Zm-3 13V8a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1Zm-4-5V8a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1Zm8 0V8a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/reports"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 16 20">
                            <path
                                d="M14 7h-2.25a.25.25 0 0 1-.25-.25v-2a.75.75 0 0 0-.75-.75H4a.75.75 0 0 0-.75.75v2c0 .138.112.25.25.25H3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-10 0v-1h8v1h-8Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Reports</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/orders"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M4.508 3.52a3.957 3.957 0 0 1 3.168-1.576 3.954 3.954 0 0 1 3.168 1.576 3.892 3.892 0 0 1 0 5.506 3.958 3.958 0 0 1-3.168 1.575 3.954 3.954 0 0 1-3.168-1.576 3.892 3.892 0 0 1 0-5.506Zm8.694 6.45c.152.15.326.272.517.362.19.09.395.147.605.168.21.02.42.004.62-.048a2.06 2.06 0 0 0 .448-.168 1.79 1.79 0 0 0 .352-.26l2.083-2.084a4.026 4.026 0 0 1 1.176 2.874c0 1.09-.43 2.135-1.204 2.908a4.078 4.078 0 0 1-2.908 1.204 4.027 4.027 0 0 1-2.874-1.176l-1.5 1.5a4 4 0 0 1-5.656 0 4 4 0 0 1 0-5.656l1.5-1.5a4.027 4.027 0 0 1 2.874-1.176c1.09 0 2.135.43 2.908 1.204a4.078 4.078 0 0 1 1.204 2.908 4.03 4.03 0 0 1-1.176 2.874Zm-1.307 1.307-1.5 1.5a2.027 2.027 0 0 0-1.437.592 2.078 2.078 0 0 0-.592 1.437c0 .545.218 1.067.604 1.453a2.078 2.078 0 0 0 1.453.604 2.03 2.03 0 0 0 1.437-.592l1.5-1.5a2 2 0 0 0 0-2.828 2 2 0 0 0-2.828 0Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Orders</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main content area -->
    <div class="flex flex-col flex-1 sm:ml-64">
        <!-- Header with profile at the top -->
        <header
            class="w-full bg-white dark:bg-[#161615] shadow-md py-4 px-6 flex justify-between items-center sticky top-0 z-10">
            <!-- Mobile menu button -->
            <button id="mobile-menu-button" type="button"
                class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <h1 class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Mie Ganas Dashboard</h1>

            <!-- Profile section -->
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button id="user-menu-button" type="button"
                        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        aria-expanded="false">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full"
                            src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=FF4433&color=fff"
                            alt="User avatar">
                    </button>
                    <!-- Dropdown menu -->
                    <div id="user-dropdown"
                        class="hidden absolute right-0 mt-2 w-48 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600 z-20">
                        <div class="px-4 py-3">
                            <span
                                class="block text-sm text-gray-900 dark:text-white">{{ auth()->user()->name ?? 'User' }}</span>
                            <span
                                class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">{{ auth()->user()->email ?? 'email@example.com' }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profile</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                        out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main content -->
        <main class="flex-grow p-4 sm:p-6">
            @yield('content')
        </main>
    </div>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <script>
        // Toggle dropdown
        document.getElementById('user-menu-button').addEventListener('click', function() {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('user-dropdown');
            const button = document.getElementById('user-menu-button');

            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
