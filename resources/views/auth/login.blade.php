@extends('layouts.guest')
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <div class="mb-4">
        <!-- Session Status -->
        <?php
        $status = session('status');
        if ($status) {
            echo '<div class="alert alert-success">' . $status . '</div>';
        }
        ?>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email">{{ __('Email') }}</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}"
                required autofocus autocomplete="username">
            <?php
            $emailErrors = $errors->get('email');
            if ($emailErrors) {
                echo '<div class="text-danger mt-2">' . $emailErrors[0] . '</div>';
            }
            ?>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password">
            <?php
            $passwordErrors = $errors->get('password');
            if ($passwordErrors) {
                echo '<div class="text-danger mt-2">' . $passwordErrors[0] . '</div>';
            }
            ?>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <?php
            if (Route::has('password.request')) {
                echo '<a href="' . route('password.request') . '">' . __('Forgot your password?') . '</a>';
            }
            ?>

            <button class="ml-3" type="submit">{{ __('Log in') }}</button>
        </div>
    </form>
</body>

</html>
