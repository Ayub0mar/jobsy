<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Jobsy - Apply for Job</title>
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
    .navbar-custom form {
        margin: 0;
    }

    /* Container and Section Styling */
    .container {
        padding: 0 2rem;
        margin: 2rem auto;
        max-width: 900px;
        box-sizing: border-box;
    }

    /* Job Detail Card */
    .job-card {
        background-color: #fff;
        border-radius: 1rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    /* Job Title */
    .job-card h2, .job-card h3 {
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    /* Meta Info (Company, Location, etc.) */
    .job-meta {
        color: #555;
        font-size: 0.95rem;
        margin-bottom: 1rem;
        display: flex;
        flex-wrap: wrap;
        gap: 1.25rem;
    }

    /* Resume Upload Field */
    input[type="file"] {
        padding: 0.5rem;
        border: 1px solid #ced4da;
        border-radius: 0.3rem;
        font-size: 0.9rem;
        background-color: #fff;
        width: 100%;
        max-width: 400px;
        cursor: pointer;
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
        <div class="job-card">
            <h2>Apply for: {{ $job->title }}</h2>

            <div class="job-meta mb-3">
                <span><strong>Company:</strong> {{ $job->company_name ?? 'N/A' }}</span>
                <span><strong>Location:</strong> {{ $job->location }}</span>
                <span><strong>Salary:</strong> {{ $job->salary ? '$' . number_format($job->salary) : 'Not specified' }}</span>
            </div>

            <p><strong>Description:</strong></p>
            <p>{{ $job->description }}</p>

            <p><strong>Requirements:</strong></p>
            @if ($job->requirements)
                <ul>
                    @foreach (explode("\n", $job->requirements) as $requirement)
                        <li>{{ trim($requirement) }}</li>
                    @endforeach
                </ul>
            @else
                <p>None specified.</p>
            @endif
        </div>

        <div class="job-card">
            <h3>Submit Your Application</h3>
            <form action="{{ route('jobseeker.jobs.apply', $job) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom: 1rem;">
                    <label for="resume"><strong>Upload Resume (PDF, DOC, DOCX):</strong></label><br>
                    <input type="file" name="resume" required style="margin-top: 0.5rem;">
                </div>

                <button type="submit" class="btn btn-success">Submit Application</button>
                <button type="button" onclick="window.location.href='{{ route('jobseeker.dashboard') }}'" class="btn btn-success" style="margin-left: 0.5rem;">
                    Go Back to Jobs
                </button>
            </form>
        </div>
    </div>
</body>
</html>
