<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    //
    public function create()
    {
        return view('application.create');
    }

    public function store(Request $request)
    {
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

        Application::create($validated);

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
}
