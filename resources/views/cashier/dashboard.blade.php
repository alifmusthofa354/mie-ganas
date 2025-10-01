@extends('layouts.dashboard')

@section('title', 'Cashier Dashboard')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Cashier Dashboard</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Today's Sales</h2>
                    <p class="text-[#706f6c] dark:text-[#A1A09A]">Manage transactions and process orders</p>
                </div>

                <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">Quick Stats</h2>
                    <ul class="text-[#706f6c] dark:text-[#A1A09A] list-disc pl-5 space-y-1">
                        <li>Orders Today: 42</li>
                        <li>Total Sales: $1,240</li>
                        <li>Avg. Order: $29.52</li>
                    </ul>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Cashier Operations</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="#"
                        class="bg-[#f53003] hover:bg-[#d92902] text-white py-3 px-4 rounded-lg text-center transition duration-300">
                        New Order
                    </a>
                    <a href="#"
                        class="bg-[#f53003] hover:bg-[#d92902] text-white py-3 px-4 rounded-lg text-center transition duration-300">
                        Process Payment
                    </a>
                    <a href="#"
                        class="bg-[#f53003] hover:bg-[#d92902] text-white py-3 px-4 rounded-lg text-center transition duration-300">
                        Open Orders
                    </a>
                    <a href="#"
                        class="bg-[#f53003] hover:bg-[#d92902] text-white py-3 px-4 rounded-lg text-center transition duration-300">
                        Transaction History
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
