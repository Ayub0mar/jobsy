<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Status - Jobsy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

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

        .navbar-custom .nav-links {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .container {
            max-width: 600px;
            margin-top: 40px;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .btn-primary {
            background-color: #0d6efd;
            font-weight: 500;
            border-radius: 0.4rem;
        }

        .btn-primary:hover {
            background-color: #084298;
        }

        .btn-secondary {
            margin-top: 1rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar-custom">
        <h1>Jobsy</h1>
        <div class="nav-links">
            <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('employer.dashboard') }}'">
                Dashboard
            </button>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="card p-4 mt-4">
            <h3 class="mb-3">Update Application Status</h3>

            <p><strong>Applicant:</strong> {{ $application->jobseeker->name }}</p>
            <p><strong>Job:</strong> {{ $application->job->title }}</p>
            <p><strong>Current Status:</strong> {{ $application->status ?? 'Pending' }}</p>

            <form method="POST" action="{{ route('applications.update', $application) }}">
                @csrf

                <div class="mb-3">
                    <label for="status" class="form-label">New Status</label>
                    <select name="status" class="form-select" required>
                        <option value="Pending" {{ $application->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Accepted" {{ $application->status === 'Accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="Rejected" {{ $application->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Status</button>
            </form>

            <a href="{{ route('jobs.applications', $application->job) }}" class="btn btn-secondary mt-3">← Back to Applicants</a>
        </div>
    </div>

</body>
</html>
