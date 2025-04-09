@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Detail Rekam Medis</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.medical-records.index') }}">Rekam Medis</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-file-medical mr-1"></i>
            Informasi Rekam Medis
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">No. RM</th>
                            <td>{{ $medicalRecord->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pasien</th>
                            <td>{{ $medicalRecord->patient->name }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $medicalRecord->patient->birth_date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $medicalRecord->patient->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">No. Pendaftaran</th>
                            <td>{{ $medicalRecord->registration->id }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pemeriksaan</th>
                            <td>{{ $medicalRecord->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Layanan</th>
                            <td>
                                @if($medicalRecord->registration->service_type == 'umum')
                                <span class="badge bg-primary">Poli Umum</span>
                                @elseif($medicalRecord->registration->service_type == 'kia')
                                <span class="badge bg-success">Poli KIA</span>
                                @elseif($medicalRecord->registration->service_type == 'rawat_inap')
                                <span class="badge bg-warning">Rawat Inap</span>
                                @else
                                <span class="badge bg-danger">UGD</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($medicalRecord->registration->status == 'pending')
                                <span class="badge bg-secondary">Menunggu</span>
                                @elseif($medicalRecord->registration->status == 'processed')
                                <span class="badge bg-info">Diproses</span>
                                @else
                                <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <th width="20%">Diagnosis</th>
                            <td>{{ $medicalRecord->diagnosis }}</td>
                        </tr>
                        <tr>
                            <th>Perawatan</th>
                            <td>{{ $medicalRecord->treatment }}</td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td>{{ $medicalRecord->notes ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('admin.medical-records.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection