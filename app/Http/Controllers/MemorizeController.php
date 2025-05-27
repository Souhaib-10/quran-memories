<?php

namespace App\Http\Controllers;

use App\Models\Memorize;
use Illuminate\Http\Request;
use App\Models\Student;

class MemorizeController extends Controller
{
    public function create()
    {
        $students = Student::all();
        return view('amountMemorize', ['students' => $students]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'student_id' => 'required|integer|exists:students,id',
            'hizb' => 'required|integer|min:0|max:60',
            'fraction' => 'required|numeric|min:0|max:8',
            'review' => 'required'
        ]);
        if ($validate) {
            // dd($validate);
            Memorize::create($validate);
            return redirect()->route('students.index');
        } else {
            return view('amountMemorize');
        }
    }
    public function destroy(String $id)
    {
        $memorize = Memorize::find($id);
        $studentId = $memorize->student_id;
        try {
            $memorize->delete();
            return redirect()->route('students.show', $studentId)->with('success', 'تم حدف السجل بنجاح');
        } catch (\Exception $e) {
            return redirect()->route('students.show', $studentId)->with('error', 'operation failed' . $e->getMessage());
        }
    }

    // use this function to edit information of memorize record
    public function edit(Memorize $memorize)
    {
        // dd($memorize);
        $students = Student::all();
        return view('editDetailStudent', compact('students', 'memorize'));
    }

    public function update(Request $request, Memorize $memorize)
    {
        if (!$memorize) {
            return redirect()->route('students.index')->with('خطأ', 'لم يتم العثور على سجل الحفظ.');
        }
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'hizb' => 'required|integer|between:0,60',
            'fraction' => 'required|numeric|between:0,7.5',
            'review' => 'required|numeric|between:0,60',
        ]);

        // check if data changed
        $changes = [];
        foreach ($validated as $key => $value) {
            if ($memorize->{$key} != $value) {
                $changes[$key] = $value;
            }
        }
        // If no changes, return with a message
        if (empty($changes)) {
            return back()->with('رسالة', 'لم يتم إجراء أي تغييرات.');
        }

        // update only change date
        $memorize->update($changes);
        return redirect()->route('students.index')->with('نجاح العملية ', 'تم تحديث بيانات الطالب بنجاح.');
    }
}
