@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Detail Pendaftaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.registrations.index') }}">Pendaftaran</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-clipboard-list mr-1"></i>
            Informasi Pendaftaran
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">No. RM</th>
                            <td>{{ $registration->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pasien</th>
                            <td>{{ $registration->patient->name }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>{{ $registration->patient->nik }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $registration->patient->birth_date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $registration->patient->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Tanggal Daftar</th>
                            <td>{{ $registration->registration_date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Keluhan</th>
                            <td>{{ $registration->complaint }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Layanan</th>
                            <td>
                                @if($registration->service_type == 'umum')
                                <span class="badge bg-primary">Poli Umum</span>
                                @elseif($registration->service_type == 'kia')
                                <span class="badge bg-success">Poli KIA</span>
                                @elseif($registration->service_type == 'rawat_inap')
                                <span class="badge bg-warning">Rawat Inap</span>
                                @else
                                <span class="badge bg-danger">UGD</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($registration->status == 'pending')
                                <span class="badge bg-secondary">Menunggu</span>
                                @elseif($registration->status == 'processed')
                                <span class="badge bg-info">Diproses</span>
                                @else
                                <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Dibuat</th>
                            <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
                <div>
                    <a href="{{ route('admin.registrations.edit', $registration->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.registrations.destroy', $registration->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pendaftaran ini?')">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Riwayat Pemeriksaan -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-stethoscope mr-1"></i>
            Riwayat Pemeriksaan
        </div>
        <div class="card-body">
            @if($registration->service_type == 'umum' && $registration->general)
            <div class="mb-4">
                <h5>Poli Umum</h5>
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Diagnosis</th>
                        <td>{{ $registration->general->diagnosis }}</td>
                    </tr>
                    <tr>
                        <th>Perawatan</th>
                        <td>{{ $registration->general->treatment }}</td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td>{{ $registration->general->notes ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Dokter</th>
                        <td>{{ $registration->general->doctor->name }}</td>
                    </tr>
                </table>
            </div>
            @elseif($registration->service_type == 'kia' && $registration->kia)
            <div class="mb-4">
                <h5>Poli KIA</h5>
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Diagnosis</th>
                        <td>{{ $registration->kia->diagnosis }}</td>
                    </tr>
                    <tr>
                        <th>Perawatan</th>
                        <td>{{ $registration->kia->treatment }}</td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td>{{ $registration->kia->notes ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Dokter</th>
                        <td>{{ $registration->kia->doctor->name }}</td>
                    </tr>
                </table>
            </div>
            @elseif($registration->service_type == 'rawat_inap' && $registration->inpatient)
            <div class="mb-4">
                <h5>Rawat Inap</h5>
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Diagnosis</th>
                        <td>{{ $registration->inpatient->diagnosis }}</td>
                    </tr>
                    <tr>
                        <th>Perawatan</th>
                        <td>{{ $registration->inpatient->treatment }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>{{ $registration->inpatient->check_in_date->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Keluar</th>
                        <td>{{ $registration->inpatient->check_out_date ? $registration->inpatient->check_out_date->format('d/m/Y') : 'Masih dirawat' }}</td>
                    </tr>
                    <tr>
                        <th>Dokter</th>
                        <td>{{ $registration->inpatient->doctor->name }}</td>
                    </tr>
                </table>
            </div>
            @elseif($registration->service_type == 'ugd' && $registration->emergency)
            <div class="mb-4">
                <h5>UGD</h5>
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Diagnosis</th>
                        <td>{{ $registration->emergency->diagnosis }}</td>
                    </tr>
                    <tr>
                        <th>Perawatan</th>
                        <td>{{ $registration->emergency->treatment }}</td>
                    </tr>
                    <tr>
                        <th>Tingkat Keparahan</th>
                        <td>
                            @if($registration->emergency->severity == 'low')
                            <span class="badge bg-success">Rendah</span>
                            @elseif($registration->emergency->severity == 'medium')
                            <span class="badge bg-warning">Sedang</span>
                            @else
                            <span class="badge bg-danger">Tinggi</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Dokter</th>
                        <td>{{ $registration->emergency->doctor->name }}</td>
                    </tr>
                </table>
            </div>
            @else
            <div class="alert alert-info">
                Belum ada data pemeriksaan untuk pendaftaran ini.
            </div>
            @endif
        </div>
    </div>
    
    <!-- Resep Obat -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-pills mr-1"></i>
            Resep Obat
        </div>
        <div class="card-body">
            @if($registration->pharmacy->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                            <th>Petunjuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registration->pharmacy as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->medicine_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->instructions }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-info">
                Belum ada resep obat untuk pendaftaran ini.
            </div>
            @endif
        </div>
    </div>
    
    <!-- Pembayaran -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-money-bill-wave mr-1"></i>
            Informasi Pembayaran
        </div>
        <div class="card-body">
            @if($registration->payment)
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Jumlah Pembayaran</th>
                    <td>Rp {{ number_format($registration->payment->amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>
                        @if($registration->payment->payment_method == 'cash')
                        Tunai
                        @elseif($registration->payment->payment_method == 'bpjs')
                        BPJS
                        @else
                        Kartu Kredit
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($registration->payment->status == 'pending')
                        <span class="badge bg-secondary">Menunggu</span>
                        @elseif($registration->payment->status == 'paid')
                        <span class="badge bg-success">Lunas</span>
                        @else
                        <span class="badge bg-danger">Gagal</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Pembayaran</th>
                    <td>{{ $registration->payment->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
            @else
            <div class="alert alert-info">
                Belum ada data pembayaran untuk pendaftaran ini.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection