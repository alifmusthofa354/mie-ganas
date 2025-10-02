@extends('layouts.chef')

@section('title', 'Chef Dashboard')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Chef Dashboard</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-base sm:text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Pending Orders
                    </h2>
                    <p class="text-xl sm:text-2xl font-bold text-[#f53003] dark:text-[#FF4433]">6</p>
                    <p class="text-xs sm:text-sm text-[#706f6c] dark:text-[#A1A09A]">Waiting to be prepared</p>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-base sm:text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Cooking</h2>
                    <p class="text-xl sm:text-2xl font-bold text-[#f53003] dark:text-[#FF4433]">3</p>
                    <p class="text-xs sm:text-sm text-[#706f6c] dark:text-[#A1A09A]">Currently being prepared</p>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-base sm:text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Completed Today
                    </h2>
                    <p class="text-xl sm:text-2xl font-bold text-[#f53003] dark:text-[#FF4433]">32</p>
                    <p class="text-xs sm:text-sm text-[#706f6c] dark:text-[#A1A09A]">Orders finished</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-3 sm:mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Orders to Prepare</h2>
                    <div class="space-y-3">
                        <div class="p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div class="flex flex-col sm:flex-row sm:justify-between gap-2">
                                <span class="font-medium">#ORD-001 - Table 3</span>
                                <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">10:45 AM</span>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm">Nasi Goreng (1x)</p>
                                <p class="text-sm">Es Teh Manis (2x)</p>
                                <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded">Preparation
                                    Started</span>
                            </div>
                        </div>
                        <div class="p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div class="flex flex-col sm:flex-row sm:justify-between gap-2">
                                <span class="font-medium">#ORD-002 - Table 5</span>
                                <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">11:00 AM</span>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm">Mie Ayam (2x)</p>
                                <p class="text-sm">Air Mineral (2x)</p>
                                <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded">New Order</span>
                            </div>
                        </div>
                        <div class="p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div class="flex flex-col sm:flex-row sm:justify-between gap-2">
                                <span class="font-medium">#ORD-003 - Table 2</span>
                                <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">11:15 AM</span>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm">Bakso Telur (1x)</p>
                                <span class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded">Special Request</span>
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
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            <span class="text-sm sm:text-base">View All Orders</span>
                        </a>
                        <a href="#"
                            class="flex items-center p-2 sm:p-3 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                            <svg class="w-4 sm:w-5 h-4 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm sm:text-base">View Order History</span>
                        </a>
                        <a href="#"
                            class="flex items-center p-2 sm:p-3 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                            <svg class="w-4 sm:w-5 h-4 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm sm:text-base">Kitchen Settings</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
