@extends('layouts.admin')

@section('title', 'Menu Management')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Menu Management</h1>
                <button
                    class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                    Add New Item
                </button>
            </div>

            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="menu-search"
                        class="block w-full p-4 pl-10 text-sm text-[#1b1b18] border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:placeholder-[#A1A09A] dark:text-[#EDEDEC] dark:focus:ring-[#f53003] dark:focus:border-[#f53003]"
                        placeholder="Search menu items...">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- KARTU PRODUK 1: Nasi Goreng --}}
                {{-- Tambahkan kelas flex, flex-col, justify-between, dan min-h-[300px] pada kartu --}}
                <div
                    class="bg-[#FDFDFC] dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 flex flex-col justify-between min-h-[300px]">
                    <div class="p-4 flex-grow flex flex-col">
                        <div class="flex justify-between items-start">
                            <div class="flex-grow">
                                {{-- Kotak gambar dengan kelas object-cover untuk memastikan gambar mengisi kotak dengan benar --}}
                                <div class="w-full h-36 mx-auto mb-3 overflow-hidden rounded-md">
                                    <img src="{{ asset('images/nasi-goreng.jpg') }}" alt="Nasi Goreng"
                                        class="w-full h-full object-cover">
                                </div>
                                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Nasi Goreng</h3>
                                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4">Mie Ganas Special Nasi Goreng</p>
                            </div>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </div>
                        {{-- Div harga dan tombol aksi --}}
                        <div class="mt-auto flex justify-between items-center">
                            <span class="text-xl font-bold text-[#f53003] dark:text-[#FF4433]">Rp 25,000</span>
                            <div class="flex space-x-2">
                                <button class="text-[#f53003] hover:text-[#d92902]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KARTU PRODUK 2: Mie Ayam (Deskripsi lebih pendek) --}}
                {{-- Tambahkan kelas flex, flex-col, justify-between, dan min-h-[300px] pada kartu --}}
                <div
                    class="bg-[#FDFDFC] dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 flex flex-col justify-between min-h-[300px]">
                    <div class="p-4 flex-grow flex flex-col">
                        <div class="flex justify-between items-start">
                            <div class="flex-grow">
                                <div class="w-full h-36 mx-auto mb-3 overflow-hidden rounded-md">
                                    <img src="{{ asset('images/mie-ayam.jpg') }}" alt="Mie Ayam"
                                        class="w-full h-full object-cover">
                                </div>
                                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Mie Ayam</h3>
                                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4">Ayam original dengan kuah gurih
                                </p>
                            </div>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </div>
                        <div class="mt-auto flex justify-between items-center">
                            <span class="text-xl font-bold text-[#f53003] dark:text-[#FF4433]">Rp 22,000</span>
                            <div class="flex space-x-2">
                                <button class="text-[#f53003] hover:text-[#d92902]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KARTU PRODUK 3: Bakso --}}
                {{-- Tambahkan kelas flex, flex-col, justify-between, dan min-h-[300px] pada kartu --}}
                <div
                    class="bg-[#FDFDFC] dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 flex flex-col justify-between min-h-[300px]">
                    <div class="p-4 flex-grow flex flex-col">
                        <div class="flex justify-between items-start">
                            <div class="flex-grow">
                                <div class="w-full h-36 mx-auto mb-3 overflow-hidden rounded-md">
                                    <img src="{{ asset('images/bakso.jpg') }}" alt="Bakso"
                                        class="w-full h-full object-cover">
                                </div>
                                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Bakso</h3>
                                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4">Bakso urat dengan kuah bening</p>
                            </div>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Inactive</span>
                        </div>
                        <div class="mt-auto flex justify-between items-center">
                            <span class="text-xl font-bold text-[#f53003] dark:text-[#FF4433]">Rp 18,000</span>
                            <div class="flex space-x-2">
                                <button class="text-[#f53003] hover:text-[#d92902]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KARTU PRODUK 4: Sate Ayam --}}
                {{-- Tambahkan kelas flex, flex-col, justify-between, dan min-h-[300px] pada kartu --}}
                <div
                    class="bg-[#FDFDFC] dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 flex flex-col justify-between min-h-[300px]">
                    <div class="p-4 flex-grow flex flex-col">
                        <div class="flex justify-between items-start">
                            <div class="flex-grow">
                                <div class="w-full h-36 mx-auto mb-3 overflow-hidden rounded-md">
                                    <img src="{{ asset('images/sate-ayam.jpg') }}" alt="Sate Ayam"
                                        class="w-full h-full object-cover">
                                </div>
                                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Sate Ayam</h3>
                                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4">Sate ayam dengan bumbu kacang
                                </p>
                            </div>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </div>
                        <div class="mt-auto flex justify-between items-center">
                            <span class="text-xl font-bold text-[#f53003] dark:text-[#FF4433]">Rp 20,000</span>
                            <div class="flex space-x-2">
                                <button class="text-[#f53003] hover:text-[#d92902]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KARTU PRODUK 5: Es Teh --}}
                {{-- Tambahkan kelas flex, flex-col, justify-between, dan min-h-[300px] pada kartu --}}
                <div
                    class="bg-[#FDFDFC] dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 flex flex-col justify-between min-h-[300px]">
                    <div class="p-4 flex-grow flex flex-col">
                        <div class="flex justify-between items-start">
                            <div class="flex-grow">
                                <div class="w-full h-36 mx-auto mb-3 overflow-hidden rounded-md">
                                    <img src="{{ asset('images/es-teh.jpg') }}" alt="Es Teh"
                                        class="w-full h-full object-cover">
                                </div>
                                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Es Teh</h3>
                                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4">Es teh manis segar</p>
                            </div>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </div>
                        <div class="mt-auto flex justify-between items-center">
                            <span class="text-xl font-bold text-[#f53003] dark:text-[#FF4433]">Rp 5,000</span>
                            <div class="flex space-x-2">
                                <button class="text-[#f53003] hover:text-[#d92902]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KARTU PRODUK 6: Jus Alpukat --}}
                {{-- Tambahkan kelas flex, flex-col, justify-between, dan min-h-[300px] pada kartu --}}
                <div
                    class="bg-[#FDFDFC] dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 flex flex-col justify-between min-h-[300px]">
                    <div class="p-4 flex-grow flex flex-col">
                        <div class="flex justify-between items-start">
                            <div class="flex-grow">
                                <div class="w-full h-36 mx-auto mb-3 overflow-hidden rounded-md">
                                    <img src="{{ asset('images/jus-alpukat.jpg') }}" alt="Jus Alpukat"
                                        class="w-full h-full object-cover">
                                </div>
                                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Jus Alpukat</h3>
                                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4">Jus alpukat original</p>
                            </div>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </div>
                        <div class="mt-auto flex justify-between items-center">
                            <span class="text-xl font-bold text-[#f53003] dark:text-[#FF4433]">Rp 15,000</span>
                            <div class="flex space-x-2">
                                <button class="text-[#f53003] hover:text-[#d92902]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">6</span> of <span
                        class="font-medium">12</span> results
                </div>
                <div class="flex space-x-2">
                    <button
                        class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-gray-50 dark:hover:bg-gray-700">
                        Previous
                    </button>
                    <button class="px-3 py-1 rounded-md bg-[#f53003] text-white text-sm hover:bg-[#d92902]">
                        1
                    </button>
                    <button
                        class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-gray-50 dark:hover:bg-gray-700">
                        2
                    </button>
                    <button
                        class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-gray-50 dark:hover:bg-gray-700">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
