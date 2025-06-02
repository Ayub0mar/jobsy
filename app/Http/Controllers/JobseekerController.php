<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class JobseekerController extends Controller
{
    public function show(Job $job)
    {
        return view('jobseeker.apply', compact('job'));
    }

    public function apply(Request $request, Job $job)
    {
        try {
            $request->validate([
                'resume_url' => 'required|url|max:2048',
            ]);

            Application::create([
                'job_id' => $job->id,
                'jobseeker_id' => auth()->id(),
                'resume_url' => $request->input('resume_url'),
            ]);

            return redirect()->route('jobseeker.application.success');
        } catch (\Exception $e) {
            Log::error('Application submission failed: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function myApplications()
    {
        $applications = Application::with('job')
            ->where('jobseeker_id', auth()->id())
            ->latest()
            ->get();

        return view('jobseeker.my_applications', compact('applications'));
    }

    public function dashboard(Request $request)
    {
        $query = Job::query();

        if ($request->filled('title')) {
            $title = strtolower($request->title);
            $query->whereRaw('LOWER(title) LIKE ?', ["%{$title}%"]);
        }

        if ($request->filled('location')) {
            $location = strtolower($request->location);
            $query->whereRaw('LOWER(location) LIKE ?', ["%{$location}%"]);
        }

        if ($request->filled('company')) {
            $company = strtolower($request->company);
            $query->whereRaw('LOWER(company_name) LIKE ?', ["%{$company}%"]);
        }

        if ($request->filled('min_salary')) {
            $query->where('salary', '>=', $request->min_salary);
        }

        if ($request->filled('max_salary')) {
            $query->where('salary', '<=', $request->max_salary);
        }

        $jobs = $query->latest()->get();

        return view('jobseeker.dashboard', compact('jobs'));
    }



}
