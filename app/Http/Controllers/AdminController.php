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

    $application->logs()->create([
    'action' => $request->progress,
    'description' => 'Application status updated to ' . $request->progress
    ]);

    //Mail::to($application->user->email)->send(new ApplicationStatusMail($application));
    Mail::to($application->user->email)->queue(new ApplicationStatusMail($application));

    return redirect()->back()->with('success', 'Application status updated.');
    }

    public function export()
        {
            return Excel::download(new ApplicationsExport, 'applications.xlsx');
        }

    public function destroy(Application $application){
        $application->delete();

        $application->logs()->create([
            'action' => 'deleted',
            'description' => 'Application moved to trash.'
        ]);
        return redirect()->back()->with('success'. 'Application moved to trash');
    }

        public function trash(Request $request)
{
    $query = Application::onlyTrashed();

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('full_name', 'like', '%' . $request->search . '%')
              ->orWhere('school', 'like', '%' . $request->search . '%')
              ->orWhere('application_number', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('progress')) {
        $query->where('progress', $request->progress);
    }

    $applications = $query->latest()
        ->paginate(5)
        ->appends($request->query());

    return view('admin.trash', compact('applications'));
}

        public function restore($id)
        {
            $application = Application::onlyTrashed()->findOrFail($id);

            $application->restore();

            $application->logs()->create([
                'action' => 'restored',
                'description' => 'Application restored from trash.'
            ]);

            return redirect()->back()->with('success', 'Application restored successfully.');
        }

        public function forceDelete($id)
        {
            $application = Application::onlyTrashed()->findOrFail($id);

            $application->forceDelete();

            return redirect()->back()->with('success', 'Application permanently deleted.');
        }
}