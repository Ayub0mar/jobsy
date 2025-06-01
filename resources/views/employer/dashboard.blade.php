<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Employer Dashboard - Jobsy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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
            position: sticky;
            top: 0;
            left: 0;
            z-index: 999;
        }

        .navbar-custom h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 500;
        }

        .navbar-custom .nav-links {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .container {
            padding: 2rem;
        }

        .welcome-msg {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .btn-create {
            background-color: #198754;
            color: white;
            border: none;
            border-radius: 0.4rem;
            padding: 0.5rem 1rem;
            font-weight: 600;
            margin-bottom: 2rem;
        }

        .btn-create:hover {
            background-color: #146c43;
        }

        .job-card {
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .job-card h4 {
            font-weight: 700;
        }

        .job-meta {
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .job-actions {
            margin-top: 1rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-outline-success, .btn-outline-danger {
            font-weight: 600;
        }

        .success-message {
            color: green;
            font-weight: 500;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <div class="navbar-custom">
        <h1>Jobsy</h1>
        <div class="nav-links">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">

        <p class="welcome-msg">Welcome, {{ auth()->user()->name }}!</p>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <button class="btn-create" onclick="window.location.href='{{ route('jobs.create') }}'">+ Create Job</button>

        <h2>Your Job Listings</h2>

        @if ($jobs->isEmpty())
            <p>You have not posted any jobs yet.</p>
        @else
            @foreach ($jobs as $job)
                <div class="job-card">
                    <h4>{{ $job->title }}</h4>
                    <div class="job-meta">
                        <span><strong>Company:</strong> {{ $job->company_name ?? 'N/A' }}</span>
                        <span><strong>Location:</strong> {{ $job->location }}</span>
                        <span><strong>Salary:</strong> {{ $job->salary ? '$' . number_format($job->salary) : 'Not specified' }}</span>
                        <span><strong>Posted on:</strong> {{ $job->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="job-actions">
                        <a href="{{ route('jobs.applications', $job) }}" class="btn btn-outline-primary">View Applicants</a>
                        <a href="{{ route('jobs.edit', $job) }}" class="btn btn-outline-success">Edit</a>

                        <form action="{{ route('jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif

    </div>

</body>
</html>
