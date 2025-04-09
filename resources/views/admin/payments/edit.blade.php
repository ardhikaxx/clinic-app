@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">{{ isset($payment) ? 'Edit' : 'Tambah' }} Pembayaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.payments.index') }}">Pembayaran</a></li>
        <li class="breadcrumb-item active">{{ isset($payment) ? 'Edit' : 'Tambah' }}</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-money-bill-wave mr-1"></i>
            Form {{ isset($payment) ? 'Edit' : 'Tambah' }} Pembayaran
        </div>
        <div class="card-body">
            <form action="{{ isset($payment) ? route('admin.payments.update', $payment->id) : route('admin.payments.store') }}" method="POST">
                @csrf
                @if(isset($payment))
                @method('PUT')
                @endif
                
                <div class="mb-3">
                    <label for="registration_id" class="form-label">Pendaftaran <span class="text-danger">*</span></label>
                    <select class="form-select @error('registration_id') is-invalid @enderror" id="registration_id" name="registration_id" required>
                        <option value="">Pilih Pendaftaran</option>
                        @foreach($registrations as $registration)
                        <option value="{{ $registration->id }}" {{ old('registration_id', $payment->registration_id ?? '') == $registration->id ? 'selected' : '' }}>
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
                        <label for="amount" class="form-label">Jumlah Pembayaran (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" 
                            value="{{ old('amount', $payment->amount ?? '') }}" min="0" required>
                        @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="payment_method" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                        <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                            <option value="">Pilih Metode</option>
                            <option value="cash" {{ old('payment_method', $payment->payment_method ?? '') == 'cash' ? 'selected' : '' }}>Tunai</option>
                            <option value="bpjs" {{ old('payment_method', $payment->payment_method ?? '') == 'bpjs' ? 'selected' : '' }}>BPJS</option>
                            <option value="credit_card" {{ old('payment_method', $payment->payment_method ?? '') == 'credit_card' ? 'selected' : '' }}>Kartu Kredit</option>
                        </select>
                        @error('payment_method')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="pending" {{ old('status', $payment->status ?? '') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="paid" {{ old('status', $payment->status ?? '') == 'paid' ? 'selected' : '' }}>Lunas</option>
                        <option value="failed" {{ old('status', $payment->status ?? '') == 'failed' ? 'selected' : '' }}>Gagal</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
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