@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Detail Pasien</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.patients.index') }}">Pasien</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-injured mr-1"></i>
            Informasi Pasien
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">NIK</th>
                            <td>{{ $patient->nik }}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{ $patient->name }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $patient->birth_date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Usia</th>
                            <td>{{ $patient->birth_date->age }} tahun</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $patient->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Alamat</th>
                            <td>{{ $patient->address }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>{{ $patient->phone }}</td>
                        </tr>
                        <tr>
                            <th>No. BPJS</th>
                            <td>{{ $patient->bpjs_number ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Daftar</th>
                            <td>{{ $patient->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Diupdate</th>
                            <td>{{ $patient->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('admin.patients.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
                <div>
                    <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pasien ini?')">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Riwayat Pendaftaran -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-clipboard-list mr-1"></i>
            Riwayat Pendaftaran
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Keluhan</th>
                            <th>Layanan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patient->registrations as $registration)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $registration->registration_date->format('d/m/Y') }}</td>
                            <td>{{ Str::limit($registration->complaint, 50) }}</td>
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
                            <td>
                                @if($registration->status == 'pending')
                                <span class="badge bg-secondary">Menunggu</span>
                                @elseif($registration->status == 'processed')
                                <span class="badge bg-info">Diproses</span>
                                @else
                                <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.registrations.show', $registration->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada riwayat pendaftaran</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection