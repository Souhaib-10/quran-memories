<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //===================================index  with filtration date=======================================
    // public function index(Request $request)
    // {
    //     // Get the start and end dates from the request (if available)
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     // Initialize the query for students with memorizes
    //     $query = Student::with(['memorizes' => function ($query) use ($startDate, $endDate) {
    //         if ($startDate && $endDate) {
    //             $query->whereBetween('created_at', [$startDate, $endDate]);
    //         }
    //     }]);

    //     // Get the students with related memorizes, sorted by total sum (hizb + fraction + review)
    //     $students = $query->get()
    //         ->map(function ($student) {
    //             // Calculate the total hizb, fraction, and review
    //             $totalHizb = $student->memorizes->sum('hizb');
    //             $totalFraction = $student->memorizes->sum('fraction');
    //             $totalReview = $student->memorizes->sum('review');

    //             // Calculate the total sum
    //             $student->totalSum = $totalHizb + $totalFraction + $totalReview;

    //             // Calculate the additional hizb from fractions
    //             // $additionalHizb = intdiv($totalFraction, 8);
    //             // $remainingFraction = $totalFraction % 8;
    //             // $allHizbMemories = $totalHizb + $additionalHizb;
    //             $additionalHizb = floor($totalFraction / 8); // Full hizbs from fractions
    //             $remainingFraction = fmod($totalFraction, 8); // Remaining fractions (float)
    //             $allHizbMemories = $totalHizb + $additionalHizb;

    //             // Calculate completed khatma and remaining hizb
    //             if ($allHizbMemories >= 60) {
    //                 $completedKhatma = intdiv($allHizbMemories, 60);
    //                 $student->completions += $completedKhatma;
    //                 $remainingHizb = $allHizbMemories % 60;
    //             } else {
    //                 $remainingHizb = $allHizbMemories;
    //             }
    //             // calculate level student
    //             if ($remainingHizb < 30) {
    //                 $detectedLevel = intdiv($remainingHizb, 5) + 1;
    //             } else {
    //                 $detectedLevel = 7;
    //                 $fractionAllHizbMemories = $remainingHizb - 30;
    //                 $detectedLevel += intdiv($fractionAllHizbMemories, 10);
    //             }


    //             // Store the adjusted values
    //             $student->adjustedHizb = $remainingHizb;
    //             $student->adjustedFraction = $remainingFraction;
    //             $student->adjustedReview = $totalReview;
    //             $student->level = $detectedLevel;

    //             return $student;
    //         })
    //         // Sort students by the total sum of hizb + fraction + review in descending order
    //         ->sortBy('name')
    //         ->values(); // Reset array keys

    //     return view('listStudents', ['students' => $students]);
    // }

    //============== original index  with no filtration date ========================================
    public function index(Request $request)
    {
        $search = $request->input('search');
        $studentsQuery = Student::with("memorizes");
        if($search){
            $studentsQuery->where('name','like',"$search%");
        }

        $students =$studentsQuery->get()->sortBy('name')->values();
        // method to calculate total hizb and know remainder like fraction
        foreach ($students as $student) {
            $totalHizb = $student->memorizes->sum('hizb');
            $totalFraction = $student->memorizes->sum('fraction');
            $totalReview = $student->memorizes->sum('review');
            // how fraction can give hizb (ex: 8f=>1hisb)
            $additionalHizb = intdiv($totalFraction, 8);
            // rest fraction after split hizb
            $remainingFraction = $totalFraction % 8;
            $allHizbMemories = $totalHizb + $additionalHizb;
            if ($allHizbMemories >= 60) {
                $completedKhatma = intdiv($allHizbMemories, 60);
                // add 1 to completions for 60 hizb
                $student->completions += $completedKhatma;
                // calculate remaining hizb after add 1 to completions
                $remainingHizb = $allHizbMemories % 60;
            } else {
                $remainingHizb = $allHizbMemories;
            }
            // calculate level student
            if ($remainingHizb < 30) {
                $detectedLevel = intdiv($remainingHizb, 5) + 1;
            } else {
                $detectedLevel = 7;
                $fractionAllHizbMemories = $remainingHizb - 30;
                $detectedLevel += intdiv($fractionAllHizbMemories, 10);
            }
            $student->level = $detectedLevel;
            $student->adjustedHizb = $remainingHizb;
            $student->adjustedFraction = $remainingFraction;
            $student->adjustedReview = $totalReview;
        }

        return view('listStudents', ['students' => $students]);
    }
    // ================================================================

    public function create()
    {
        $hizbs = json_decode(file_get_contents(resource_path('data/hizb.json')), true)['hizbs'];
        // dd($hizbs);

        return view('newStudent', compact('hizbs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:32',
            'date' => 'required|date',
            'starting_surah' => 'required|string|max:255',
            'completions' => 'required|integer|min:0',
        ]);
        if ($validated) {
            Student::create([
                'name' => $request->input('name'),
                'date' => $request->input('date'),
                'starting_surah' => $request->starting_surah,
                'completions' => (int) $request->input('completions'),
            ]);
            return redirect()->route('students.index')->with('success', 'Student created successfully.');
        } else {
            return view('newStudent');
        }
    }

    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return redirect()->route('students.index')->with('success', 'تم حدف طالب بنجاح');
        } catch (\Exception $e) {
            return redirect()->route('students.index')->with('error', 'operation failed' . $e->getMessage());
        }
    }

    public function show(Student $student)
    {
        // $student->load("memorizes")->orderBy('memorizes.created_at', 'desc');
        $student->load(['memorizes' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);
        // dd($student);
        return view('detailStudent', compact("student"));
    }
    public function edit(Student $student)
    {
        $hizbs = json_decode(file_get_contents(resource_path('data/hizb.json')), true)['hizbs'];
        return view('editerStudent', compact("student", "hizbs"));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|max:32',
            'date' => 'required|date',
            'completions' => 'required|integer|min:0',
            'starting_surah' => 'required|string|max:255',
        ]);

        // check if data changed
        $changes = [];
        foreach ($validated as $key => $value) {
            if ($student->{$key} != $value) {
                $changes[$key] = $value;
            }
        }
        // If no changes, return with a message
        if (empty($changes)) {
            return back()->with('message', 'لم يتم إجراء أي تغييرات.');
        }

        // update only change date
        $student->update($changes);
        return redirect()->route('students.index')->with('success', 'تم تحديث بيانات الطالب بنجاح.');
    }
}
