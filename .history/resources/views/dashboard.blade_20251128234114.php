<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SystemConfig;
use App\Models\GradeLevel;
use App\Models\Subject;
use App\Models\GradingScale;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // System overview statistics
        $totalUsers = User::count();
        $totalStudents = User::where('role', 'student')->count();
        $totalStaff = User::whereIn('role', ['teacher', 'admin', 'staff'])->count();
        
        // Database size calculation (MySQL example)
        $databaseSize = $this->getDatabaseSize();
        
        // System configuration
        $systemConfig = SystemConfig::first();
        $academicYears = $this->getAcademicYears();
        $terms = ['Fall Semester', 'Spring Semester', 'Summer Term'];
        $currencies = [
            ['code' => 'USD', 'name' => 'US Dollar'],
            ['code' => 'EUR', 'name' => 'Euro'],
            ['code' => 'GBP', 'name' => 'British Pound'],
        ];
        
        // User management
        $users = User::with('lastLogin')->orderBy('created_at', 'desc')->paginate(10);
        
        // Security settings
        $securitySettings = $this->getSecuritySettings();
        
        // Academic setup
        $gradeLevels = GradeLevel::orderBy('order')->get();
        $subjects = Subject::orderBy('name')->get();
        $gradingScales = GradingScale::orderBy('min_score', 'desc')->get();
        
        // System logs
        $systemLogs = SystemLog::with('user')
            ->when(request('type'), function($query, $type) {
                return $query->where('type', $type);
            })
            ->when(request('date'), function($query, $date) {
                return $query->whereDate('created_at', $date);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // Last backup info
        $lastBackup = $this->getLastBackupInfo();

        return view('admin.index', compact(
            'totalUsers',
            'totalStudents',
            'totalStaff',
            'databaseSize',
            'systemConfig',
            'academicYears',
            'terms',
            'currencies',
            'users',
            'securitySettings',
            'gradeLevels',
            'subjects',
            'gradingScales',
            'systemLogs',
            'lastBackup'
        ));
    }
    
    private function getDatabaseSize()
    {
        try {
            $size = DB::select(DB::raw("
                SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) as size_mb 
                FROM information_schema.tables 
                WHERE table_schema = DATABASE()
            "))[0]->size_mb;
            
            return $size ?? 0;
        } catch (\Exception $e) {
            return 0;
        }
    }
    
    private function getAcademicYears()
    {
        $currentYear = date('Y');
        $years = [];
        
        for ($i = -2; $i <= 2; $i++) {
            $year = $currentYear + $i;
            $years[] = ($year - 1) . '-' . $year;
        }
        
        return $years;
    }
    
    private function getSecuritySettings()
    {
        // This would typically come from a database table
        return (object) [
            'password_policy' => true,
            'two_factor_auth' => false,
            'session_timeout' => 30,
        ];
    }
    
    private function getLastBackupInfo()
    {
        // Implement your backup system logic here
        $backupPath = storage_path('app/backups');
        
        if (is_dir($backupPath)) {
            $files = glob($backupPath . '/*.sql*');
            if (!empty($files)) {
                $latestFile = max($files);
                return date('M j, Y H:i', filemtime($latestFile));
            }
        }
        
        return 'Never';
    }
    
    public function updateSystemConfig(Request $request)
    {
        $validated = $request->validate([
            'institution_name' => 'required|string|max:255',
            'institution_code' => 'required|string|max:50',
            'academic_year' => 'required|string',
            'current_term' => 'required|string',
            'session_start' => 'required|date',
            'session_end' => 'required|date|after:session_start',
            'class_start_time' => 'required',
            'class_end_time' => 'required',
            'default_currency' => 'required|string|size:3',
            'late_fee_percentage' => 'required|numeric|min:0|max:50',
            'grace_period_days' => 'required|integer|min:0|max:30',
        ]);
        
        $config = SystemConfig::firstOrNew([]);
        $config->fill($validated);
        $config->save();
        
        // Log the configuration change
        SystemLog::create([
            'type' => 'system',
            'description' => 'System configuration updated',
            'user_id' => auth()->id(),
            'ip_address' => $request->ip(),
        ]);
        
        return redirect()->back()->with('success', 'System configuration updated successfully.');
    }
}