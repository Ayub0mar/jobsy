<?php

namespace App\Http\Controllers;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\Job;


class EmployerController extends Controller
{

    public function editApplication(Application $application)
    {
        // Only allow editing if employer owns the job
        if ($application->job->employer_id !== auth()->id()) {
            abort(403);
        }

        return view('employer.edit_application', compact('application'));
    }

    public function updateApplication(Request $request, Application $application)
    {
        // Optional: Check ownership
        if ($application->job->employer_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Pending,Accepted,Rejected',
        ]);

        $application->update([
            'status' => $request->status,
        ]);

        return redirect()->route('jobs.applications', $application->job)
                        ->with('success', 'Application status updated.');
    }


    public function showApplications(Job $job)
    {
        // Make sure this job belongs to the logged-in employer
        if ($job->employer_id !== auth()->id()) {
            abort(403);
        }

        $applications = $job->applications()->with('jobseeker')->get();

        return view('employer.applications', compact('job', 'applications'));
    }

}
