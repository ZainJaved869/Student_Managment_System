<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Student;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    public function index()
    {
        // Eager load applicant relationship and filter out leaves without applicants
        $leaves = Leave::with(['applicant' => function($query) {
            $query->withTrashed(); // Include soft deleted applicants if any
        }])
        ->whereHas('applicant') // Only include leaves that have applicants
        ->latest()
        ->paginate(10);

        return view('leaves.index', compact('leaves'));
    }

    // ... rest of the methods remain the same until the store method ...

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'applicant_type' => 'required|in:student,staff',
            'applicant_id' => 'required',
            'leave_type' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            // Set the correct applicant type and ID
            if ($validated['applicant_type'] === 'student') {
                $validated['applicant_type'] = 'App\\Models\\Student';
                // Verify student exists
                if (!Student::where('id', $validated['applicant_id'])->exists()) {
                    return redirect()->back()
                        ->with('error', 'Selected student does not exist.')
                        ->withInput();
                }
            } else {
                $validated['applicant_type'] = 'App\\Models\\Staff';
                // Verify staff exists
                if (!Staff::where('id', $validated['applicant_id'])->exists()) {
                    return redirect()->back()
                        ->with('error', 'Selected staff member does not exist.')
                        ->withInput();
                }
            }

            // Set default status to pending
            $validated['status'] = 'pending';

            // Create leave record
            Leave::create($validated);

            DB::commit();

            return redirect()->route('leaves.index')
                ->with('success', 'Leave application submitted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error submitting leave application: ' . $e->getMessage())
                ->withInput();
        }
    }

    // ... rest of the methods remain the same ...


    public function show($id)
    {
        $leave = Leave::with('applicant')->findOrFail($id);
        return view('leaves.show', compact('leave'));
    }

    public function edit($id)
    {
        $leave = Leave::findOrFail($id);
        $students = Student::where('status', 'active')->get();
        $staff = Staff::where('status', 'active')->get();
        return view('leaves.edit', compact('leave', 'students', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
        
        // Validate the request
        $validated = $request->validate([
            'applicant_type' => 'required|in:student,staff',
            'applicant_id' => 'required',
            'leave_type' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:500',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        try {
            DB::beginTransaction();

            // Set the correct applicant type and ID
            if ($validated['applicant_type'] === 'student') {
                $validated['applicant_type'] = 'App\\Models\\Student';
                $validated['applicant_id'] = $validated['applicant_id'];
            } else {
                $validated['applicant_type'] = 'App\\Models\\Staff';
                $validated['applicant_id'] = $validated['applicant_id'];
            }

            $leave->update($validated);

            DB::commit();

            return redirect()->route('leaves.index')
                ->with('success', 'Leave application updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error updating leave application: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);
        
        try {
            DB::beginTransaction();

            $leave->delete();

            DB::commit();

            return redirect()->route('leaves.index')
                ->with('success', 'Leave application deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('leaves.index')
                ->with('error', 'Error deleting leave application: ' . $e->getMessage());
        }
    }

    // Approve leave
    public function approve($id)
    {
        $leave = Leave::findOrFail($id);
        
        try {
            DB::beginTransaction();

            $leave->update([
                'status' => 'approved',
            ]);

            DB::commit();

            return redirect()->back()
                ->with('success', 'Leave application approved successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error approving leave application: ' . $e->getMessage());
        }
    }

    // Reject leave
    public function reject($id)
    {
        $leave = Leave::findOrFail($id);
        
        try {
            DB::beginTransaction();

            $leave->update([
                'status' => 'rejected',
            ]);

            DB::commit();

            return redirect()->back()
                ->with('success', 'Leave application rejected successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error rejecting leave application: ' . $e->getMessage());
        }
    }

    // Bulk actions
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'leave_ids' => 'required|array',
            'leave_ids.*' => 'exists:leaves,id'
        ]);

        try {
            DB::beginTransaction();

            Leave::whereIn('id', $request->leave_ids)->delete();

            DB::commit();

            return redirect()->route('leaves.index')
                ->with('success', 'Selected leave applications deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('leaves.index')
                ->with('error', 'Error deleting leave applications: ' . $e->getMessage());
        }
    }
}