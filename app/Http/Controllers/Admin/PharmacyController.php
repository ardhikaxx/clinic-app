<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\Registration;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::with('registration.patient')->latest()->paginate(10);
        return view('admin.pharmacy.index', compact('pharmacies'));
    }

    public function create()
    {
        $registrations = Registration::where('status', 'processed')->with('patient')->get();
        return view('admin.pharmacy.create', compact('registrations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'medicine_name' => 'required',
            'quantity' => 'required|integer|min:1',
            'instructions' => 'required',
        ]);

        Pharmacy::create($request->all());

        return redirect()->route('admin.pharmacy.index')
            ->with('success', 'Resep obat berhasil ditambahkan');
    }

    public function show(Pharmacy $pharmacy)
    {
        return view('admin.pharmacy.show', compact('pharmacy'));
    }

    public function edit(Pharmacy $pharmacy)
    {
        $registrations = Registration::where('status', 'processed')->with('patient')->get();
        return view('admin.pharmacy.edit', compact('pharmacy', 'registrations'));
    }

    public function update(Request $request, Pharmacy $pharmacy)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'medicine_name' => 'required',
            'quantity' => 'required|integer|min:1',
            'instructions' => 'required',
        ]);

        $pharmacy->update($request->all());

        return redirect()->route('admin.pharmacy.index')
            ->with('success', 'Resep obat berhasil diperbarui');
    }

    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();

        return redirect()->route('admin.pharmacy.index')
            ->with('success', 'Resep obat berhasil dihapus');
    }
}