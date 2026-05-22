<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $applications = Application::latest()->get();

        return view('admin.dashboard', compact('applications'));
    }

    public function show(Application $application)
    {
        return view('admin.show', compact('application'));
    }

    public function updateStatus(Request $request, Application $application)
    {
    $request->validate([
        'status' => 'required'
    ]);

    $application->update([
        'status' => $request->status
    ]);

    return redirect()->back()->with('success', 'Application status updated.');
    }
}