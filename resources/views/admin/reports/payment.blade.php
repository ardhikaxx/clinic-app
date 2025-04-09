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
                            <th>Jumlah</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $payment)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $payment->registration->id }}</td>
                            <td>{{ $payment->registration->patient->name }}</td>
                            <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td>
                                @if($payment->payment_method == 'cash')
                                <span class="badge bg-primary">Tunai</span>
                                @elseif($payment->payment_method == 'bpjs')
                                <span class="badge bg-success">BPJS</span>
                                @else
                                <span class="badge bg-info">Kartu Kredit</span>
                                @endif
                            </td>
                            <td>
                                @if($payment->status == 'pending')
                                <span class="badge bg-secondary">Menunggu</span>
                                @elseif($payment->status == 'paid')
                                <span class="badge bg-success">Lunas</span>
                                @else
                                <span class="badge bg-danger">Gagal</span>
                                @endif
                            </td>
                            <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                <h5>Total Pendapatan: Rp {{ number_format($data->sum('amount'), 0, ',', '.') }}</h5>
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