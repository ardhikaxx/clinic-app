@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Pendaftaran Pasien</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pendaftaran</li>
    </ol>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table mr-1"></i>
                Daftar Pendaftaran
            </div>
            <a href="{{ route('admin.registrations.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Tambah Pendaftaran
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Daftar</th>
                            <th>Keluhan</th>
                            <th>Layanan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $key => $registration)
                        <tr>
                            <td>{{ $registrations->firstItem() + $key }}</td>
                            <td>{{ $registration->id }}</td>
                            <td>{{ $registration->patient->name }}</td>
                            <td>{{ $registration->registration_date->format('d/m/Y') }}</td>
                            <td>{{ Str::limit($registration->complaint, 30) }}</td>
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
                                <a href="{{ route('admin.registrations.edit', $registration->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.registrations.destroy', $registration->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pendaftaran ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $registrations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection