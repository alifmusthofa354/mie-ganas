@extends('layouts.dashboard')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-8">
        <h1 class="text-2xl font-bold mb-6 text-center text-[#1b1b18] dark:text-[#EDEDEC]">Login to Mie Ganas</h1>
        
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    class="w-full px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md shadow-sm focus:outline-none focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:text-[#EDEDEC]"
                    required
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md shadow-sm focus:outline-none focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:text-[#EDEDEC]"
                    required
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            @if($captcha)
            <div class="mb-6">
                <label for="captcha" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">
                    {{ $captcha['question'] }}
                </label>
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        {!! $captcha['image_html'] !!}
                    </div>
                    <input 
                        type="text" 
                        id="captcha" 
                        name="{{ $captcha['input_name'] }}" 
                        class="w-full px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md shadow-sm focus:outline-none focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:text-[#EDEDEC]"
                        required
                        autocomplete="off"
                        placeholder="Enter CAPTCHA text"
                    >
                </div>
                @error('captcha')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            @endif
            
            <div class="mb-4">
                <button 
                    type="submit" 
                    class="w-full bg-[#f53003] hover:bg-[#d92902] text-white py-2 px-4 rounded-md transition duration-300"
                >
                    Login
                </button>
            </div>
            
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                Demo credentials:<br>
                Admin: admin@mie-ganas.com / password<br>
                Cashier: cashier@mie-ganas.com / password<br>
                Waiter: waiter@mie-ganas.com / password<br>
                Chef: chef@mie-ganas.com / password
            </p>
        </div>
    </div>
</div>
@endsection