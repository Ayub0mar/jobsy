<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Application Success - Jobsy</title>
<style>
    /* Body & Fonts */
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
    }

    /* Navbar */
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
        cursor: default;
        color: white;
    }

    .navbar-custom .nav-links {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .navbar-custom form {
        margin: 0;
    }

    /* Buttons */
    .btn {
        background-color: #198754;
        border: none;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 450;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.2s ease;
        display: inline-block;
        text-decoration: none;
        user-select: none;
    }

    .btn:hover {
        background-color: #146c43;
        color: white;
        text-decoration: none;
    }

    /* Danger button style for logout */
    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 450;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.2s ease;
    }
    .btn-danger:hover {
        background-color: #b02a37;
        color: white;
    }

    /* Centered success message container */
    .success-message {
        text-align: center;
        margin-top: 50px;
        padding: 2rem 1rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        background-color: #fff;
        border-radius: 1rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .success-message h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .success-message p {
        font-size: 1.2rem;
        color: #555;
        margin-bottom: 2rem;
    }

    /* Button group spacing */
    .button-group > * {
        margin-right: 10px;
    }

    /* Remove margin on last button */
    .button-group > *:last-child {
        margin-right: 0;
    }
</style>
</head>
<body>

    <div class="navbar-custom">
        <h1>Jobsy</h1>
    </div>

    <div class="success-message">
        <h1>🎉 Congrats!</h1>
        <p>You applied successfully. You will receive an outcome in your email.</p>

        <div class="button-group">
            <button class="btn" onclick="window.location.href='{{ route('jobseeker.dashboard') }}'">Go Back to Jobs</button>

            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

</body>
</html>
