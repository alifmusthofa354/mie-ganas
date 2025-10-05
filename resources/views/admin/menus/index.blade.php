@extends('layouts.admin')

@section('title', 'Menu Management')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Menu Management</h1>
                <a href="{{ route('admin.menus.create') }}"
                    class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                    Add New Item
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter Form -->
            <form method="GET" action="{{ route('admin.menus.index') }}" class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full px-4 py-2 text-sm text-[#1b1b18] border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:placeholder-[#A1A09A] dark:text-[#EDEDEC] dark:focus:ring-[#f53003] dark:focus:border-[#f53003]"
                            placeholder="Search menu items...">
                    </div>
                    <div>
                        <select name="status"
                            class="w-full px-4 py-2 text-sm text-[#1b1b18] border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:placeholder-[#A1A09A] dark:text-[#EDEDEC] dark:focus:ring-[#f53003] dark:focus:border-[#f53003]">
                            <option value="">All Statuses</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                    <div>
                        <select name="category"
                            class="w-full px-4 py-2 text-sm text-[#1b1b18] border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:placeholder-[#A1A09A] dark:text-[#EDEDEC] dark:focus:ring-[#f53003] dark:focus:border-[#f53003]">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex space-x-2">
                        <button type="submit"
                            class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                            Filter
                        </button>
                        <a href="{{ route('admin.menus.index') }}"
                            class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition duration-300">
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($menus as $menu)
                    <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 flex flex-col justify-between min-h-[300px]"
                        id="menu-{{ $menu->id }}">
                        <div class="p-4 flex-grow flex flex-col">
                            <div class="relative mb-3">
                                <div class="w-full h-36 mx-auto overflow-hidden rounded-md">
                                    @if ($menu->image)
                                        <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="bg-gray-200 border-2 border-dashed rounded-md w-full h-full flex items-center justify-center text-gray-500">
                                            No Image
                                        </div>
                                    @endif
                                </div>
                                <span
                                    class="absolute top-2 right-2 z-10 px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $menu->status === 'active' ? 'bg-green-500' : 'bg-yellow-500' }} 
                                    text-white shadow-md">
                                    {{ ucfirst($menu->status) }}
                                </span>
                            </div>

                            <div class="flex-grow">
                                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $menu->name }}</h3>
                                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4">{{ $menu->description }}</p>
                                @if ($menu->category)
                                    <span
                                        class="text-xs px-2 py-1 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded">
                                        {{ $menu->category->name }}
                                    </span>
                                @endif
                            </div>

                            <div class="mt-auto flex justify-between items-center">
                                <span class="text-xl font-bold text-[#f53003] dark:text-[#FF4433]">Rp
                                    {{ number_format($menu->price, 0, ',', '.') }}</span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.menus.show', $menu) }}"
                                        class="text-[#f53003] hover:text-[#d92902]">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.menus.edit', $menu) }}"
                                        class="text-[#f53003] hover:text-[#d92902]">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <button data-modal-target="delete-modal-{{ $menu->id }}"
                                        data-modal-toggle="delete-modal-{{ $menu->id }}"
                                        class="text-red-600 hover:text-red-900">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-[#706f6c] dark:text-[#A1A09A]">No menu items found.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex w-full">
                <div class="w-full">
                    {{ $menus->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            </div>

            <!-- Delete Confirmation Modals -->
            @foreach ($menus as $menu)
                <div id="delete-modal-{{ $menu->id }}" tabindex="-1"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                            <button type="button"
                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="delete-modal-{{ $menu->id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want
                                    to delete menu <strong>{{ $menu->name }}</strong>?</h3>
                                <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Yes, I'm sure
                                    </button>
                                </form>
                                <button data-modal-hide="delete-modal-{{ $menu->id }}" type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                    cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- End Delete Confirmation Modals -->

        </div>
    </div>
@endsection
