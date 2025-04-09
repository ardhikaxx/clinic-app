@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">{{ isset($pharmacy) ? 'Edit' : 'Tambah' }} Resep Obat</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.pharmacy.index') }}">Farmasi</a></li>
        <li class="breadcrumb-item active">{{ isset($pharmacy) ? 'Edit' : 'Tambah' }}</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-pills mr-1"></i>
            Form {{ isset($pharmacy) ? 'Edit' : 'Tambah' }} Resep
        </div>
        <div class="card-body">
            <form action="{{ isset($pharmacy) ? route('admin.pharmacy.update', $pharmacy->id) : route('admin.pharmacy.store') }}" method="POST">
                @csrf
                @if(isset($pharmacy))
                @method('PUT')
                @endif
                
                <div class="mb-3">
                    <label for="registration_id" class="form-label">Pendaftaran <span class="text-danger">*</span></label>
                    <select class="form-select @error('registration_id') is-invalid @enderror" id="registration_id" name="registration_id" required>
                        <option value="">Pilih Pendaftaran</option>
                        @foreach($registrations as $registration)
                        <option value="{{ $registration->id }}" {{ old('registration_id', $pharmacy->registration_id ?? '') == $registration->id ? 'selected' : '' }}>
                            {{ $registration->id }} - {{ $registration->patient->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('registration_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="medicine_name" class="form-label">Nama Obat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('medicine_name') is-invalid @enderror" id="medicine_name" name="medicine_name" 
                            value="{{ old('medicine_name', $pharmacy->medicine_name ?? '') }}" required>
                        @error('medicine_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="quantity" class="form-label">Jumlah <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" 
                            value="{{ old('quantity', $pharmacy->quantity ?? '') }}" min="1" required>
                        @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="instructions" class="form-label">Petunjuk Penggunaan <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('instructions') is-invalid @enderror" id="instructions" name="instructions" rows="3" required>{{ old('instructions', $pharmacy->instructions ?? '') }}</textarea>
                    @error('instructions')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.pharmacy.index') }}" class="btn btn-secondary">
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