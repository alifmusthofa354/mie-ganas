@extends('layouts.admin')

@section('title', $menu->name)

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Menu Details</h1>
            <a href="{{ route('admin.menus.index') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition duration-300">
                Back to Menu
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                @if($menu->image)
                    <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="w-full h-64 object-cover rounded-md">
                @else
                    <div class="bg-gray-200 border-2 border-dashed rounded-md w-full h-64 flex items-center justify-center text-gray-500">
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
                    <p class="text-lg font-bold text-[#f53003] dark:text-[#FF4433]">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                </div>
                
                <div class="mb-4">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                        {{ $menu->status === 'active' ? 'bg-green-500' : 'bg-yellow-500' }} 
                        text-white shadow-md">
                        {{ ucfirst($menu->status) }}
                    </span>
                </div>
                
                @if($menu->category)
                    <div class="mb-4">
                        <p class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]">
                            <span class="font-medium">Category:</span> {{ $menu->category->name }}
                        </p>
                    </div>
                @endif
                
                <div class="flex space-x-3 mt-6">
                    <a 
                        href="{{ route('admin.menus.edit', $menu) }}" 
                        class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300"
                    >
                        Edit
                    </a>
                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-300"
                            onclick="return confirm('Are you sure you want to delete this menu item?')"
                        >
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection