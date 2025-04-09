@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Rekam Medis</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Rekam Medis</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Daftar Rekam Medis
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal</th>
                            <th>Diagnosis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($medicalRecords as $key => $medicalRecord)
                        <tr>
                            <td>{{ $medicalRecords->firstItem() + $key }}</td>
                            <td>{{ $medicalRecord->id }}</td>
                            <td>{{ $medicalRecord->patient->name }}</td>
                            <td>{{ $medicalRecord->created_at->format('d/m/Y') }}</td>
                            <td>{{ Str::limit($medicalRecord->diagnosis, 50) }}</td>
                            <td>
                                <a href="{{ route('admin.medical-records.show', $medicalRecord->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $medicalRecords->links() }}
            </div>
        </div>
    </div>
</div>
@endsection