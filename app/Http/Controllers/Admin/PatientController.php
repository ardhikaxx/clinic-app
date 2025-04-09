<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::latest()->paginate(10);
        return view('admin.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('admin.patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:patients|digits:16',
            'name' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required',
            'phone' => 'required',
            'bpjs_number' => 'nullable|digits:13',
        ]);

        Patient::create($request->all());

        return redirect()->route('admin.patients.index')
            ->with('success', 'Pasien berhasil ditambahkan');
    }

    public function show(Patient $patient)
    {
        return view('admin.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'nik' => 'required|digits:16|unique:patients,nik,'.$patient->id,
            'name' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required',
            'phone' => 'required',
            'bpjs_number' => 'nullable|digits:13',
        ]);

        $patient->update($request->all());

        return redirect()->route('admin.patients.index')
            ->with('success', 'Data pasien berhasil diperbarui');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('admin.patients.index')
            ->with('success', 'Pasien berhasil dihapus');
    }
}