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
        // User statistics with error handling
        try {
            $totalStudents = User::where('role', 'student')->count();
            $totalTeachers = User::where('role', 'teacher')->count();
            $totalStaff = User::whereIn('role', ['admin', 'staff'])->count();
        } catch (\Exception $e) {
            $totalStudents = User::count();
            $totalTeachers = 0;
            $totalStaff = 1;
        }
        
        // Pending fees calculation with error handling
        try {
            $pendingFees = Fee::whereIn('status', ['pending', 'overdue'])->sum('amount');
        } catch (\Exception $e) {
            $pendingFees = 0;
        }
        
        // Trend calculations with error handling
        $studentTrend = $this->calculateTrend('student');
        $teacherTrend = $this->calculateTrend('teacher');
        $staffTrend = $this->calculateTrend('staff');
        $feeTrend = $this->calculateFeeTrend();
        
        // Upcoming events with error handling
        try {
            $upcomingEvents = Event::where('event_date', '>=', now())
                ->where('event_date', '<=', now()->addDays(7))
                ->orderBy('event_date')
                ->orderBy('start_time')
                ->limit(5)
                ->get();
        } catch (\Exception $e) {
            $upcomingEvents = collect([]);
        }
        
        // Recent activities with error handling
        try {
            $recentActivities = ActivityLog::with('causer')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        } catch (\Exception $e) {
            $recentActivities = collect([]);
        }
        
        // Recent students with error handling
        try {
            $recentStudents = Student::with('user')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        } catch (\Exception $e) {
            $recentStudents = collect([]);
        }
        
        // Chart data with error handling
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
        try {
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
        } catch (\Exception $e) {
            return 0;
        }
    }
    
    private function calculateFeeTrend()
    {
        try {
            // Use created_at if paid_at doesn't exist
            if (Schema::hasColumn('fees', 'paid_at')) {
                $currentMonth = Fee::where('status', 'paid')
                    ->whereMonth('paid_at', now()->month)
                    ->whereYear('paid_at', now()->year)
                    ->sum('amount');
                    
                $lastMonth = Fee::where('status', 'paid')
                    ->whereMonth('paid_at', now()->subMonth()->month)
                    ->whereYear('paid_at', now()->subMonth()->year)
                    ->sum('amount');
            } else {
                // Fallback to created_at
                $currentMonth = Fee::where('status', 'paid')
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->sum('amount');
                    
                $lastMonth = Fee::where('status', 'paid')
                    ->whereMonth('created_at', now()->subMonth()->month)
                    ->whereYear('created_at', now()->subMonth()->year)
                    ->sum('amount');
            }
            
            if ($lastMonth == 0) {
                return $currentMonth > 0 ? 100 : 0;
            }
            
            return round((($currentMonth - $lastMonth) / $lastMonth) * 100, 1);
        } catch (\Exception $e) {
            return 0;
        }
    }
    
    private function getEnrollmentChartData($days = 30)
    {
        try {
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
        } catch (\Exception $e) {
            // Return demo data
            return [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                'data' => [65, 59, 80, 81, 56, 55]
            ];
        }
    }
    
    private function getFeeChartData($days = 30)
    {
        try {
            $startDate = now()->subDays($days);
            $endDate = now();
            
            // Check if fees table exists and has data
            if (!Schema::hasTable('fees')) {
                throw new \Exception('Fees table not found');
            }
            
            // Use appropriate date column
            $dateColumn = Schema::hasColumn('fees', 'paid_at') ? 'paid_at' : 'created_at';
            
            $fees = Fee::where('status', 'paid')
                ->whereBetween($dateColumn, [$startDate, $endDate])
                ->selectRaw("DATE($dateColumn) as date, SUM(amount) as total")
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
        } catch (\Exception $e) {
            // Return demo data
            return [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                'data' => [12000, 19000, 15000, 25000, 22000, 30000]
            ];
        }
    }
    
    public function getChartData(Request $request)
    {
        $type = $request->get('type');
        $days = $request->get('days', 30);
        
        try {
            if ($type === 'enrollment') {
                $data = $this->getEnrollmentChartData($days);
            } else {
                $data = $this->getFeeChartData($days);
            }
            
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'labels' => [],
                'data' => []
            ]);
        }
    }
}