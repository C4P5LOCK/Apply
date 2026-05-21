<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    //
    public function create()
    {
        return view('application.create');
    }

    public function store(Request $request)
    {
        $existingApplication = Application::where('user_id', auth()->id())->first();

        if ($existingApplication) {
        return redirect('/application/preview/' . $existingApplication->id);
    }

        $validated = $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'school' => 'required',
            'qualification' => 'required',
            'cgpa' => 'nullable',
        ]);

        $validated['user_id'] = auth()->id();

        $application = Application::create($validated);

        //return redirect()->route('application.preview', $application);
       return redirect()->route('application.preview', ['application' => $application->id]);
       // return redirect('/application/preview/' . $application->id);
    }

    public function preview(Application $application)
{
    if ($application->user_id !== auth()->id()) {
        abort(403);
    }

    return view('application.preview', compact('application'));
}

    public function submit(Application $application)
{
    if ($application->user_id !== auth()->id()) {
        abort(403);
    }

    $application->update([
        'status' => 'submitted',
        'submitted_at' => now(),
    ]);

    return redirect()->route('dashboard')->with('success', 'Application submitted successfully!');
}

public function edit(Application $application)
{
    if ($application->user_id !== auth()->id()) {
        abort(403);
    }

    if ($application->status === 'submitted') {
        return redirect()->back()->with('error', 'Submitted applications cannot be edited.');
    }

    return view('application.edit', compact('application'));
}

public function update(Request $request, Application $application)
{
    if ($application->user_id !== auth()->id()) {
        abort(403);
    }

    if ($application->status === 'submitted') {
        return redirect()->back()->with('error', 'Submitted applications cannot be edited.');
    }

    $validated = $request->validate([
        'full_name' => 'required',
        'phone' => 'required',
        'gender' => 'required',
        'dob' => 'required',
        'address' => 'required',
        'school' => 'required',
        'qualification' => 'required',
        'cgpa' => 'nullable',
    ]);

    $application->update($validated);

    return redirect()->route('application.preview', $application);
}
}
