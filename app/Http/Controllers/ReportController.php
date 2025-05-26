<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->input('data');
        $tipo = $request->input('tipo');
        $reports = Report::when($data, function($query, $data) {
                $query->whereDate('data_da', $data);
            })
            ->when($tipo, function($query, $tipo) {
                $query->where('nome', 'like', "%$tipo%");
            })
            ->orderBy('data_da', 'desc')
            ->get();
        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'data_da' => 'required|date',
            'semana' => 'required',
            'nome' => 'required',
            'tipo' => 'required',
        ]);
        Report::create([
            'data_da' => $request->data_da,
            'semana' => $request->semana,
            'nome' => $request->nome . ' (' . $request->tipo . ')',
        ]);
        return redirect()->route('reports.index')->with('success', 'Relatório gerado com sucesso!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
