@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">User Management</h1>
                <button class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                    Add New User
                </button>
            </div>

            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="user-search" class="block w-full p-4 pl-10 text-sm text-[#1b1b18] border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:placeholder-[#A1A09A] dark:text-[#EDEDEC] dark:focus:ring-[#f53003] dark:focus:border-[#f53003]" placeholder="Search users...">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">User</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Role</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Last Login</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe&background=FF4433&color=fff" alt="User avatar">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">John Doe</div>
                                        <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">john@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">Admin</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                Today, 10:30 AM
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-[#f53003] hover:text-[#d92902] mr-3">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Jane+Smith&background=3B82F6&color=fff" alt="User avatar">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Jane Smith</div>
                                        <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">jane@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">Cashier</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                Yesterday, 3:45 PM
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-[#f53003] hover:text-[#d92902] mr-3">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Bob+Johnson&background=10B981&color=fff" alt="User avatar">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Bob Johnson</div>
                                        <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">bob@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">Waiter</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Inactive</span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                Oct 1, 2025
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-[#f53003] hover:text-[#d92902] mr-3">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Alice+Brown&background=F59E0B&color=fff" alt="User avatar">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Alice Brown</div>
                                        <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">alice@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">Chef</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                Today, 9:20 AM
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-[#f53003] hover:text-[#d92902] mr-3">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">4</span> results
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-gray-50 dark:hover:bg-gray-700">
                        Previous
                    </button>
                    <button class="px-3 py-1 rounded-md bg-[#f53003] text-white text-sm hover:bg-[#d92902]">
                        1
                    </button>
                    <button class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-gray-50 dark:hover:bg-gray-700">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection