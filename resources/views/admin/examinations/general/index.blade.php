@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Pemeriksaan Poli Umum</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Pemeriksaan</a></li>
        <li class="breadcrumb-item active">Poli Umum</li>
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
                Daftar Pemeriksaan Poli Umum
            </div>
            <a href="{{ route('admin.examinations.general.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Tambah Pemeriksaan
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
                            <th>Diagnosis</th>
                            <th>Dokter</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($generals as $key => $general)
                        <tr>
                            <td>{{ $generals->firstItem() + $key }}</td>
                            <td>{{ $general->registration->id }}</td>
                            <td>{{ $general->registration->patient->name }}</td>
                            <td>{{ Str::limit($general->diagnosis, 30) }}</td>
                            <td>{{ $general->doctor->name }}</td>
                            <td>{{ $general->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.examinations.general.show', $general->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.examinations.general.edit', $general->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.examinations.general.destroy', $general->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pemeriksaan ini?')">
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
                {{ $generals->links() }}
            </div>
        </div>
    </div>
</div>
@endsection