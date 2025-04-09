@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Pembayaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pembayaran</li>
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
                Daftar Pembayaran
            </div>
            <a href="{{ route('admin.payments.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Tambah Pembayaran
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
                            <th>Jumlah</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $key => $payment)
                        <tr>
                            <td>{{ $payments->firstItem() + $key }}</td>
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
                            <td>
                                <a href="{{ route('admin.payments.show', $payment->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?')">
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
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection