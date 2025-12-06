<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:20',
            'class' => 'required|string|max:50',
            'section' => 'required|string|max:10',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            DB::beginTransaction();

            // Generate unique student ID
            $validated['student_id'] = $this->generateUniqueStudentId();

            // Create student
            Student::create($validated);

            DB::commit();

            return redirect()->route('students.index')
                ->with('success', 'Student created successfully! Student ID: ' . $validated['student_id']);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error creating student: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        
        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'class' => 'required|string|max:50',
            'section' => 'required|string|max:10',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            DB::beginTransaction();

            $student->update($validated);

            DB::commit();

            return redirect()->route('students.index')
                ->with('success', 'Student updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error updating student: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        
        try {
            DB::beginTransaction();

            $student->delete();

            DB::commit();

            return redirect()->route('students.index')
                ->with('success', 'Student deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('students.index')
                ->with('error', 'Error deleting student: ' . $e->getMessage());
        }
    }

    // Bulk actions
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:students,id'
        ]);

        try {
            DB::beginTransaction();

            Student::whereIn('id', $request->student_ids)->delete();

            DB::commit();

            return redirect()->route('students.index')
                ->with('success', 'Selected students deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('students.index')
                ->with('error', 'Error deleting students: ' . $e->getMessage());
        }
    }

    /**
     * Generate unique student ID
     */
    private function generateUniqueStudentId()
    {
        $prefix = 'STU-';
        $maxAttempts = 100;
        
        for ($attempt = 0; $attempt < $maxAttempts; $attempt++) {
            // Get the latest student ID
            $lastStudent = Student::orderBy('id', 'desc')->first();
            
            if ($lastStudent && preg_match('/^STU-(\d+)$/', $lastStudent->student_id, $matches)) {
                $nextNumber = (int)$matches[1] + 1;
            } else {
                $nextNumber = 1;
            }
            
            $studentId = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            
            // Check if this ID already exists
            if (!Student::where('student_id', $studentId)->exists()) {
                return $studentId;
            }
            
            // If ID exists, try next number
            $nextNumber++;
        }
        
        // If all attempts fail, generate a random unique ID
        do {
            $randomId = $prefix . str_pad(mt_rand(1000, 9999), 4, '0', STR_PAD_LEFT);
        } while (Student::where('student_id', $randomId)->exists());
        
        return $randomId;
    }
}