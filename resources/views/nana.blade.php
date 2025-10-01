<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Mie Ganas lala</title>
    <style></style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md px-8 py-10 mx-auto bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Welcome Back!</h1>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Sign in to continue</p>
            </div>
            <form action="{{ route('login') }}" method="POST" class="mt-8 space-y-6">
                @csrf
                <div class="relative">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" placeholder="your@email.com"
                        class="block w-full px-4 py-3 mt-2 text-gray-900 bg-gray-100 border-2 border-transparent rounded-lg dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="relative">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="block w-full px-4 py-3 mt-2 text-gray-900 bg-gray-100 border-2 border-transparent rounded-lg dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember_me" type="checkbox"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="remember_me" class="block ml-2 text-sm text-gray-900 dark:text-gray-300">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                            Forgot your password?
                        </a>
                    </div>
                </div>
                <div>
                    <button type="submit"
                        class="w-full px-4 py-3 mt-4 font-semibold text-white transition-colors duration-300 bg-blue-600 rounded-lg shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Sign In
                    </button>
                </div>
            </form>
            <p class="mt-8 text-sm text-center text-gray-600 dark:text-gray-400">
                Don't have an account? <a href="#" class="font-medium text-blue-600 hover:underline">Sign up</a>
            </p>
        </div>
    </div>
</body>

</html>
