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
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <?php
            $status = session('status');
            if ($status) {
                echo '<div class="mb-4">' . $status . '</div>';
            }
            ?>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" class="block mt-1 w-full" type="email" name="email"
                        value="{{ old('email') }}" required autofocus>
                    <?php
                    $emailErrors = $errors->get('email');
                    if ($emailErrors) {
                        echo '<div class="text-danger mt-2">' . $emailErrors[0] . '</div>';
                    }
                    ?>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit"
                        class="bg-indigo-500 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
