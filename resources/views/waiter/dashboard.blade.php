@extends('layouts.waiter')

@section('title', 'Waiter Dashboard')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Waiter Dashboard</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-base sm:text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Active Tables</h2>
                    <p class="text-xl sm:text-2xl font-bold text-[#f53003] dark:text-[#FF4433]">8</p>
                    <p class="text-xs sm:text-sm text-[#706f6c] dark:text-[#A1A09A]">of 12 tables</p>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-base sm:text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Pending Orders
                    </h2>
                    <p class="text-xl sm:text-2xl font-bold text-[#f53003] dark:text-[#FF4433]">12</p>
                    <p class="text-xs sm:text-sm text-[#706f6c] dark:text-[#A1A09A]">Needing attention</p>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-base sm:text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Completed Today
                    </h2>
                    <p class="text-xl sm:text-2xl font-bold text-[#f53003] dark:text-[#FF4433]">24</p>
                    <p class="text-xs sm:text-sm text-[#706f6c] dark:text-[#A1A09A]">Orders finished</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-3 sm:mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Active Orders</h2>
                    <div class="space-y-3">
                        <div class="p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div class="flex flex-col sm:flex-row sm:justify-between gap-2">
                                <span class="font-medium">Table #3</span>
                                <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">10:45 AM</span>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm">Nasi Goreng + Es Teh</p>
                                <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded">Preparing</span>
                            </div>
                        </div>
                        <div class="p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div class="flex flex-col sm:flex-row sm:justify-between gap-2">
                                <span class="font-medium">Table #7</span>
                                <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">11:15 AM</span>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm">Mie Ayam + Jeruk</p>
                                <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded">Ready</span>
                            </div>
                        </div>
                        <div class="p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div class="flex flex-col sm:flex-row sm:justify-between gap-2">
                                <span class="font-medium">Table #2</span>
                                <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">11:30 AM</span>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm">Bakso + Teh Panas</p>
                                <span class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded">Delayed</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-3 sm:mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Quick Actions</h2>
                    <div class="space-y-2 sm:space-y-3">
                        <a href="#"
                            class="flex items-center p-2 sm:p-3 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                            <svg class="w-4 sm:w-5 h-4 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="text-sm sm:text-base">Take New Order</span>
                        </a>
                        <a href="#"
                            class="flex items-center p-2 sm:p-3 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                            <svg class="w-4 sm:w-5 h-4 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <span class="text-sm sm:text-base">View Menu</span>
                        </a>
                        <a href="#"
                            class="flex items-center p-2 sm:p-3 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                            <svg class="w-4 sm:w-5 h-4 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-sm sm:text-base">Customer Request</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
