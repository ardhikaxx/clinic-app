@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Detail Pemeriksaan Poli Umum</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.examinations.general.index') }}">Poli Umum</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-md mr-1"></i>
            Informasi Pemeriksaan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">No. RM</th>
                            <td>{{ $general->registration->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pasien</th>
                            <td>{{ $general->registration->patient->name }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $general->registration->patient->birth_date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $general->registration->patient->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Tanggal Pemeriksaan</th>
                            <td>{{ $general->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Dokter</th>
                            <td>{{ $general->doctor->name }}</td>
                        </tr>
                        <tr>
                            <th>Keluhan</th>
                            <td>{{ $general->registration->complaint }}</td>
                        </tr>
                        <tr>
                            <th>Status Pendaftaran</th>
                            <td>
                                @if($general->registration->status == 'pending')
                                <span class="badge bg-secondary">Menunggu</span>
                                @elseif($general->registration->status == 'processed')
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
                            <td>{{ $general->diagnosis }}</td>
                        </tr>
                        <tr>
                            <th>Perawatan</th>
                            <td>{{ $general->treatment }}</td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td>{{ $general->notes ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('admin.examinations.general.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
                <div>
                    <a href="{{ route('admin.examinations.general.edit', $general->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.examinations.general.destroy', $general->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pemeriksaan ini?')">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection