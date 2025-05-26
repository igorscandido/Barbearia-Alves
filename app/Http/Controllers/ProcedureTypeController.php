<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcedureTypeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            $procedureTypes = \App\Models\ProcedureType::with('barber')->orderBy('nome')->get();
        } else {
            $procedureTypes = \App\Models\ProcedureType::where('barber_id', $user->id)->orderBy('nome')->get();
        }
        return view('procedure_types.index', compact('procedureTypes'));
    }

    public function create()
    {
        $barbers = [];
        if (auth()->user()->isAdmin()) {
            $barbers = \App\Models\User::where('role', 'barbeiro')->orderBy('name')->get();
        }
        return view('procedure_types.create', compact('barbers'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'nome' => 'required',
            'valor' => 'required|numeric',
            'barber_id' => 'nullable|exists:users,id',
        ]);
        if ($user->isBarbeiro()) {
            $data['barber_id'] = $user->id;
        }
        \App\Models\ProcedureType::create($data);
        return redirect()->route($user->isAdmin() ? 'barbeiro.procedure-types.index' : 'barbeiro.procedure-types.index')->with('success', 'Tipo de procedimento cadastrado com sucesso!');
    }

    public function edit(\App\Models\ProcedureType $procedureType)
    {
        $barbers = [];
        if (auth()->user()->isAdmin()) {
            $barbers = \App\Models\User::where('role', 'barbeiro')->orderBy('name')->get();
        }
        return view('procedure_types.edit', compact('procedureType', 'barbers'));
    }

    public function update(Request $request, \App\Models\ProcedureType $procedureType)
    {
        $user = auth()->user();
        $data = $request->validate([
            'nome' => 'required',
            'valor' => 'required|numeric',
            'barber_id' => 'nullable|exists:users,id',
        ]);
        if ($user->isBarbeiro()) {
            $data['barber_id'] = $user->id;
        }
        $procedureType->update($data);
        return redirect()->route($user->isAdmin() ? 'barbeiro.procedure-types.index' : 'barbeiro.procedure-types.index')->with('success', 'Tipo de procedimento atualizado com sucesso!');
    }

    public function destroy(\App\Models\ProcedureType $procedureType)
    {
        $procedureType->delete();
        return back()->with('success', 'Tipo de procedimento removido com sucesso!');
    }
}
