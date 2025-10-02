@extends('layouts.admin')

@section('title', 'Orders Management')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Orders Management</h1>
                <div class="flex space-x-3">
                    <select class="px-3 py-2 text-sm border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:text-[#EDEDEC]">
                        <option>All Status</option>
                        <option>Pending</option>
                        <option>Processing</option>
                        <option>Completed</option>
                        <option>Cancelled</option>
                    </select>
                    <button class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                        Refresh
                    </button>
                </div>
            </div>

            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="order-search" class="block w-full p-4 pl-10 text-sm text-[#1b1b18] border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:placeholder-[#A1A09A] dark:text-[#EDEDEC] dark:focus:ring-[#f53003] dark:focus:border-[#f53003]" placeholder="Search orders...">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Order ID</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Customer</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Items</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Total</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">#ORD-001</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">John Doe</div>
                                <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">john@example.com</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                <ul class="list-disc list-inside">
                                    <li>Nasi Goreng (1x)</li>
                                    <li>Es Teh (2x)</li>
                                </ul>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Rp 35,000</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">Today, 10:30 AM</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-[#f53003] hover:text-[#d92902] mr-2">View</a>
                                <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">#ORD-002</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">Jane Smith</div>
                                <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">jane@example.com</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                <ul class="list-disc list-inside">
                                    <li>Mie Ayam (1x)</li>
                                    <li>Jeruk (1x)</li>
                                </ul>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Rp 27,000</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">Today, 11:15 AM</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-[#f53003] hover:text-[#d92902] mr-2">View</a>
                                <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">#ORD-003</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">Bob Johnson</div>
                                <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">bob@example.com</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                <ul class="list-disc list-inside">
                                    <li>Bakso (1x)</li>
                                    <li>Teh Panas (1x)</li>
                                </ul>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Rp 23,000</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">Yesterday, 4:20 PM</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-[#f53003] hover:text-[#d92902] mr-2">View</a>
                                <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">#ORD-004</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">Alice Brown</div>
                                <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">alice@example.com</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                <ul class="list-disc list-inside">
                                    <li>Sate Ayam (2x)</li>
                                    <li>Es Teh (1x)</li>
                                </ul>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Rp 45,000</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">Today, 9:45 AM</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-[#f53003] hover:text-[#d92902] mr-2">View</a>
                                <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">#ORD-005</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">Charlie Wilson</div>
                                <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">charlie@example.com</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                <ul class="list-disc list-inside">
                                    <li>Jus Alpukat (1x)</li>
                                    <li>Mie Ayam (1x)</li>
                                </ul>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Rp 37,000</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Ready</span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">Today, 8:30 AM</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-[#f53003] hover:text-[#d92902] mr-2">View</a>
                                <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">24</span> results
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-gray-50 dark:hover:bg-gray-700">
                        Previous
                    </button>
                    <button class="px-3 py-1 rounded-md bg-[#f53003] text-white text-sm hover:bg-[#d92902]">
                        1
                    </button>
                    <button class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-gray-50 dark:hover:bg-gray-700">
                        2
                    </button>
                    <button class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-gray-50 dark:hover:bg-gray-700">
                        3
                    </button>
                    <button class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-gray-50 dark:hover:bg-gray-700">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection