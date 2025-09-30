<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lele Form baru</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-indigo-50 to-purple-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header with gradient -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 text-center">
                <h1 class="text-3xl font-bold text-white mb-2">Lele Form</h1>
                <p class="text-indigo-200">Fill out the details below</p>
            </div>

            <!-- Form -->
            <form class="p-6">
                <div class="mb-5">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" id="name"
                            class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                            placeholder="Enter your name">
                    </div>
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email"
                            class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                            placeholder="Enter your email">
                    </div>
                </div>

                <div class="mb-5">
                    <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-phone text-gray-400"></i>
                        </div>
                        <input type="tel" id="phone"
                            class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                            placeholder="Enter your phone number">
                    </div>
                </div>

                <div class="mb-5">
                    <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                    <textarea id="message" rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                        placeholder="Type your message here..."></textarea>
                </div>

                <div class="flex items-center mb-5">
                    <input type="checkbox" id="terms"
                        class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2">
                    <label for="terms" class="ml-2 text-sm text-gray-700">
                        I agree to the <a href="#" class="text-indigo-600 hover:underline">terms and
                            conditions</a>
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl">
                    Submit Form
                </button>
            </form>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 text-center">
                <p class="text-gray-600 text-sm">We care about your data. Read our <a href="#"
                        class="text-indigo-600 hover:underline">Privacy Policy</a></p>
            </div>
        </div>

        <div class="mt-6 text-center">
            <p class="text-gray-600">Need help? <a href="#" class="text-indigo-600 hover:underline">Contact
                    Support</a></p>
        </div>
    </div>
</body>

</html>
