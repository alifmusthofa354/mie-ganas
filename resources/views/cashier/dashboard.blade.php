@extends('layouts.cashier')

@section('title', 'Cashier Dashboard')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Cashier Dashboard</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-base sm:text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Today's Sales</h2>
                    <p class="text-xl sm:text-2xl font-bold text-[#f53003] dark:text-[#FF4433]">$1,245</p>
                    <p class="text-xs sm:text-sm text-[#706f6c] dark:text-[#A1A09A]">+5% from yesterday</p>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-base sm:text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Orders Today</h2>
                    <p class="text-xl sm:text-2xl font-bold text-[#f53003] dark:text-[#FF4433]">42</p>
                    <p class="text-xs sm:text-sm text-[#706f6c] dark:text-[#A1A09A]">+8 from yesterday</p>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-base sm:text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Active Orders
                    </h2>
                    <p class="text-xl sm:text-2xl font-bold text-[#f53003] dark:text-[#FF4433]">5</p>
                    <p class="text-xs sm:text-sm text-[#706f6c] dark:text-[#A1A09A]">Pending completion</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-3 sm:p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-3 sm:mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Recent Transactions
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th
                                        class="px-3 sm:px-4 py-2 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">
                                        Order ID</th>
                                    <th
                                        class="px-3 sm:px-4 py-2 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">
                                        Customer</th>
                                    <th
                                        class="px-3 sm:px-4 py-2 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">
                                        Amount</th>
                                    <th
                                        class="px-3 sm:px-4 py-2 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td
                                        class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                                        #ORD-001</td>
                                    <td
                                        class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                                        John Doe</td>
                                    <td
                                        class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                                        $24.99</td>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Paid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                                        #ORD-002</td>
                                    <td
                                        class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                                        Jane Smith</td>
                                    <td
                                        class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                                        $18.50</td>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Paid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                                        #ORD-003</td>
                                    <td
                                        class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                                        Bob Johnson</td>
                                    <td
                                        class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                                        $32.75</td>
                                    <td class="px-3 sm:px-4 py-2 sm:py-3 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
                            <span class="text-sm sm:text-base">New Transaction</span>
                        </a>
                        <a href="#"
                            class="flex items-center p-2 sm:p-3 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                            <svg class="w-4 sm:w-5 h-4 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            <span class="text-sm sm:text-base">View Reports</span>
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
                            <span class="text-sm sm:text-base">Settings</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
