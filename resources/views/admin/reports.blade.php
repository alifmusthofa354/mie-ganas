@extends('layouts.admin')

@section('title', 'Reports')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Reports</h1>
                <div class="flex space-x-3">
                    <select class="px-3 py-2 text-sm border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:text-[#EDEDEC]">
                        <option>Last 7 Days</option>
                        <option>Last 30 Days</option>
                        <option>Last 3 Months</option>
                        <option>Last Year</option>
                    </select>
                    <button class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                        Generate Report
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-[#f53003]/10 dark:bg-[#f53003]/20">
                            <svg class="w-6 h-6 text-[#f53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-[#706f6c] dark:text-[#A1A09A]">Total Revenue</h2>
                            <p class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">$5,680</p>
                            <p class="text-xs text-green-500">+12% from last period</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-[#f53003]/10 dark:bg-[#f53003]/20">
                            <svg class="w-6 h-6 text-[#f53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-[#706f6c] dark:text-[#A1A09A]">Total Orders</h2>
                            <p class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">142</p>
                            <p class="text-xs text-green-500">+8% from last period</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-[#f53003]/10 dark:bg-[#f53003]/20">
                            <svg class="w-6 h-6 text-[#f53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-[#706f6c] dark:text-[#A1A09A]">Items Sold</h2>
                            <p class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">356</p>
                            <p class="text-xs text-green-500">+5% from last period</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-[#f53003]/10 dark:bg-[#f53003]/20">
                            <svg class="w-6 h-6 text-[#f53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-[#706f6c] dark:text-[#A1A09A]">Active Customers</h2>
                            <p class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">89</p>
                            <p class="text-xs text-green-500">+3% from last period</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Revenue Overview</h2>
                    <div class="h-64 flex items-center justify-center">
                        <div class="text-center">
                            <div class="mx-auto w-16 h-16 bg-[#f53003]/10 dark:bg-[#f53003]/20 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-8 h-8 text-[#f53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Chart visualization would appear here</p>
                            <p class="text-xs mt-1 text-[#706f6c] dark:text-[#A1A09A]">Revenue chart data visualization</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Top Selling Items</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-[#f53003]/10 dark:bg-[#f53003]/20 flex items-center justify-center mr-3">
                                    <span class="text-xs font-bold text-[#f53003] dark:text-[#FF4433]">1</span>
                                </div>
                                <span class="font-medium">Nasi Goreng</span>
                            </div>
                            <span class="text-sm font-semibold">24 sold</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-[#f53003]/10 dark:bg-[#f53003]/20 flex items-center justify-center mr-3">
                                    <span class="text-xs font-bold text-[#f53003] dark:text-[#FF4433]">2</span>
                                </div>
                                <span class="font-medium">Mie Ayam</span>
                            </div>
                            <span class="text-sm font-semibold">18 sold</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-[#f53003]/10 dark:bg-[#f53003]/20 flex items-center justify-center mr-3">
                                    <span class="text-xs font-bold text-[#f53003] dark:text-[#FF4433]">3</span>
                                </div>
                                <span class="font-medium">Bakso</span>
                            </div>
                            <span class="text-sm font-semibold">15 sold</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-[#f53003]/10 dark:bg-[#f53003]/20 flex items-center justify-center mr-3">
                                    <span class="text-xs font-bold text-[#f53003] dark:text-[#FF4433]">4</span>
                                </div>
                                <span class="font-medium">Sate Ayam</span>
                            </div>
                            <span class="text-sm font-semibold">12 sold</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-[#f53003]/10 dark:bg-[#f53003]/20 flex items-center justify-center mr-3">
                                    <span class="text-xs font-bold text-[#f53003] dark:text-[#FF4433]">5</span>
                                </div>
                                <span class="font-medium">Es Teh</span>
                            </div>
                            <span class="text-sm font-semibold">32 sold</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Export Report</h2>
                <div class="flex flex-wrap gap-3">
                    <button class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export to PDF
                        </div>
                    </button>
                    <button class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export to Excel
                        </div>
                    </button>
                    <button class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export to CSV
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection