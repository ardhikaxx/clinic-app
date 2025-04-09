<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Registration;
use App\Models\Pharmacy;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::count();
        $todayRegistrations = Registration::whereDate('registration_date', today())->count();
        $monthlyIncome = Payment::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('status', 'paid')
            ->sum('amount');
        $todayPrescriptions = Pharmacy::whereDate('created_at', today())->count();
        
        // Data for registration chart (last 6 months)
        $registrationMonths = [];
        $registrationCounts = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $registrationMonths[] = $date->format('M Y');
            $registrationCounts[] = Registration::whereYear('registration_date', $date->year)
                ->whereMonth('registration_date', $date->month)
                ->count();
        }
        
        $recentRegistrations = Registration::with('patient')
            ->latest()
            ->take(5)
            ->get();
            
        return view('admin.dashboard.index', compact(
            'totalPatients',
            'todayRegistrations',
            'monthlyIncome',
            'todayPrescriptions',
            'registrationMonths',
            'registrationCounts',
            'recentRegistrations'
        ));
    }
}