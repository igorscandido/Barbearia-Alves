<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = auth()->user();
        if ($user->isBarbeiro() || $user->isAdmin()) {
            $clients = User::where('role', 'cliente')
                ->when($search, function($query, $search) {
                    return $query->where('name', 'like', "%$search%");
                })
                ->orderBy('name')
                ->get();
        }
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'telefone' => 'required',
            'password' => 'required|min:6',
        ]);
        User::create([
            'name' => $request->name,
            'telefone' => $request->telefone,
            'role' => 'cliente',
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('barbeiro.clients.index')->with('success', 'Cliente cadastrado com sucesso!');
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
    public function edit(User $user)
    {
        return view('clients.edit', ['client' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'telefone' => 'required',
        ]);
        $user->update($request->only('name', 'telefone'));
        return redirect()->route('barbeiro.clients.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('barbeiro.clients.index')->with('success', 'Cliente removido com sucesso!');
    }
}
