<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationStatusMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
    $query = Application::query();

    if ($request->filled('search')) {
        $query->where('full_name', 'like', '%' . $request->search . '%')
              ->orWhere('school', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $applications = $query->latest()->paginate(5);

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

    Mail::to($application->user->email)->send(new ApplicationStatusMail($application));

    return redirect()->back()->with('success', 'Application status updated.');
    }
}