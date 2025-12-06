<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::latest()->paginate(10);
        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'nullable|string|max:20',
            'department' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'qualification' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'date_of_joining' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            DB::beginTransaction();

            // Generate unique staff ID
            $validated['staff_id'] = $this->generateUniqueStaffId();

            // Create staff
            Staff::create($validated);

            DB::commit();

            return redirect()->route('staff.index')
                ->with('success', 'Staff member created successfully! Staff ID: ' . $validated['staff_id']);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error creating staff member: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff.show', compact('staff'));
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);
        
        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'department' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'qualification' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'date_of_joining' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            DB::beginTransaction();

            $staff->update($validated);

            DB::commit();

            return redirect()->route('staff.index')
                ->with('success', 'Staff member updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error updating staff member: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        
        try {
            DB::beginTransaction();

            $staff->delete();

            DB::commit();

            return redirect()->route('staff.index')
                ->with('success', 'Staff member deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('staff.index')
                ->with('error', 'Error deleting staff member: ' . $e->getMessage());
        }
    }

    // Bulk actions
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'staff_ids' => 'required|array',
            'staff_ids.*' => 'exists:staff,id'
        ]);

        try {
            DB::beginTransaction();

            Staff::whereIn('id', $request->staff_ids)->delete();

            DB::commit();

            return redirect()->route('staff.index')
                ->with('success', 'Selected staff members deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('staff.index')
                ->with('error', 'Error deleting staff members: ' . $e->getMessage());
        }
    }

    /**
     * Generate unique staff ID
     */
    private function generateUniqueStaffId()
    {
        $prefix = 'STF-';
        $maxAttempts = 100;
        
        for ($attempt = 0; $attempt < $maxAttempts; $attempt++) {
            // Get the latest staff ID
            $lastStaff = Staff::orderBy('id', 'desc')->first();
            
            if ($lastStaff && preg_match('/^STF-(\d+)$/', $lastStaff->staff_id, $matches)) {
                $nextNumber = (int)$matches[1] + 1;
            } else {
                $nextNumber = 1;
            }
            
            $staffId = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            
            // Check if this ID already exists
            if (!Staff::where('staff_id', $staffId)->exists()) {
                return $staffId;
            }
            
            // If ID exists, try next number
            $nextNumber++;
        }
        
        // If all attempts fail, generate a random unique ID
        do {
            $randomId = $prefix . str_pad(mt_rand(1000, 9999), 4, '0', STR_PAD_LEFT);
        } while (Staff::where('staff_id', $randomId)->exists());
        
        return $randomId;
    }
}