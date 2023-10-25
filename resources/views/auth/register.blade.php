<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <a href="/">
                <img src="/path/to/your/application/logo.png" alt="Logo" class="w-20 h-20">
            </a>
        </div>
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name"
                        class="block font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                    <input id="name"
                        class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 focus:border-indigo-300 dark:focus:border-indigo-500 dark:bg-gray-900 text-gray-900 dark:text-gray-200"
                        type="text" name="name" value="{{ old('name') }}" required autofocus>
                    <?php
                    $nameErrors = $errors->get('name');
                    if ($nameErrors) {
                        echo '<div class="text-red-600 text-sm mt-2">' . $nameErrors[0] . '</div>';
                    }
                    ?>
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <label for="email"
                        class="block font-medium text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
                    <input id="email"
                        class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 focus:border-indigo-300 dark:focus:border-indigo-500 dark:bg-gray-900 text-gray-900 dark:text-gray-200"
                        type="email" name="email" value="{{ old('email') }}" required>
                    <?php
                    $emailErrors = $errors->get('email');
                    if ($emailErrors) {
                        echo '<div class="text-red-600 text-sm mt-2">' . $emailErrors[0] . '</div>';
                    }
                    ?>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password"
                        class="block font-medium text-gray-700 dark:text-gray-300">{{ __('Password') }}</label>
                    <input id="password"
                        class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 focus:border-indigo-300 dark:focus:border-indigo-500 dark:bg-gray-900 text-gray-900 dark:text-gray-200"
                        type="password" name="password" required>
                    <?php
                    $passwordErrors = $errors->get('password');
                    if ($passwordErrors) {
                        echo '<div class="text-red-600 text-sm mt-2">' . $passwordErrors[0] . '</div>';
                    }
                    ?>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation"
                        class="block font-medium text-gray-700 dark:text-gray-300">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation"
                        class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 focus:border-indigo-300 dark:focus:border-indigo-500 dark:bg-gray-900 text-gray-900 dark:text-gray-200"
                        type="password" name="password_confirmation" required>
                    <?php
                    $passwordConfirmationErrors = $errors->get('password_confirmation');
                    if ($passwordConfirmationErrors) {
                        echo '<div class="text-red-600 text-sm mt-2">' . $passwordConfirmationErrors[0] . '</div>';
                    }
                    ?>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit"
                        class="ml-4 py-2 px-4 bg-indigo-500 hover:bg-indigo-700 text-white font-semibold rounded-md">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
