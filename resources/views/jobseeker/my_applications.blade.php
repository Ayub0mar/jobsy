<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Applications - Jobsy</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
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
            cursor: default;
            color: white;
        }

        .navbar-custom .nav-links {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .container {
            padding-left: 2rem;
            padding-right: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: 2rem;
        }

        h2.mb-4 {
            width: 100%;
            max-width: 1200px;
            margin-bottom: 1.5rem;

        }

        .navbar-custom form {
            margin: 0;
        }

        /* Application cards grid */
        .applications-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: center;
            margin-top: 1.5rem;
            width: 100%;
            max-width: 1200px;
        }

        .application-card {
            flex: 1 1 calc(33.333% - 1rem);
            min-width: 280px;
            max-width: 350px;
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            box-sizing: border-box;
            text-align: left;
        }

        .application-card h4 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
        }

        .application-meta {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .btn-view {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 0.3rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.2s ease;
        }

        .btn-view:hover {
            background-color: #0a58ca;
            color: white;
            text-decoration: none;
        }

        .no-applications {
            font-style: italic;
            color: #777;
            margin-top: 1rem;
        }
    </style>
</head>
<body>

    <div class="navbar-custom">
        <h1>Jobsy</h1>
        <div class="nav-links">
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>

            <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('jobseeker.dashboard') }}'">Back to Jobs</button>
        </div>
    </div>

    <div class="container">
        <h2 class="mb-4">My Applications</h2>

        @if ($applications->isEmpty())
            <p class="no-applications">You haven't applied to any jobs yet.</p>
        @else
            <div class="applications-grid">
                @foreach ($applications as $application)
                    <div class="application-card">
                        <h4>{{ $application->job->title }}</h4>
                        <div class="application-meta">
                            <span><strong>Company:</strong> {{ $application->job->company_name ?? 'N/A' }}</span>
                            <span><strong>Location:</strong> {{ $application->job->location }}</span>
                            <span><strong>Applied on:</strong> {{ $application->created_at->format('M d, Y') }}</span>
                            <span><strong>Status:</strong> {{ ucfirst($application->status) }}</span>
                        </div>
                        <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank" class="btn-view">View Resume</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>
