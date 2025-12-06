<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Fee;
use App\Models\ActivityLog;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // User statistics
        $totalStudents = User::where('role', 'student')->count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalStaff = User::whereIn('role', ['admin', 'staff'])->count();
        
        // Pending fees calculation
        $pendingFees = Fee::where('status', 'pending')
            ->orWhere('status', 'overdue')
            ->sum('amount');
        
        // Trend calculations (compared to previous month)
        $studentTrend = $this->calculateTrend('student');
        $teacherTrend = $this->calculateTrend('teacher');
        $staffTrend = $this->calculateTrend('staff');
        $feeTrend = $this->calculateFeeTrend();
        
        // Upcoming events (next 7 days)
        $upcomingEvents = Event::where('event_date', '>=', now())
            ->where('event_date', '<=', now()->addDays(7))
            ->orderBy('event_date')
            ->orderBy('start_time')
            ->limit(5)
            ->get();
        
        // Recent activities
        $recentActivities = ActivityLog::with('causer')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Recent students
        $recentStudents = Student::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Chart data
        $enrollmentChart = $this->getEnrollmentChartData();
        $feeChart = $this->getFeeChartData();

        return view('dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalStaff',
            'pendingFees',
            'studentTrend',
            'teacherTrend',
            'staffTrend',
            'feeTrend',
            'upcomingEvents',
            'recentActivities',
            'recentStudents',
            'enrollmentChart',
            'feeChart'
        ));
    }
    
    private function calculateTrend($role)
    {
        $currentMonth = User::where('role', $role)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
            
        $lastMonth = User::where('role', $role)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        
        if ($lastMonth == 0) {
            return $currentMonth > 0 ? 100 : 0;
        }
        
        return round((($currentMonth - $lastMonth) / $lastMonth) * 100, 1);
    }
    
    private function calculateFeeTrend()
    {
        $currentMonth = Fee::where('status', 'paid')
            ->whereMonth('paid_at', now()->month)
            ->whereYear('paid_at', now()->year)
            ->sum('amount');
            
        $lastMonth = Fee::where('status', 'paid')
            ->whereMonth('paid_at', now()->subMonth()->month)
            ->whereYear('paid_at', now()->subMonth()->year)
            ->sum('amount');
        
        if ($lastMonth == 0) {
            return $currentMonth > 0 ? 100 : 0;
        }
        
        return round((($currentMonth - $lastMonth) / $lastMonth) * 100, 1);
    }
    
    private function getEnrollmentChartData($days = 30)
    {
        $startDate = now()->subDays($days);
        $endDate = now();
        
        $enrollments = User::where('role', 'student')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        $labels = [];
        $data = [];
        
        for ($i = $days; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('M j');
            $labels[] = $date;
            
            $count = $enrollments->firstWhere('date', now()->subDays($i)->format('Y-m-d'));
            $data[] = $count ? $count->count : 0;
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
    
    private function getFeeChartData($days = 30)
    {
        $startDate = now()->subDays($days);
        $endDate = now();
        
        $fees = Fee::where('status', 'paid')
            ->whereBetween('paid_at', [$startDate, $endDate])
            ->selectRaw('DATE(paid_at) as date, SUM(amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        $labels = [];
        $data = [];
        
        for ($i = $days; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('M j');
            $labels[] = $date;
            
            $fee = $fees->firstWhere('date', now()->subDays($i)->format('Y-m-d'));
            $data[] = $fee ? $fee->total : 0;
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
    
    public function getChartData(Request $request)
    {
        $type = $request->get('type');
        $days = $request->get('days', 30);
        
        if ($type === 'enrollment') {
            $data = $this->getEnrollmentChartData($days);
        } else {
            $data = $this->getFeeChartData($days);
        }
        
        return response()->json($data);
    }
}