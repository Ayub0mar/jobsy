<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Jobsy Dashboard</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        /* Navbar full width and styling */
        .navbar-custom {
            background-color: #000;
            padding: 1rem 2rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;            /* Use 100% instead of 100vw */
            box-sizing: border-box; /* Include padding in width */
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

        /* Add some horizontal padding so content inside container isn't flush to edges */
        .container {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .filter-form {
            margin-bottom: 1.5rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-form input {
            border-radius: 0.3rem;
            border: 1px solid #ced4da;
            padding: 0.4rem 0.6rem;
            font-size: 0.9rem;
            width: 150px;
        }

        .filter-form button.btn-filter {
            background-color: #000;
            color: #fff;
            border-radius: 0.3rem;
            padding: 0.4rem 1rem;
            border: none;
            font-weight: 450;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .filter-form button.btn-filter:hover {
            background-color: #333;
        }

        .btn-reset {
            background-color: #e2e6ea;
            color: #000;
            border-radius: 0.3rem;
            padding: 0.4rem 1rem;
            border: none;
            font-weight: 450;
            cursor: pointer;
            margin-left: 0.5rem;
            transition: background-color 0.2s ease;
        }

        .btn-reset:hover {
            background-color: #d6d8db;
        }

        .job-card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .job-card h4 {
            font-weight: 700;
            font-size: 1.4rem;
        }

        .job-meta {
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: flex;
            gap: 1.0rem;
            flex-wrap: wrap;
        }

        .btn-apply {
            background-color: #198754;
            border: none;
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-apply:hover {
            background-color: #146c43;
            color: white;
            text-decoration: none;
        }

        .welcome-msg {
            margin: 1rem 0 2rem;
            font-size: 1.6rem;
            font-weight: 600;
            color: #000;
        }
    </style>
</head>
<body>

    <div class="navbar-custom">
        <h1>Jobsy</h1>
        <div class="nav-links">
            <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('jobseeker.applications') }}'">
                My Applications
            </button>

            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    <div class="container py-4">

        <p class="welcome-msg">Welcome, {{ auth()->user()->name }}</p>

        <form method="GET" action="{{ route('jobseeker.dashboard') }}" class="filter-form">
            <input type="text" name="title" placeholder="Job title" value="{{ request('title') }}">
            <input type="text" name="location" placeholder="Location" value="{{ request('location') }}">
            <input type="text" name="company" placeholder="Company" value="{{ request('company') }}">
            <input type="number" name="min_salary" placeholder="Min Salary" value="{{ request('min_salary') }}" step="any" min="0">
            <input type="number" name="max_salary" placeholder="Max Salary" value="{{ request('max_salary') }}" step="any" min="0">
            <button type="submit" class="btn-filter">Filter</button>
            <button type="button" class="btn-reset" onclick="window.location.href='{{ route('jobseeker.dashboard') }}'">Reset</button>
        </form>

        <h2 class="mb-4">Available Jobs</h2>

        @if ($jobs->isEmpty())
            <p>No jobs available at the moment.</p>
        @else
            @foreach ($jobs as $job)
                <div class="job-card">
                    <h4>{{ $job->title }}</h4>
                    <div class="job-meta">
                        <span><strong>Company:</strong> {{ $job->company_name ?? 'N/A' }}</span>
                        <span><strong>Location:</strong> {{ $job->location }}</span>
                        <span><strong>Salary:</strong> {{ $job->salary ? '$' . number_format($job->salary) : 'Not specified' }}</span>
                    </div>
                    <p>{{ $job->description }}</p>
                    <a href="{{ route('jobseeker.jobs.show', $job) }}" class="btn-apply">View & Apply</a>
                </div>
            @endforeach
        @endif

    </div>

</body>
</html>
