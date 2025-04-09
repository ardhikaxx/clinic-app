<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\Examination\GeneralController;
use App\Http\Controllers\Admin\Examination\KiaController;
use App\Http\Controllers\Admin\Examination\InpatientController;
use App\Http\Controllers\Admin\Examination\EmergencyController;
use App\Http\Controllers\Admin\PharmacyController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\MedicalRecordController;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Auth;

// // Authentication Routes
Auth::routes(['register' => false]);

// Redirect root to login
Route::redirect('/', '/login');

// Admin Routes with auth and admin middleware protection
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Patients
    Route::resource('patients', PatientController::class);
    
    // Registrations
    Route::resource('registrations', RegistrationController::class);
    
    // Examinations
    Route::prefix('examinations')->name('examinations.')->group(function () {
        Route::resource('general', GeneralController::class);
        Route::resource('kia', KiaController::class);
        Route::resource('inpatient', InpatientController::class);
        Route::resource('emergency', EmergencyController::class);
    });
    
    // Pharmacy (changed to plural for consistency)
    Route::resource('pharmacy', PharmacyController::class)->except(['show']);
    
    // Payments
    Route::resource('payments', PaymentController::class);
    
    // Medical Records
    Route::resource('medical-records', MedicalRecordController::class)->only(['index', 'show']);
    
    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
});

// Optional home route (if needed)
Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth')->name('home');