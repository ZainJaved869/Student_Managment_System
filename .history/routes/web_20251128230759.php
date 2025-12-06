<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;





use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::middleware(['auth'])->group(function () {
    // Profile main page
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Edit profile page
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Edit password page
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.edit.password');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

    // Preferences
    Route::post('/profile/preferences', [ProfileController::class, 'updatePreferences'])->name('profile.update.preferences');
});

// If you want the root to redirect to dashboard for authenticated users
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return view('welcome');
})->name('home');




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


// Profile Routes
Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
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