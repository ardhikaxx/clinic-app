@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Farmasi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Farmasi</li>
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
                Daftar Resep Obat
            </div>
            <a href="{{ route('admin.pharmacy.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Tambah Resep
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
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pharmacies as $key => $pharmacy)
                        <tr>
                            <td>{{ $pharmacies->firstItem() + $key }}</td>
                            <td>{{ $pharmacy->registration->id }}</td>
                            <td>{{ $pharmacy->registration->patient->name }}</td>
                            <td>{{ $pharmacy->medicine_name }}</td>
                            <td>{{ $pharmacy->quantity }}</td>
                            <td>{{ $pharmacy->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.pharmacy.show', $pharmacy->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.pharmacy.edit', $pharmacy->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.pharmacy.destroy', $pharmacy->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus resep ini?')">
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
                {{ $pharmacies->links() }}
            </div>
        </div>
    </div>
</div>
@endsection