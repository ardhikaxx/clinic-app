<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('registration.patient')->latest()->paginate(10);
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $registrations = Registration::where('status', 'processed')->with('patient')->get();
        return view('admin.payments.create', compact('registrations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,bpjs,credit_card',
            'status' => 'required|in:pending,paid,failed',
        ]);

        $payment = Payment::create($request->all());

        // Update registration status if payment is paid
        if ($payment->status == 'paid') {
            $registration = Registration::find($request->registration_id);
            $registration->update(['status' => 'completed']);
        }

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil ditambahkan');
    }

    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $registrations = Registration::where('status', 'processed')->with('patient')->get();
        return view('admin.payments.edit', compact('payment', 'registrations'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,bpjs,credit_card',
            'status' => 'required|in:pending,paid,failed',
        ]);

        $payment->update($request->all());

        // Update registration status if payment is paid
        if ($payment->status == 'paid') {
            $registration = Registration::find($request->registration_id);
            $registration->update(['status' => 'completed']);
        }

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil diperbarui');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil dihapus');
    }
}