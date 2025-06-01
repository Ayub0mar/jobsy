<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - Jobsy</title>

    <!-- Bootstrap CDN for layout -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        /* Navbar to match dashboard */
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

        .register-container {
            max-width: 400px;
            margin: 4rem auto;
            background: white;
            padding: 2.5rem 3rem;
            border-radius: 1rem;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        .register-header {
            text-align: center;
            margin-bottom: 2rem;
            color: #198754;
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: 0.03em;
        }

        label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
            color: #212529;
        }

        select,
        input[type="text"],
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
            padding: 0.65rem 1.5rem;
            font-size: 1rem;
            min-width: 100px;
            color: white;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #146c43;
            border-color: #146c43;
            box-shadow: 0 0 8px rgba(20, 108, 67, 0.6);
        }

        .error-messages {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .mt-4 {
            margin-top: 1rem !important;
        }

        .flex {
            display: flex !important;
        }

        .items-center {
            align-items: center !important;
        }

        .justify-end {
            justify-content: flex-end !important;
        }

        .ms-4 {
            margin-left: 1rem !important;
        }

        a.underline {
            text-decoration: underline;
            font-size: 0.875rem;
            color: #6c757d;
            transition: color 0.3s ease;
        }

        a.underline:hover {
            color: #198754;
        }

        .mb-3 {
            margin-bottom: 2rem !important;
        }

        .mb-4 {
            margin-bottom: 2.5rem !important;
        }
    </style>
</head>
<body>

    <!-- Matching Navbar -->
    <div class="navbar-custom">
        <h1>Jobsy</h1>
        <div class="nav-links">
            <button type="button" onclick="window.location.href='{{ url('/') }}'">Home</button>
        </div>
    </div>

    <div class="register-container">
        <h2 class="register-header">Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name">{{ __('Name') }}</label>
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="form-control" />
                <x-input-error :messages="$errors->get('name')" class="error-messages" />
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email">{{ __('Email') }}</label>
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" class="form-control" />
                <x-input-error :messages="$errors->get('email')" class="error-messages" />
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label for="role">{{ __('Register as:') }}</label>
                <select name="role" id="role" required class="form-select">
                    <option value="">-- Select Role --</option>
                    <option value="jobseeker" {{ old('role') == 'jobseeker' ? 'selected' : '' }}>Jobseeker</option>
                    <option value="employer" {{ old('role') == 'employer' ? 'selected' : '' }}>Employer</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="error-messages" />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password">{{ __('Password') }}</label>
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" class="form-control" />
                <x-input-error :messages="$errors->get('password')" class="error-messages" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="error-messages" />
            </div>

            <div class="flex items-center justify-end">
                <a href="{{ route('login') }}" class="underline">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="btn btn-primary ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</body>
</html>
