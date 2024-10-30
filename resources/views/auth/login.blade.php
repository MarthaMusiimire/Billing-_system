<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: #f0f4f8;
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center">

    <div class="w-full max-w-5xl flex bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Left Section (Background and Features) -->
        <div class="w-3/5 p-20 bg-gradient-to-r from-green-700 to-blue-500 text-white flex flex-col items-center"><br><br><br>
            
            <h1 class="text-4xl font-bold mb-10">Stre@mline Billing System</h1>
            <ul class="space-y-6 text-lg">
                <li class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2a4 4 0 004 4h2a4 4 0 004-4zM17 8a4 4 0 11-8 0 4 4 0 018 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 12h1a2 2 0 012 2v2m-4 0v6a2 2 0 002 2h6a2 2 0 002-2v-6a2 2 0 00-2-2h-1" />
                    </svg>
                    Billing
                </li>
                
                <li class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6m9-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Invoices
                </li>
                
                <li class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6m9-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Generate Reports
                </li>
            </ul>
        </div>

        <!-- Right Section (Login Form) -->
        <div class="w-2/5 p-10 bg-gray-50 flex flex-col justify-center items-center relative">
            <!-- Center the logo above the login form -->
            <img src="{{ asset('images/streamline logo.png') }}" alt="Company Logo" class="h-20 w-auto mb-5">

            <!-- Login Form -->
            <h2 class="text-3xl font-bold text-center text-green-800 mb-6">Login</h2>
            <form method="POST" action="{{ route('login') }}" class="w-full max-w-xs">
                @csrf
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm text-gray-600 mb-2">Email</label>
                    <input id="email" type="email" name="email" class="w-full border border-gray-300 p-3 rounded" placeholder="Email" required>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm text-gray-600 mb-2">Password</label>
                    <input id="password" type="password" name="password" class="w-full border border-gray-300 p-3 rounded" placeholder="Password" required>
                </div>

                <!-- Save User -->
                <div class="flex items-center mb-6">
                    <input id="save_user" type="checkbox" class="mr-2" name="save_user">
                    <label for="save_user" class="text-sm text-gray-600">Remember Me</label>
                </div>

                <!-- Login Button -->
                <div>
                    <button class="w-full bg-green-600 text-white p-3 rounded-full font-bold hover:bg-green-800 transition duration-300">Login</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
