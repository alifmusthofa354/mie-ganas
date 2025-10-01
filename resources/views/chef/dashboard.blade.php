@extends('layouts.dashboard')

@section('title', 'Chef Dashboard')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-[#1b1b18] dark:text-[#EDEDEC]">Chef Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Kitchen Orders</h2>
                <p class="text-[#706f6c] dark:text-[#A1A09A]">Manage food preparation and order status</p>
            </div>
            
            <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Quick Stats</h2>
                <ul class="text-[#706f6c] dark:text-[#A1A09A] list-disc pl-5 space-y-1">
                    <li>Pending Orders: 7</li>
                    <li>Today's Orders: 52</li>
                    <li>Completed: 45</li>
                </ul>
            </div>
        </div>
        
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Kitchen Operations</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="#" class="bg-[#f53003] hover:bg-[#d92902] text-white py-3 px-4 rounded-lg text-center transition duration-300">
                    View Orders
                </a>
                <a href="#" class="bg-[#f53003] hover:bg-[#d92902] text-white py-3 px-4 rounded-lg text-center transition duration-300">
                    Update Status
                </a>
                <a href="#" class="bg-[#f53003] hover:bg-[#d92902] text-white py-3 px-4 rounded-lg text-center transition duration-300">
                    Ingredients
                </a>
                <a href="#" class="bg-[#f53003] hover:bg-[#d92902] text-white py-3 px-4 rounded-lg text-center transition duration-300">
                    Menu Items
                </a>
            </div>
        </div>
        
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Navigation</h2>
            <div class="flex flex-wrap gap-4">
                <a href="/admin" class="bg-[#FF750F] hover:bg-[#e66a0d] text-white py-2 px-4 rounded-lg transition duration-300">
                    Admin Dashboard
                </a>
                <a href="/cashier" class="bg-[#FF750F] hover:bg-[#e66a0d] text-white py-2 px-4 rounded-lg transition duration-300">
                    Cashier Dashboard
                </a>
                <a href="/waiter" class="bg-[#FF750F] hover:bg-[#e66a0d] text-white py-2 px-4 rounded-lg transition duration-300">
                    Waiter Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection