<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Routes for authenticated users
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/password', [ProfileController::class, 'editPassword'])->name('profile.edit.password');
        Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
        Route::put('/update-preferences', [ProfileController::class, 'updatePreferences'])->name('profile.update.preferences');
    });

    // Settings Routes
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
        Route::get('/general', [SettingsController::class, 'general'])->name('settings.general');
        Route::get('/notifications', [SettingsController::class, 'notifications'])->name('settings.notifications');
        Route::get('/security', [SettingsController::class, 'security'])->name('settings.security');
        Route::get('/appearance', [SettingsController::class, 'appearance'])->name('settings.appearance');
    });

    // Roles & Permissions
    Route::resource('roles', RoleController::class);
    Route::get('/roles/{id}/users', [RoleController::class, 'users'])->name('roles.users');
    Route::post('/roles/{id}/assign-user', [RoleController::class, 'assignUser'])->name('roles.assignUser');
    Route::delete('/roles/{roleId}/remove-user/{userId}', [RoleController::class, 'removeUser'])->name('roles.removeUser');
    Route::post('/roles/{id}/bulk-assign-users', [RoleController::class, 'bulkAssignUsers'])->name('roles.bulkAssignUsers');

    // Student Management
    Route::resource('students', StudentController::class);
    Route::post('/students/bulk-delete', [StudentController::class, 'bulkDelete'])->name('students.bulk.delete');

    // Staff Management
    Route::resource('staff', StaffController::class);
    Route::post('/staff/bulk-delete', [StaffController::class, 'bulkDelete'])->name('staff.bulk.delete');

    // Fees Management
    Route::resource('fees', FeeController::class);
    Route::post('/fees/bulk-delete', [FeeController::class, 'bulkDelete'])->name('fees.bulk.delete');
    Route::post('/fees/{id}/mark-as-paid', [FeeController::class, 'markAsPaid'])->name('fees.markAsPaid');

    // Leave Management
    Route::resource('leaves', LeaveController::class);
    Route::post('/leaves/bulk-delete', [LeaveController::class, 'bulkDelete'])->name('leaves.bulk.delete');
    Route::post('/leaves/{id}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
    Route::post('/leaves/{id}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');
});
