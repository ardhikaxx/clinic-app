<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Registration;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'report_type' => 'required|in:patient,registration,payment',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        switch ($request->report_type) {
            case 'patient':
                $data = Patient::whereBetween('created_at', [$startDate, $endDate])->get();
                $view = 'admin.reports.patient';
                $title = 'Laporan Data Pasien';
                break;
                
            case 'registration':
                $data = Registration::with('patient')
                    ->whereBetween('registration_date', [$startDate, $endDate])
                    ->get();
                $view = 'admin.reports.registration';
                $title = 'Laporan Pendaftaran Pasien';
                break;
                
            case 'payment':
                $data = Payment::with(['registration.patient'])
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->get();
                $view = 'admin.reports.payment';
                $title = 'Laporan Pembayaran';
                break;
        }

        return view($view, [
            'data' => $data,
            'title' => $title,
            'start_date' => $startDate->format('d/m/Y'),
            'end_date' => $endDate->format('d/m/Y'),
        ]);
    }
}