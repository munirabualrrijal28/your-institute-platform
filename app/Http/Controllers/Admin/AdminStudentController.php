<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    //
       public function listStudents(Request $request)
    {
        $query = Student::with('user');

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $students = $query->latest()->paginate(9);

        return view('admin.student.manage_students', compact('students'));
    }


    public function delete_student($id)
    {
         $student = Student::findOrFail($id);

    // Also delete the associated user if needed
    $user = $student->user;

    // First delete the student record
    $student->delete();

    // Then delete the related user (optional — if not reused elsewhere)
    if ($user) {
        $user->delete();
    }

    return back()->with('success', 'Student deleted successfully.');
    }

}
