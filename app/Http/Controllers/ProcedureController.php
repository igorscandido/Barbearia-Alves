<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procedure;
use App\Models\Client;
use App\Models\Barber;
use App\Models\User;
use App\Models\ProcedureType;

class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = $request->input('data');
        $query = Procedure::with(['client', 'barber']);
        
        // Se for cliente, filtra apenas os agendamentos do próprio usuário
        if (auth()->user()->isCliente()) {
            $query->where('client_id', auth()->id());
        }
        
        $procedures = $query
            ->when($search, function($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->whereHas('client', function($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    })
                    ->orWhere('tipo', 'like', "%$search%");
                });
            })
            ->when($data, function($query, $data) {
                $query->whereDate('data', $data);
            })
            ->orderBy('data', 'desc')
            ->get();
        return view('procedures.index', compact('procedures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->isCliente()) {
            $clients = collect([auth()->user()]);
            $barbers = \App\Models\User::where('role', 'barbeiro')->orderBy('name')->get();
            $procedureTypes = \App\Models\ProcedureType::with('barber')->orderBy('nome')->get();
        } else {
            $clients = \App\Models\User::where('role', 'cliente')->orderBy('name')->get();
            $barbers = \App\Models\User::where('role', 'barbeiro')->orderBy('name')->get();
            $procedureTypes = \App\Models\ProcedureType::with('barber')->orderBy('nome')->get();
        }
        return view('procedures.create', compact('clients', 'barbers', 'procedureTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required',
            'client_id' => 'required|exists:users,id',
            'barber_id' => 'required|exists:users,id',
            'procedure_type_id' => 'required|exists:procedure_types,id',
            'status' => 'required',
        ]);
        $procedureType = \App\Models\ProcedureType::findOrFail($request->procedure_type_id);
        $data = $request->only('data', 'client_id', 'barber_id', 'status');
        $data['tipo'] = $procedureType->nome;
        $data['valor'] = $procedureType->valor;
        $data['procedure_type_id'] = $procedureType->id;
        if (auth()->user()->isCliente()) {
            $data['status'] = 'Agendado';
        }
        Procedure::create($data);
        $routePrefix = auth()->user()->isCliente() ? 'cliente' : 'barbeiro';
        return redirect()->route($routePrefix.'.procedures.index')->with('success', 'Agendamento cadastrado com sucesso!');
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
    public function edit(Procedure $procedure)
    {
        if (auth()->user()->isCliente()) {
            $clients = collect([auth()->user()]);
            $barbers = \App\Models\User::where('role', 'barbeiro')->orderBy('name')->get();
            $procedureTypes = \App\Models\ProcedureType::with('barber')->orderBy('nome')->get();
        } else {
            $clients = \App\Models\Client::orderBy('nome')->get();
            $barbers = \App\Models\User::where('role', 'barbeiro')->orderBy('name')->get();
            $procedureTypes = \App\Models\ProcedureType::with('barber')->orderBy('nome')->get();
        }
        return view('procedures.edit', compact('procedure', 'clients', 'barbers', 'procedureTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Procedure $procedure)
    {
        $request->validate([
            'data' => 'required',
            'client_id' => 'required|exists:users,id',
            'barber_id' => 'required|exists:users,id',
            'procedure_type_id' => 'required|exists:procedure_types,id',
            'status' => 'required',
        ]);
        $procedureType = \App\Models\ProcedureType::findOrFail($request->procedure_type_id);
        $data = $request->only('data', 'client_id', 'barber_id', 'status');
        $data['tipo'] = $procedureType->nome;
        $data['valor'] = $procedureType->valor;
        $data['procedure_type_id'] = $procedureType->id;
        if (auth()->user()->isCliente()) {
            $data['status'] = $procedure->status; // Cliente não pode alterar status
        }
        $procedure->update($data);
        $routePrefix = auth()->user()->isCliente() ? 'cliente' : 'barbeiro';
        return redirect()->route($routePrefix.'.procedures.index')->with('success', 'Agendamento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Procedure $procedure)
    {
        $procedure->delete();
        $routePrefix = auth()->user()->isCliente() ? 'cliente' : 'barbeiro';
        return redirect()->route($routePrefix.'.procedures.index')->with('success', 'Agendamento removido com sucesso!');
    }
}
