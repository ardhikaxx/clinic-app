@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">{{ isset($registration) ? 'Edit' : 'Tambah' }} Pendaftaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.registrations.index') }}">Pendaftaran</a></li>
        <li class="breadcrumb-item active">{{ isset($registration) ? 'Edit' : 'Tambah' }}</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-clipboard-list mr-1"></i>
            Form {{ isset($registration) ? 'Edit' : 'Tambah' }} Pendaftaran
        </div>
        <div class="card-body">
            <form action="{{ isset($registration) ? route('admin.registrations.update', $registration->id) : route('admin.registrations.store') }}" method="POST">
                @csrf
                @if(isset($registration))
                @method('PUT')
                @endif
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="patient_id" class="form-label">Pasien <span class="text-danger">*</span></label>
                        <select class="form-select @error('patient_id') is-invalid @enderror" id="patient_id" name="patient_id" required>
                            <option value="">Pilih Pasien</option>
                            @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ old('patient_id', $registration->patient_id ?? '') == $patient->id ? 'selected' : '' }}>
                                {{ $patient->name }} ({{ $patient->nik }})
                            </option>
                            @endforeach
                        </select>
                        @error('patient_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="registration_date" class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('registration_date') is-invalid @enderror" id="registration_date" name="registration_date" 
                            value="{{ old('registration_date', isset($registration) ? $registration->registration_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
                        @error('registration_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="complaint" class="form-label">Keluhan <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('complaint') is-invalid @enderror" id="complaint" name="complaint" rows="3" required>{{ old('complaint', $registration->complaint ?? '') }}</textarea>
                    @error('complaint')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="service_type" class="form-label">Jenis Layanan <span class="text-danger">*</span></label>
                        <select class="form-select @error('service_type') is-invalid @enderror" id="service_type" name="service_type" required>
                            <option value="">Pilih Layanan</option>
                            <option value="umum" {{ old('service_type', $registration->service_type ?? '') == 'umum' ? 'selected' : '' }}>Poli Umum</option>
                            <option value="kia" {{ old('service_type', $registration->service_type ?? '') == 'kia' ? 'selected' : '' }}>Poli KIA</option>
                            <option value="rawat_inap" {{ old('service_type', $registration->service_type ?? '') == 'rawat_inap' ? 'selected' : '' }}>Rawat Inap</option>
                            <option value="ugd" {{ old('service_type', $registration->service_type ?? '') == 'ugd' ? 'selected' : '' }}>UGD</option>
                        </select>
                        @error('service_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if(isset($registration))
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="pending" {{ old('status', $registration->status ?? '') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="processed" {{ old('status', $registration->status ?? '') == 'processed' ? 'selected' : '' }}>Diproses</option>
                            <option value="completed" {{ old('status', $registration->status ?? '') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection