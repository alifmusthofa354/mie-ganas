@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Admin Dashboard</h1>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-base sm:text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Total Orders</h2>
                    <p class="text-xl sm:text-2xl font-bold text-[#f53003] dark:text-[#FF4433]">240</p>
                    <p class="text-xs sm:text-sm text-[#706f6c] dark:text-[#A1A09A]">+12% from last month</p>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-base sm:text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Revenue</h2>
                    <p class="text-xl sm:text-2xl font-bold text-[#f53003] dark:text-[#FF4433]">$12,450</p>
                    <p class="text-xs sm:text-sm text-[#706f6c] dark:text-[#A1A09A]">+8% from last month</p>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-base sm:text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Active Users</h2>
                    <p class="text-xl sm:text-2xl font-bold text-[#f53003] dark:text-[#FF4433]">32</p>
                    <p class="text-xs sm:text-sm text-[#706f6c] dark:text-[#A1A09A]">+3 from yesterday</p>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-base sm:text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Pending Orders</h2>
                    <p class="text-xl sm:text-2xl font-bold text-[#f53003] dark:text-[#FF4433]">5</p>
                    <p class="text-xs sm:text-sm text-[#706f6c] dark:text-[#A1A09A]">Update required</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                <div class="lg:col-span-2 bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-3 sm:mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Recent Orders</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-3 sm:px-4 py-2 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Order ID</th>
                                    <th class="px-3 sm:px-4 py-2 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Customer</th>
                                    <th class="px-3 sm:px-4 py-2 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Status</th>
                                    <th class="px-3 sm:px-4 py-2 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">#ORD-001</td>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">John Doe</td>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                    </td>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">$24.99</td>
                                </tr>
                                <tr>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">#ORD-002</td>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">Jane Smith</td>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                                    </td>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">$18.50</td>
                                </tr>
                                <tr>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">#ORD-003</td>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">Bob Johnson</td>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                                    </td>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">$32.75</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-3 sm:mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Quick Actions</h2>
                    <div class="space-y-2 sm:space-y-3">
                        <a href="#" class="flex items-center p-2 sm:p-3 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                            <svg class="w-4 sm:w-5 h-4 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="text-sm sm:text-base">Add New User</span>
                        </a>
                        <a href="#" class="flex items-center p-2 sm:p-3 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                            <svg class="w-4 sm:w-5 h-4 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v5a2 2 0 01-2 2H9a2 2 0 01-2-2v-5m6-5V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2"></path>
                            </svg>
                            <span class="text-sm sm:text-base">Manage Menu</span>
                        </a>
                        <a href="#" class="flex items-center p-2 sm:p-3 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                            <svg class="w-4 sm:w-5 h-4 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span class="text-sm sm:text-base">Generate Report</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection