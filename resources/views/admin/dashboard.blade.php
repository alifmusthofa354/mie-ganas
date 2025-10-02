@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Admin Dashboard</h1>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Welcome back, {{ auth()->user()->name }}!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-[#f53003]/10 dark:bg-[#f53003]/20">
                            <svg class="w-6 h-6 text-[#f53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-[#706f6c] dark:text-[#A1A09A]">Total Users</h2>
                            <p class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">124</p>
                        </div>
                    </div>
                    <a href="/admin/users" class="mt-4 inline-block text-sm text-[#f53003] dark:text-[#FF4433] hover:underline">View details →</a>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-[#f53003]/10 dark:bg-[#f53003]/20">
                            <svg class="w-6 h-6 text-[#f53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-[#706f6c] dark:text-[#A1A09A]">Total Revenue</h2>
                            <p class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">$5,680</p>
                        </div>
                    </div>
                    <a href="/admin/reports" class="mt-4 inline-block text-sm text-[#f53003] dark:text-[#FF4433] hover:underline">View details →</a>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-[#f53003]/10 dark:bg-[#f53003]/20">
                            <svg class="w-6 h-6 text-[#f53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-[#706f6c] dark:text-[#A1A09A]">Menu Items</h2>
                            <p class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">36</p>
                        </div>
                    </div>
                    <a href="/admin/menu" class="mt-4 inline-block text-sm text-[#f53003] dark:text-[#FF4433] hover:underline">View details →</a>
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
                            <p class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">42</p>
                        </div>
                    </div>
                    <a href="/admin/orders" class="mt-4 inline-block text-sm text-[#f53003] dark:text-[#FF4433] hover:underline">View details →</a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Recent Orders</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div>
                                <p class="font-medium">#ORD-001</p>
                                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">John Doe</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">$24.99</p>
                                <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded">Completed</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div>
                                <p class="font-medium">#ORD-002</p>
                                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Jane Smith</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">$18.50</p>
                                <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded">Processing</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700">
                            <div>
                                <p class="font-medium">#ORD-003</p>
                                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Bob Johnson</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">$32.75</p>
                                <span class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded">Cancelled</span>
                            </div>
                        </div>
                    </div>
                    <a href="/admin/orders" class="mt-4 inline-block text-sm text-[#f53003] dark:text-[#FF4433] hover:underline">View all orders →</a>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Quick Actions</h2>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="/admin/users" class="flex flex-col items-center justify-center p-4 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <div class="p-3 rounded-full bg-[#f53003]/10 dark:bg-[#f53003]/20 mb-2">
                                <svg class="w-6 h-6 text-[#f53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Manage Users</span>
                        </a>
                        <a href="/admin/menu" class="flex flex-col items-center justify-center p-4 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <div class="p-3 rounded-full bg-[#f53003]/10 dark:bg-[#f53003]/20 mb-2">
                                <svg class="w-6 h-6 text-[#f53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Manage Menu</span>
                        </a>
                        <a href="/admin/orders" class="flex flex-col items-center justify-center p-4 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <div class="p-3 rounded-full bg-[#f53003]/10 dark:bg-[#f53003]/20 mb-2">
                                <svg class="w-6 h-6 text-[#f53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">View Orders</span>
                        </a>
                        <a href="/admin/reports" class="flex flex-col items-center justify-center p-4 bg-white dark:bg-[#1E1E1C] rounded border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <div class="p-3 rounded-full bg-[#f53003]/10 dark:bg-[#f53003]/20 mb-2">
                                <svg class="w-6 h-6 text-[#f53003] dark:text-[#FF4433]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">View Reports</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection