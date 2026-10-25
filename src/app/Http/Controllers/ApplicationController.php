<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function store(Request $request, Job $job): RedirectResponse
    {
        $exisitingApplication = Application::where('job_id', $job->id)->where('user_id', auth()->id())->exists();

        if ($exisitingApplication) {
            return redirect()->back()->with('error', 'Application with this user id allready exists already exists.');
        }

        $validated = $request->validate([
            'full_name' => 'required|string',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'required|string|email',
            'message' => 'nullable|string',
            'location' => 'nullable|string',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        if($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resume', 'public');
            $validated['resume_path'] = $path;
        }

        $application = new Application($validated);
        $application->job_id = $job->id;
        $application->user_id = auth()->id();
        $application->save();

        return redirect()->back()->with('success', 'Your application has been submitted.');
    }

    public function destroy(Application $application): RedirectResponse
    {
        if ($application->resume_path)
        {
            Storage::delete('public/' . $application->resume_path);
        }

        $application->delete();

        return redirect()->route('dashboard')->with('success', 'Application has been deleted.');
    }
}
