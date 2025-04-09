<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::with('patient')->latest()->paginate(10);
        return view('admin.registrations.index', compact('registrations'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('admin.registrations.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'registration_date' => 'required|date',
            'complaint' => 'required',
            'service_type' => 'required|in:umum,kia,rawat_inap,ugd',
        ]);

        Registration::create([
            'patient_id' => $request->patient_id,
            'registration_date' => $request->registration_date,
            'complaint' => $request->complaint,
            'service_type' => $request->service_type,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Pendaftaran berhasil ditambahkan');
    }

    public function show(Registration $registration)
    {
        return view('admin.registrations.show', compact('registration'));
    }

    public function edit(Registration $registration)
    {
        $patients = Patient::all();
        return view('admin.registrations.edit', compact('registration', 'patients'));
    }

    public function update(Request $request, Registration $registration)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'registration_date' => 'required|date',
            'complaint' => 'required',
            'service_type' => 'required|in:umum,kia,rawat_inap,ugd',
            'status' => 'required|in:pending,processed,completed',
        ]);

        $registration->update($request->all());

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Pendaftaran berhasil diperbarui');
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Pendaftaran berhasil dihapus');
    }
}