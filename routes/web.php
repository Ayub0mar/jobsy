<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $recentJobs = Job::latest()->take(5)->get();
    return view('welcome', compact('recentJobs'));
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'employer') {
        return redirect()->route('employer.dashboard');
    } else {
        return redirect()->route('jobseeker.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/employer/dashboard', function () {
        return view('employer.dashboard');
    })->name('employer.dashboard');

    Route::get('/jobseeker/dashboard', function () {
        return view('jobseeker.dashboard');
    })->name('jobseeker.dashboard');
});

Route::middleware(['auth'])->group(function () {
    // Employer dashboard
    Route::get('/employer/dashboard', function () {
        $jobs = Job::where('employer_id', Auth::id())->latest()->get();
        return view('employer.dashboard', compact('jobs'));
    })->name('employer.dashboard');

    // Job creation form
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');

    // Job store route (POST)
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');

    // Edit job form
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');

    // Update job (PUT)
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');

    // Delete job (DELETE)
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/jobseeker/dashboard', function () {
        $jobs = \App\Models\Job::latest()->get();
        return view('jobseeker.dashboard', compact('jobs'));
    })->name('jobseeker.dashboard');
});

use App\Http\Controllers\JobseekerController;

Route::middleware(['auth'])->group(function () {
    Route::get('/jobseeker/jobs/{job}', [JobseekerController::class, 'show'])->name('jobseeker.jobs.show');
    Route::post('/jobseeker/jobs/{job}/apply', [JobseekerController::class, 'apply'])->name('jobseeker.jobs.apply');
});

Route::get('/jobseeker/application-success', function () {
    return view('jobseeker.application_success');
})->name('jobseeker.application.success');

Route::middleware(['auth'])->group(function () {
    Route::get('/jobseeker/applications', [JobseekerController::class, 'myApplications'])->name('jobseeker.applications');
});

use App\Http\Controllers\EmployerController;

Route::middleware(['auth'])->group(function () {
    Route::get('/applications/{application}/edit', [EmployerController::class, 'editApplication'])->name('applications.edit');
    Route::post('/applications/{application}/update', [EmployerController::class, 'updateApplication'])->name('applications.update');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/employer/jobs/{job}/applications', [EmployerController::class, 'showApplications'])->name('jobs.applications');
});

Route::get('/jobseeker/dashboard', [JobseekerController::class, 'dashboard'])->name('jobseeker.dashboard');



require __DIR__.'/auth.php';
