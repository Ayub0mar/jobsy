<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Jobsy</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        /* Full-width black navbar */
        .navbar-custom {
            background-color: #000;
            padding: 1rem 2rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
            position: sticky;
            top: 0;
            left: 0;
            z-index: 999;
        }

        .navbar-custom h1 {
            margin: 0;
            font-weight: 500;
            font-size: 1.5rem;
            color: white;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-links button {
            background-color: #198754;
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.4rem;
            font-weight: 600;
            cursor: pointer;
        }

        .nav-links button:hover {
            background-color: #146c43;
        }

        .login-container {
            max-width: 400px;
            margin: 4rem auto;
            background: white;
            padding: 2rem 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #198754;
            font-weight: 700;
            font-size: 1.8rem;
        }

        label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
            color: #212529;
        }

        input[type="email"],
        input[type="password"] {
            border-radius: 0.5rem !important;
            border: 1px solid #ced4da !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 1rem !important;
            width: 100% !important;
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: #198754;
            border-color: #198754;
            font-weight: 600;
            border-radius: 0.5rem;
            padding: 0.6rem 1.25rem;
            font-size: 1rem;
            cursor: pointer;
            color: white;
            border: 1px solid transparent;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #146c43;
            border-color: #146c43;
        }

        .error-messages {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .mb-3 {
            margin-bottom: 2rem;
        }

        .mb-4 {
            margin-bottom: 2.5rem;
        }

        .action-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 1rem;
        }

        .register-link {
            font-size: 1rem;
            color: #6c757d;
            text-decoration: underline;
            cursor: pointer;
        }

        .register-link:hover {
            color: #198754;
        }
    </style>
</head>
<body>

    <!-- Navbar identical to dashboard -->
    <div class="navbar-custom">
        <h1>Jobsy</h1>
        <div class="nav-links">
            <button type="button" onclick="window.location.href='{{ url('/') }}'">Home</button>
        </div>
    </div>

    <!-- Login Form -->
    <div class="login-container">
        <h2 class="login-header">Log in</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email">{{ __('Email') }}</label>
                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    class="form-control"
                />
                <x-input-error :messages="$errors->get('email')" class="error-messages" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password">{{ __('Password') }}</label>
                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="form-control"
                />
                <x-input-error :messages="$errors->get('password')" class="error-messages" />
            </div>

            <!-- Buttons -->
            <div class="action-row">
                <x-primary-button class="btn btn-primary">
                    {{ __('Log in') }}
                </x-primary-button>

                <a href="{{ route('register') }}" class="register-link">
                    {{ __('Register') }}
                </a>
            </div>
        </form>
    </div>

</body>
</html>
