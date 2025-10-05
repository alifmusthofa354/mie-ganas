@extends('layouts.admin')

@section('title', $menu->name)

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Menu Details</h1>
                <a href="{{ route('admin.menus.index') }}"
                    class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition duration-300">
                    Back to Menu
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    @if ($menu->image)
                        <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}"
                            class="w-full h-64 object-cover rounded-md">
                    @else
                        <div
                            class="bg-gray-200 border-2 border-dashed rounded-md w-full h-64 flex items-center justify-center text-gray-500">
                            No Image
                        </div>
                    @endif
                </div>

                <div>
                    <div class="mb-4">
                        <h2 class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $menu->name }}</h2>
                        <p class="text-[#706f6c] dark:text-[#A1A09A]">{{ $menu->description }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-lg font-bold text-[#f53003] dark:text-[#FF4433]">Rp
                            {{ number_format($menu->price, 0, ',', '.') }}</p>
                    </div>

                    <div class="mb-4">
                        <span
                            class="px-2 py-1 text-xs font-semibold rounded-full 
                        {{ $menu->status === 'active' ? 'bg-green-500' : 'bg-yellow-500' }} 
                        text-white shadow-md">
                            {{ ucfirst($menu->status) }}
                        </span>
                    </div>

                    @if ($menu->category)
                        <div class="mb-4">
                            <p class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                                <span class="font-medium">Category:</span> {{ $menu->category->name }}
                            </p>
                        </div>
                    @endif

                    <div class="flex space-x-3 mt-6">
                        <a href="{{ route('admin.menus.edit', $menu) }}"
                            class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                            Edit
                        </a>
                        <!-- Delete Button -->
                        <button data-modal-target="delete-modal-{{ $menu->id }}"
                            data-modal-toggle="delete-modal-{{ $menu->id }}"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-300">
                            Delete
                        </button>

                        <!-- Delete Confirmation Modals -->
                        <div id="delete-modal-{{ $menu->id }}" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="delete-modal-{{ $menu->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you
                                            sure you want
                                            to delete menu <strong>{{ $menu->name }}</strong>?</h3>
                                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST"
                                            class="inline">
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
                        <!-- End Delete Confirmation Modals -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
