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
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Daftar</th>
                            <th>Keluhan</th>
                            <th>Layanan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $registration)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $registration->id }}</td>
                            <td>{{ $registration->patient->name }}</td>
                            <td>{{ $registration->registration_date->format('d/m/Y') }}</td>
                            <td>{{ $registration->complaint }}</td>
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