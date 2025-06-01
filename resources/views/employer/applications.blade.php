<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Applicants - Jobsy</title>
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
        }

        .navbar-custom h1 {
            font-size: 1.5rem;
            margin: 0;
        }

        .container {
            padding: 2rem;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .btn-update {
            background-color: #0d6efd;
            color: white;
            font-weight: 500;
        }

        .btn-update:hover {
            background-color: #084298;
        }
    </style>
</head>
<body>

    <div class="navbar-custom">
        <h1>Jobsy</h1>
        <div>
            <a href="{{ route('employer.dashboard') }}" class="btn btn-success me-2">
                Dashboard
            </a>

            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        <h2 class="mb-4">Applicants for: {{ $job->title }}</h2>

        @if ($applications->isEmpty())
            <div class="alert alert-info">No applications for this job yet.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Applicant Name</th>
                            <th>Resume</th>
                            <th>Applied On</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <tr>
                                <td>{{ $application->jobseeker->name }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                        View Resume
                                    </a>
                                </td>
                                <td>{{ $application->created_at->format('M d, Y') }}</td>
                                <td>{{ $application->status ?? 'Pending' }}</td>
                                <td>
                                    <a href="{{ route('applications.edit', $application) }}" class="btn btn-update btn-sm">Update Status</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</body>
</html>
