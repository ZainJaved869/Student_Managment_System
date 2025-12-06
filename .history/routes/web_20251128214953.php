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
Route::resource('students', StudentController::class);
Route::post('/students/bulk-delete', [StudentController::class, 'bulkDelete'])->name('students.bulk.delete');

// Staff Management Routes
Route::resource('staff', StaffController::class);
Route::post('/staff/bulk-delete', [StaffController::class, 'bulkDelete'])->name('staff.bulk.delete');

// Fees Management Routes
Route::resource('fees', FeeController::class);
Route::post('/fees/bulk-delete', [FeeController::class, 'bulkDelete'])->name('fees.bulk.delete');
Route::post('/fees/{id}/mark-as-paid', [FeeController::class, 'markAsPaid'])->name('fees.markAsPaid');

// Leave Management Routes
Route::resource('leaves', LeaveController::class);
Route::post('/leaves/bulk-delete', [LeaveController::class, 'bulkDelete'])->name('leaves.bulk.delete');
Route::post('/leaves/{id}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
Route::post('/leaves/{id}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');

// Profile & Settings
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Roles & Permissions
// Role Management Routes
Route::resource('roles', RoleController::class);
Route::get('/roles/{id}/users', [RoleController::class, 'users'])->name('roles.users');
Route::post('/roles/{id}/assign-user', [RoleController::class, 'assignUser'])->name('roles.assignUser');
Route::delete('/roles/{roleId}/remove-user/{userId}', [RoleController::class, 'removeUser'])->name('roles.removeUser');