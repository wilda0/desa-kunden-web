<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('/public/images/logo-kunden.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-2xl p-6 sm:p-8">

        {{-- Logo --}}
        <div class="flex justify-center mb-6">
            <a href="/">
                <img src="{{ asset('public/images/logo-kunden.png') }}" alt="Logo Desa Kunden" class="h-20 w-auto">
            </a>
        </div>

        <h2 class="text-center text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2">Login Admin</h2>
        <p class="text-center text-sm text-gray-600 dark:text-gray-400 mb-6">Selamat datang, silakan masuk ke akun Anda.</p>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="mb-4">
                <div class="font-medium text-red-600 dark:text-red-400">{{ __('Whoops! Something went wrong.') }}</div>
                <ul class="mt-2 list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Status Message --}}
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring focus:ring-indigo-500 focus:border-indigo-500 transition" />
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring focus:ring-indigo-500 focus:border-indigo-500 transition" />
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 rounded focus:ring-indigo-500 dark:bg-gray-900">
                <label for="remember_me" class="ml-2 block text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Remember me') }}
                </label>
            </div>

            {{-- Button and Optional Links --}}
            <div class="flex justify-center mt-6">
                {{-- <!--@if (Route::has('register'))-->
                <!--    <a href="{{ route('register') }}"-->
                <!--        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">-->
                <!--        {{ __('Register') }}-->
                <!--    </a>-->
                <!--@endif--> --}}


                {{-- <!--@if (Route::has('password.request'))-->
                <!--        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">-->
                <!--            {{ __('Forgot your password?') }}-->
                <!--        </a>-->
                <!--@endif--> --}}

                <button type="submit"
                    class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</body>

</html>
