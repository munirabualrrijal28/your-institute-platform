<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Comments;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReportController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = Reports::with(['reporter', 'reportable']);

        if ($request->filled('search')) {
            $query->where('reason', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reports = $query->latest()->paginate(10);

        return view('admin.report.reports', compact('reports'));
    }

    public function show(Reports $report)
    {
        $report->load(['reporter', 'reportable']);
        return view('admin.report.reports', compact('report'));
    }

    public function notifyReporter(Reports $report)
    {
        // TODO: Send notification (email or internal) to the reporter
        $report->update(['status' => 'reviewed']);

        return redirect()->back()->with('success', 'Reporter has been notified.');
    }

    public function deleteReportedContent(Reports $report)
    {
        $report->reportable->delete(); // Deletes the reported item (comment, ad, etc.)
        $report->update(['status' => 'resolved']);

        return redirect()->route('admin.manage.reports')->with('success', 'Reported content deleted.');
    }


    public function store(Request $request)
{
    $request->validate([
        'reportable_type' => 'required|string',
        'reportable_id' => 'required|integer',
        'reason' => 'required|string',
        'description' => 'nullable|string',
    ]);

   $report= Reports::create([
        'user_id_fk' => Auth::id(),
        'reportable_id' => $request->reportable_id,
        'reportable_type' => $request->reportable_type,
        'reason' => $request->reason,
        'description' => $request->description,
    ]);

    //

    // 💡 Notify all admins (or the first one, or based on your logic)
    $admin = Admin::first(); // or loop if multi-admin
    $notification = $admin->notifications()->create([
        'sender_id' => Auth::id(),
        'sender_type' => Auth::user()::class,
        'reciver_id' => $admin->id,
        'reciver_type' => Admin::class,
        'notification_type' => 'comment_reported',
        'data' => [
            'message' => '🛑 A comment has been reported and needs review.',
            'report_id' => $report->id,
        ]
    ]);

    event(new \App\Events\NotificationSent($notification)); // optional: broadcast it


    //



    return back()->with('success', 'Your report has been submitted.');
}

public function report($type, $id)
{
    // $model = match ($type) {
    //     'comment' => \App\Models\Comments::class,
    //     'advertisement' => \App\Models\Advertisements::class,
    //     'course' => \App\Models\Courses::class,
    //     default => abort(404),
    // };
    $model = match ($type) {
        'comment' => Comments::class,

        default => abort(404),
    };

    $reportable = $model::findOrFail($id);

    return view('admin.report.reports', [
        'reportable' => $reportable,
        'type' => $type,
        'class' => $model,
    ]);
}


public function resolve(Reports $report)
{
    $report->update(['status' => 'resolved']);
    return back()->with('success', 'Report marked as resolved.');
}

public function deleteUser($userId)
{
    $user = \App\Models\User::findOrFail($userId);
    $user->delete();

    return back()->with('success', 'User deleted successfully.');
}




}
