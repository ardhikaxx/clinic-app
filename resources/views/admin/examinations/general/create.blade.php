@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">{{ isset($general) ? 'Edit' : 'Tambah' }} Pemeriksaan Poli Umum</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.examinations.general.index') }}">Poli Umum</a></li>
        <li class="breadcrumb-item active">{{ isset($general) ? 'Edit' : 'Tambah' }}</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-md mr-1"></i>
            Form {{ isset($general) ? 'Edit' : 'Tambah' }} Pemeriksaan
        </div>
        <div class="card-body">
            <form action="{{ isset($general) ? route('admin.examinations.general.update', $general->id) : route('admin.examinations.general.store') }}" method="POST">
                @csrf
                @if(isset($general))
                @method('PUT')
                @endif
                
                <div class="mb-3">
                    <label for="registration_id" class="form-label">Pendaftaran <span class="text-danger">*</span></label>
                    <select class="form-select @error('registration_id') is-invalid @enderror" id="registration_id" name="registration_id" required>
                        <option value="">Pilih Pendaftaran</option>
                        @foreach($registrations as $registration)
                        <option value="{{ $registration->id }}" {{ old('registration_id', $general->registration_id ?? '') == $registration->id ? 'selected' : '' }}>
                            {{ $registration->id }} - {{ $registration->patient->name }} ({{ $registration->complaint }})
                        </option>
                        @endforeach
                    </select>
                    @error('registration_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="diagnosis" class="form-label">Diagnosis <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('diagnosis') is-invalid @enderror" id="diagnosis" name="diagnosis" rows="3" required>{{ old('diagnosis', $general->diagnosis ?? '') }}</textarea>
                    @error('diagnosis')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="treatment" class="form-label">Perawatan <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('treatment') is-invalid @enderror" id="treatment" name="treatment" rows="3" required>{{ old('treatment', $general->treatment ?? '') }}</textarea>
                    @error('treatment')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="doctor_id" class="form-label">Dokter <span class="text-danger">*</span></label>
                        <select class="form-select @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id" required>
                            <option value="">Pilih Dokter</option>
                            @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('doctor_id', $general->doctor_id ?? '') == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="notes" class="form-label">Catatan Tambahan</label>
                        <input type="text" class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" 
                            value="{{ old('notes', $general->notes ?? '') }}">
                        @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.examinations.general.index') }}" class="btn btn-secondary">
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