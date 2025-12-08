<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Inventaris App</title>

    <!-- TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            height: 100vh;
            overflow: hidden;
            margin: 0;
        }

        .login-card {
            background: white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .input-field {
            transition: all 0.2s ease;
            border: 1px solid #d1d5db;
        }

        .input-field:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .btn-login {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Hide scrollbar but allow scrolling */
        ::-webkit-scrollbar {
            display: none;
        }

        /* Smooth appearance */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>

<body class="h-screen flex items-center justify-center p-4 md:p-6">

    <!-- Main Container - Fixed Size -->
    <div class="login-card w-full max-w-sm md:max-w-md rounded-xl fade-in" style="max-height: 90vh;">

        <!-- Logo/Header Section -->
        <div class="px-6 pt-8 pb-4">
            <div class="flex flex-col items-center">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mb-3">
                    <i class="ri-box-3-line text-white text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold gradient-text text-center">
                    Inventaris App
                </h1>
                <p class="text-gray-500 text-sm mt-1 text-center">Login untuk melanjutkan</p>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="mx-6 mb-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-center gap-2">
                    <i class="ri-checkbox-circle-fill text-green-500"></i>
                    <p class="text-green-700 text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mx-6 mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center gap-2">
                    <i class="ri-error-warning-fill text-red-500"></i>
                    <p class="text-red-700 text-sm">{{ $errors->first() }}</p>
                </div>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login.post') }}" method="POST" class="px-6 pb-6 space-y-4">
            @csrf

            <!-- Username Field -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Username
                </label>
                <div class="relative">
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username"
                        class="w-full px-4 py-2.5 pl-10 input-field rounded-lg focus:outline-none" required autofocus>
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="ri-user-line"></i>
                    </div>
                </div>
            </div>

            <!-- Password Field -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <div class="relative">
                    <input type="password" name="password" placeholder="Masukkan password"
                        class="w-full px-4 py-2.5 pl-10 pr-10 input-field rounded-lg focus:outline-none" required>
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="ri-lock-line"></i>
                    </div>
                    <button type="button" onclick="togglePassword(this)"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <i class="ri-eye-line"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember"
                    class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya</label>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login w-full py-2.5 text-white font-medium rounded-lg">
                Masuk
            </button>
        </form>

        <!-- Footer -->
        <div class="px-6 pb-6 pt-4 border-t border-gray-100">
            <p class="text-center text-xs text-gray-500">
                &copy; {{ date('Y') }} Inventaris App • v1.0.0
            </p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(button) {
            const passwordInput = button.parentElement.querySelector('input[name="password"]');
            const icon = button.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('ri-eye-line');
                icon.classList.add('ri-eye-off-line');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('ri-eye-off-line');
                icon.classList.add('ri-eye-line');
            }
        }

        // Prevent form resubmission
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        // Auto-focus username field
        document.addEventListener('DOMContentLoaded', function() {
            const usernameField = document.querySelector('input[name="username"]');
            if (usernameField) {
                usernameField.focus();
            }
        });
    </script>
</body>

</html>
