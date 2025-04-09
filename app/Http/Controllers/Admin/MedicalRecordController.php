<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $medicalRecords = MedicalRecord::with(['patient', 'registration'])->latest()->paginate(10);
        return view('admin.medical_records.index', compact('medicalRecords'));
    }

    public function show(MedicalRecord $medicalRecord)
    {
        return view('admin.medical_records.show', compact('medicalRecord'));
    }
}