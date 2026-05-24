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
            'passport' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('passport')) {
             $validated['passport'] = $request->file('passport')->store('passports', 'public');
        }

        $application = Application::create($validated);

        $application->application_number = 'APP-' . date('Y') . '-' . str_pad($application->id, 4, '0', STR_PAD_LEFT);

        $application->save();
        
        return redirect()->route('application.preview', ['application' => $application->id]);
       
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
        'passport' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    if ($request->hasFile('passport')) {
     $validated['passport'] = $request->file('passport')->store('passports', 'public');
        }
    $application->update($validated);

    return redirect()->route('application.preview', $application);
}
}
