@extends('layouts.app')

@section('content')
<h2>Tipos de Procedimento</h2>
<a href="{{ route('barbeiro.procedure-types.create') }}" class="btn" style="margin-bottom:1rem;"><i class="fa fa-plus"></i> Novo Tipo</a>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Valor</th>
            <th>Barbeiro</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($procedureTypes as $type)
        <tr>
            <td>{{ $type->nome }}</td>
            <td>R$ {{ number_format($type->valor, 2, ',', '.') }}</td>
            <td>{{ $type->barber->name ?? '-' }}</td>
            <td>
                <a href="{{ route('barbeiro.procedure-types.edit', $type) }}" title="Editar"><i class="fa fa-edit"></i></a>
                <form action="{{ route('barbeiro.procedure-types.destroy', $type) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none;border:none;color:#fff;cursor:pointer" title="Excluir"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="4">Nenhum tipo de procedimento cadastrado.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection 