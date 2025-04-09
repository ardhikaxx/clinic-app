@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h3>{{ $title }}</h3>
        <div>
            <small class="text-muted">Periode: {{ $start_date }} - {{ $end_date }}</small>
            <button onclick="window.print()" class="btn btn-sm btn-primary ms-2">
                <i class="fas fa-print"></i> Cetak
            </button>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>No. Telepon</th>
                            <th>BPJS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $patient)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $patient->nik }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->birth_date->format('d/m/Y') }}</td>
                            <td>{{ $patient->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $patient->address }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->bpjs_number ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .card, .card * {
            visibility: visible;
        }
        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none;
        }
    }
</style>
@endsection