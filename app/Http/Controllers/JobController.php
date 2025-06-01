<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job; // We'll create this model next
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // Show form to create a job
    public function create()
    {
        return view('jobs.create');
    }

    // Store the job in DB
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
        ]);

        Job::create([
            'title' => $request->title,
            'company_name' => $request->company_name,
            'description' => $request->description,
            'location' => $request->location,
            'requirements' => $request->requirements,
            'salary' => $request->salary,
            'employer_id' => Auth::id(),
        ]);

        return redirect()->route('employer.dashboard')->with('success', 'Job posted successfully.');
    }

    // Show form to edit a job
    public function edit(Job $job)
    {
        // Authorization: only the employer who owns this job can edit
        if ($job->employer_id !== Auth::id()) {
            abort(403);
        }

        return view('jobs.edit', compact('job'));
    }

    // Update job in DB
    public function update(Request $request, Job $job)
    {
        if ($job->employer_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'requirements' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
        ]);

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'salary' => $request->salary,
            'requirements' => $request->requirements,  // fix is here
            'company_name' => $request->company_name,
        ]);

        return redirect()->route('employer.dashboard')->with('success', 'Job updated successfully.');
    }

    // Delete job from DB
    public function destroy(Job $job)
    {
        if ($job->employer_id !== Auth::id()) {
            abort(403);
        }

        $job->delete();

        return redirect()->route('employer.dashboard')->with('success', 'Job deleted successfully.');
    }
}
