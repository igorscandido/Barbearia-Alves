<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcedureTypeController extends Controller
{
    public function index()
    {
        $procedureTypes = \App\Models\ProcedureType::orderBy('nome')->get();
        return view('procedure_types.index', compact('procedureTypes'));
    }

    public function create()
    {
        return view('procedure_types.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required',
            'valor' => 'required|numeric',
            'barber_id' => 'nullable|exists:users,id',
        ]);
        \App\Models\ProcedureType::create($data);
        return redirect()->route('barbeiro.procedure-types.index')->with('success', 'Tipo de procedimento cadastrado com sucesso!');
    }

    public function edit(\App\Models\ProcedureType $procedureType)
    {
        return view('procedure_types.edit', compact('procedureType'));
    }

    public function update(Request $request, \App\Models\ProcedureType $procedureType)
    {
        $data = $request->validate([
            'nome' => 'required',
            'valor' => 'required|numeric',
            'barber_id' => 'nullable|exists:users,id',
        ]);
        $procedureType->update($data);
        return redirect()->route('barbeiro.procedure-types.index')->with('success', 'Tipo de procedimento atualizado com sucesso!');
    }

    public function destroy(\App\Models\ProcedureType $procedureType)
    {
        $procedureType->delete();
        return back()->with('success', 'Tipo de procedimento removido com sucesso!');
    }
}
