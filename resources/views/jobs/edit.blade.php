<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Job - Jobsy</title>
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

        /* Logout button changed to green */
        .btn-logout {
            background-color: #198754;
            border: none;
            color: white;
            font-weight: 600;
        }
        .btn-logout:hover {
            background-color: #146c43;
        }

        .container {
            max-width: 700px;
            margin-top: 40px;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        /* Align the form buttons side by side */
        .form-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .btn-secondary {
            flex-shrink: 0;
        }

        .form-label {
            font-weight: 600;
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
            <h2 class="mb-4">Edit Job</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jobs.update', $job) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Job Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $job->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name', $job->company_name) }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Job Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description', $job->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $job->location) }}" required>
                </div>

                <div class="mb-3">
                    <label for="requirements" class="form-label">Requirements</label>
                    <textarea name="requirements" class="form-control" rows="5">{{ old('requirements', $job->requirements) }}</textarea>
                    <small class="text-muted">Enter one requirement per line.</small>
                </div>

                <div class="mb-3">
                    <label for="salary" class="form-label">Salary (optional)</label>
                    <input type="number" step="0.01" id="salary" name="salary" class="form-control" value="{{ old('salary', $job->salary) }}">
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary">Update Job</button>
                    <a href="{{ route('employer.dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
