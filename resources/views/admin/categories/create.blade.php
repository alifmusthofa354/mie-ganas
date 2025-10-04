@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-6">Create New Category</h1>
            
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Category Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required
                        class="w-full p-2 border border-gray-300 rounded-md bg-[#FDFDFC] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:text-[#EDEDEC] focus:ring-[#f53003] focus:border-[#f53003]">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Description</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="3"
                        class="w-full p-2 border border-gray-300 rounded-md bg-[#FDFDFC] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:text-[#EDEDEC] focus:ring-[#f53003] focus:border-[#f53003]">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="icon" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Icon Class</label>
                    <input 
                        type="text" 
                        id="icon" 
                        name="icon" 
                        value="{{ old('icon') }}"
                        placeholder="e.g., fa-bowl-rice"
                        class="w-full p-2 border border-gray-300 rounded-md bg-[#FDFDFC] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:text-[#EDEDEC] focus:ring-[#f53003] focus:border-[#f53003]">
                    @error('icon')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="display_order" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Display Order</label>
                    <input 
                        type="number" 
                        id="display_order" 
                        name="display_order" 
                        value="{{ old('display_order') ?? 0 }}"
                        min="0"
                        class="w-full p-2 border border-gray-300 rounded-md bg-[#FDFDFC] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:text-[#EDEDEC] focus:ring-[#f53003] focus:border-[#f53003]">
                    @error('display_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Status</label>
                    <div class="flex items-center space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="is_active" value="1" {{ old('is_active') !== false ? 'checked' : '' }} class="text-[#f53003] focus:ring-[#f53003]">
                            <span class="ml-2 text-[#1b1b18] dark:text-[#EDEDEC]">Active</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="is_active" value="0" {{ old('is_active') === false ? 'checked' : '' }} class="text-[#f53003] focus:ring-[#f53003]">
                            <span class="ml-2 text-[#1b1b18] dark:text-[#EDEDEC]">Inactive</span>
                        </label>
                    </div>
                    @error('is_active')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-[#1b1b18] dark:text-[#EDEDEC] dark:border-[#3E3E3A] hover:bg-gray-50 dark:hover:bg-gray-700">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-md transition duration-300">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection