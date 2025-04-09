<?php

namespace App\Http\Controllers\Admin\Examination;

use App\Http\Controllers\Controller;
use App\Models\Examination\General;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index()
    {
        $generals = General::with(['registration.patient', 'doctor'])->latest()->paginate(10);
        return view('admin.examinations.general.index', compact('generals'));
    }

    public function create()
    {
        $registrations = Registration::where('service_type', 'umum')
            ->where('status', '!=', 'completed')
            ->with('patient')
            ->get();
        $doctors = User::where('role', 'doctor')->get();
        return view('admin.examinations.general.create', compact('registrations', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'diagnosis' => 'required',
            'treatment' => 'required',
            'doctor_id' => 'required|exists:users,id',
            'notes' => 'nullable',
        ]);

        General::create($request->all());

        // Update registration status
        $registration = Registration::find($request->registration_id);
        $registration->update(['status' => 'processed']);

        return redirect()->route('admin.examinations.general.index')
            ->with('success', 'Pemeriksaan umum berhasil ditambahkan');
    }

    public function show(General $general)
    {
        return view('admin.examinations.general.show', compact('general'));
    }

    public function edit(General $general)
    {
        $registrations = Registration::where('service_type', 'umum')
            ->where('status', '!=', 'completed')
            ->with('patient')
            ->get();
        $doctors = User::where('role', 'doctor')->get();
        return view('admin.examinations.general.edit', compact('general', 'registrations', 'doctors'));
    }

    public function update(Request $request, General $general)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'diagnosis' => 'required',
            'treatment' => 'required',
            'doctor_id' => 'required|exists:users,id',
            'notes' => 'nullable',
        ]);

        $general->update($request->all());

        return redirect()->route('admin.examinations.general.index')
            ->with('success', 'Pemeriksaan umum berhasil diperbarui');
    }

    public function destroy(General $general)
    {
        $general->delete();

        return redirect()->route('admin.examinations.general.index')
            ->with('success', 'Pemeriksaan umum berhasil dihapus');
    }
}