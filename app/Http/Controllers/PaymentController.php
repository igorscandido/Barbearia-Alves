<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Procedure;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $payments = Payment::with(['procedure.client'])
            ->when($status, function($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $procedures = Procedure::with('client')->orderBy('data', 'desc')->get();
        return view('payments.create', compact('procedures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'procedure_id' => 'required|exists:procedures,id',
            'status' => 'required',
            'link' => 'nullable',
            'gerado_em' => 'nullable|date',
        ]);
        Payment::create($request->only('procedure_id', 'status', 'link', 'gerado_em'));
        return redirect()->route('payments.index')->with('success', 'Pagamento cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $procedures = Procedure::with('client')->orderBy('data', 'desc')->get();
        return view('payments.edit', compact('payment', 'procedures'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'procedure_id' => 'required|exists:procedures,id',
            'status' => 'required',
            'link' => 'nullable',
            'gerado_em' => 'nullable|date',
        ]);
        $payment->update($request->only('procedure_id', 'status', 'link', 'gerado_em'));
        return redirect()->route('payments.index')->with('success', 'Pagamento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Pagamento removido com sucesso!');
    }
}
