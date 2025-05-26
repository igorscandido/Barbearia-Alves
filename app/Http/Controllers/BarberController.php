<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;

class BarberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $barbers = Barber::when($search, function($query, $search) {
            return $query->where('nome', 'like', "%$search%");
        })->orderBy('nome')->get();
        return view('barbers.index', compact('barbers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barbers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
        ]);
        Barber::create($request->only('nome'));
        return redirect()->route('barbers.index')->with('success', 'Barbeiro cadastrado com sucesso!');
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
    public function edit(Barber $barber)
    {
        return view('barbers.edit', compact('barber'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barber $barber)
    {
        $request->validate([
            'nome' => 'required',
        ]);
        $barber->update($request->only('nome'));
        return redirect()->route('barbers.index')->with('success', 'Barbeiro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barber $barber)
    {
        $barber->delete();
        return redirect()->route('barbers.index')->with('success', 'Barbeiro removido com sucesso!');
    }
}
