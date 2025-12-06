<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::with('student')->latest()->paginate(10);
        return view('fees.index', compact('fees'));
    }

    public function create()
    {
        $students = Student::where('status', 'active')->get();
        return view('fees.create', compact('students'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'paid_date' => 'nullable|date',
            'payment_method' => 'nullable|string|max:50',
            'transaction_id' => 'nullable|string|max:100',
            'status' => 'required|in:pending,paid,overdue',
        ]);

        try {
            DB::beginTransaction();

            // Create fee record
            Fee::create($validated);

            DB::commit();

            return redirect()->route('fees.index')
                ->with('success', 'Fee record created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error creating fee record: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $fee = Fee::with('student')->findOrFail($id);
        return view('fees.show', compact('fee'));
    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id);
        $students = Student::where('status', 'active')->get();
        return view('fees.edit', compact('fee', 'students'));
    }

    public function update(Request $request, $id)
    {
        $fee = Fee::findOrFail($id);
        
        // Validate the request
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'paid_date' => 'nullable|date',
            'payment_method' => 'nullable|string|max:50',
            'transaction_id' => 'nullable|string|max:100',
            'status' => 'required|in:pending,paid,overdue',
        ]);

        try {
            DB::beginTransaction();

            $fee->update($validated);

            DB::commit();

            return redirect()->route('fees.index')
                ->with('success', 'Fee record updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error updating fee record: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $fee = Fee::findOrFail($id);
        
        try {
            DB::beginTransaction();

            $fee->delete();

            DB::commit();

            return redirect()->route('fees.index')
                ->with('success', 'Fee record deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('fees.index')
                ->with('error', 'Error deleting fee record: ' . $e->getMessage());
        }
    }

    // Mark as paid
    public function markAsPaid($id)
    {
        $fee = Fee::findOrFail($id);
        
        try {
            DB::beginTransaction();

            $fee->update([
                'status' => 'paid',
                'paid_date' => now(),
            ]);

            DB::commit();

            return redirect()->back()
                ->with('success', 'Fee marked as paid successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error marking fee as paid: ' . $e->getMessage());
        }
    }

    // Bulk actions
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'fee_ids' => 'required|array',
            'fee_ids.*' => 'exists:fees,id'
        ]);

        try {
            DB::beginTransaction();

            Fee::whereIn('id', $request->fee_ids)->delete();

            DB::commit();

            return redirect()->route('fees.index')
                ->with('success', 'Selected fee records deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('fees.index')
                ->with('error', 'Error deleting fee records: ' . $e->getMessage());
        }
    }
}