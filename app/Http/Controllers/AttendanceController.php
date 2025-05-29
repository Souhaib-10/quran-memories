<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
{
    $students = Student::withCount([
        'attendances as present_count' => function($query){
            $query->where('status', 'حاضر');
        },
        'attendances as absent_count' => function($query){
            $query->where('status', 'غائب');
        }
    ])->get();

    return view('attendance.index', compact('students'));
}
    // public function index()
    // {
    //     $students = Student::all();
    //     return view('attendance.index', compact('students'));
    // }

    public function create()
    {
        $students = Student::all();
        return view('attendance.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'attendance' => 'required|array',
            'attendance.*.status' => 'required|in:حاضر,غائب',
        ]);

        if ($validated) {
            $attendanceData = $request->input('attendance');
            foreach ($attendanceData as $studentId => $data) {
                Attendance::create([
                    'student_id' => $studentId,
                    'status' => $data['status'],
                ]);
            }
            return redirect()->route('attendance.index')->with('success', 'Attendance created successfully');
        }
        return redirect()->route('attendance.create')->with('error', 'Attendance creation failed');
    }
    public function show($student_id)
    {
        $student = Student::with('attendances')->findOrFail($student_id);
        return view('attendance.show', compact('student'));
    }

    public function edit($attendance_id)
    {
        $attendance = Attendance::with('student')->findOrFail($attendance_id);
        return view('attendance.edit', compact('attendance'));
    }
    public function update(Request $request, $attendance_id)
    {
    // Validate the input
    $validated = $request->validate([
        'status' => 'required|in:حاضر,غائب',
    ]);

    if (!$validated) {
        return redirect()->route('attendance.edit', $attendance_id)->with('error', 'Attendance update failed');
    }
    // Find the attendance record
    $attendance = Attendance::findOrFail($attendance_id);

    // Update the status
    $attendance->status = $validated['status'];
    $attendance->save();

    // Redirect back with success message
    return redirect()->route('attendance.show', $attendance->student_id)
                     ->with('success', 'Attendance updated successfully.');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        return redirect()->route('attendance.index')->with('success', 'Attendance deleted successfully');
    }



}
