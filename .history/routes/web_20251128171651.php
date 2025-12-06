<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Student Management Routes
Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('students.index');
    Route::get('/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/', [StudentController::class, 'store'])->name('students.store');
    Route::get('/{id}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
});

// Staff Management Routes
Route::prefix('staff')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/', [StaffController::class, 'store'])->name('staff.store');
    Route::get('/{id}', [StaffController::class, 'show'])->name('staff.show');
    Route::get('/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
    Route::put('/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::delete('/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
});

// Fees Management Routes
Route::prefix('fees')->group(function () {
    Route::get('/', [FeeController::class, 'index'])->name('fees.index');
    Route::get('/create', [FeeController::class, 'create'])->name('fees.create');
    Route::post('/', [FeeController::class, 'store'])->name('fees.store');
    Route::get('/{id}', [FeeController::class, 'show'])->name('fees.show');
    Route::get('/{id}/edit', [FeeController::class, 'edit'])->name('fees.edit');
    Route::put('/{id}', [FeeController::class, 'update'])->name('fees.update');
    Route::delete('/{id}', [FeeController::class, 'destroy'])->name('fees.destroy');
});

// Leave Management Routes
Route::prefix('leaves')->group(function () {
    Route::get('/', [LeaveController::class, 'index'])->name('leaves.index');
    Route::get('/create', [LeaveController::class, 'create'])->name('leaves.create');
    Route::post('/', [LeaveController::class, 'store'])->name('leaves.store');
    Route::post('/{id}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
    Route::post('/{id}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');
});

// Profile & Settings
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Roles & Permissions
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');



Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Student Management Routes
Route::resource('students', StudentController::class);
Route::post('/students/bulk-delete', [StudentController::class, 'bulkDelete'])->name('students.bulk.delete');

// Other routes remain the same...