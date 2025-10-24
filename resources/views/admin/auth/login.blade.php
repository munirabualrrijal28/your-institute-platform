<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    @vite('resources/css/app.css') {{-- Adjust if you're not using Vite --}}
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-sm animate-fade-in-down">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Admin Login</h2>
            <p class="text-sm text-gray-500">Sign in to your admin dashboard</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 text-sm p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
            @csrf

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700">Username</label>
                <input type="text" name="username" id="username" required
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none" />
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300">
                    Login
                </button>
            </div>
        </form>
    </div>

    <style>
        @keyframes fade-in-down {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.5s ease-out;
        }
    </style>

</body>
</html>
