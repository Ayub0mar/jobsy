<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobsy - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        header {
            background-color: #000;
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            font-size: 1.5rem;
            margin: 0;
            font-weight: 500;
        }
        header .nav-buttons button {
            margin-left: 0.5rem;
        }
        .hero {
            background-color: #000;
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }
        .hero h2 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.2rem;
            color: #ccc;
        }
        .jobs-section {
            padding: 3rem 2rem;
        }
        .job-card {
            background-color: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }
        .job-card h4 {
            margin: 0 0 0.25rem 0;
        }
        .job-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.9rem;
            color: #555;
            flex-wrap: wrap;
        }
        .view-all {
            text-align: right;
            margin-top: -2rem;
            margin-bottom: 2rem;
        }
        .view-all a {
            text-decoration: none;
            color: #198754;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <header>
        <h1>Jobsy</h1>
        <div class="nav-buttons">
            <button class="btn btn-success" onclick="location.href='{{ route('login') }}'">Login</button>
            <button class="btn btn-success" onclick="location.href='{{ route('register') }}'">Register</button>
        </div>
    </header>

    <section class="hero">
        <h2>Find Your Dream Job Today!</h2>
        <p>Connecting Talent with Opportunity: Your Gateway to Career Success</p>
    </section>

    <section class="jobs-section container">
    <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Recent Jobs Available</h3>
        </div>

        @foreach ($recentJobs as $job)
            <div class="job-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-success">{{ $job->created_at->diffForHumans() }}</small>
                        <h4>{{ $job->title }}</h4>
                        <p class="text-muted mb-1">{{ $job->company_name ?? 'N/A' }}</p>
                        <div class="job-meta">
                            <span>
                                {{ $job->salary ? '$' . number_format($job->salary) : 'Not specified' }}
                            </span>
                            <span>{{ $job->location }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
