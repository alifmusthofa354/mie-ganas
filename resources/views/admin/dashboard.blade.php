@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-[#1b1b18] dark:text-[#EDEDEC]">Admin Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Overview</h2>
                <p class="text-[#706f6c] dark:text-[#A1A09A]">Manage all aspects of the restaurant system</p>
            </div>
            
            <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Quick Stats</h2>
                <ul class="text-[#706f6c] dark:text-[#A1A09A] list-disc pl-5 space-y-1">
                    <li>Total Orders: 240</li>
                    <li>Revenue: $12,450</li>
                    <li>Active Users: 32</li>
                </ul>
            </div>
        </div>
        
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Management Tools</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="#" class="bg-[#f53003] hover:bg-[#d92902] text-white py-3 px-4 rounded-lg text-center transition duration-300">
                    User Management
                </a>
                <a href="#" class="bg-[#f53003] hover:bg-[#d92902] text-white py-3 px-4 rounded-lg text-center transition duration-300">
                    Menu Management
                </a>
                <a href="#" class="bg-[#f53003] hover:bg-[#d92902] text-white py-3 px-4 rounded-lg text-center transition duration-300">
                    Orders
                </a>
                <a href="#" class="bg-[#f53003] hover:bg-[#d92902] text-white py-3 px-4 rounded-lg text-center transition duration-300">
                    Reports
                </a>
            </div>
        </div>
        
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">User Roles</h2>
            <div class="flex space-x-4">
                <a href="/cashier" class="bg-[#FF750F] hover:bg-[#e66a0d] text-white py-2 px-4 rounded-lg transition duration-300">
                    Cashier Dashboard
                </a>
                <a href="/waiter" class="bg-[#FF750F] hover:bg-[#e66a0d] text-white py-2 px-4 rounded-lg transition duration-300">
                    Waiter Dashboard
                </a>
                <a href="/chef" class="bg-[#FF750F] hover:bg-[#e66a0d] text-white py-2 px-4 rounded-lg transition duration-300">
                    Chef Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection