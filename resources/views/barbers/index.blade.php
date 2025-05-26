@extends('layouts.app')

@section('content')
<h2>Barbeiros</h2>
<form method="GET" action="{{ route('barbers.index') }}" style="margin-bottom: 1rem; display: flex; gap: 1rem; align-items: center;">
    <input type="text" name="search" placeholder="Buscar pelo nome..." value="{{ request('search') }}">
    <button type="submit" class="btn"><i class="fa fa-search"></i> Buscar</button>
    <a href="{{ route('barbers.create') }}" class="btn"><i class="fa fa-plus"></i> Novo Barbeiro</a>
</form>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($barbers as $barber)
        <tr>
            <td>{{ $barber->nome }}</td>
            <td>
                <a href="{{ route('barbers.edit', $barber) }}" title="Editar"><i class="fa fa-edit"></i></a>
                <form action="{{ route('barbers.destroy', $barber) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none;border:none;color:#fff;cursor:pointer" title="Excluir"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="2">Nenhum barbeiro encontrado.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection 