<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationStatusMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Exports\ApplicationsExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
    $query = Application::query();

    if ($request->filled('search')) {
        $query->where('full_name', 'like', '%' . $request->search . '%')
              ->orWhere('school', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('progress')) {
        $query->where('progress', $request->progress);
    }

    $totalApplications = Application::count();

    $submittedApplications = Application::where('status', 'submitted')->count();

    $underReviewApplications = Application::where('progress', 'pending')->count();

    $approvedApplications = Application::where('progress', 'approved')->count();

    $rejectedApplications = Application::where('progress', 'rejected')->count();

    $applications = $query->latest()->paginate(5);

    return view('admin.dashboard', compact('applications','totalApplications',
    'submittedApplications',
    'underReviewApplications',
    'approvedApplications',
    'rejectedApplications'));
    }


    public function show(Application $application)
    {
        return view('admin.show', compact('application'));
    }

    public function updateStatus(Request $request, Application $application)
    {
    $request->validate([
        'progress' => 'required',
        'admin_comment' => 'nullable'
    ]);

    $application->update([
        'progress' => $request->progress,
        'admin_comment' => $request->admin_comment
    ]);

    Mail::to($application->user->email)->send(new ApplicationStatusMail($application));

    return redirect()->back()->with('success', 'Application status updated.');
    }

    public function export()
        {
            return Excel::download(new ApplicationsExport, 'applications.xlsx');
        }
}