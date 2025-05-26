@extends('layouts.app')

@section('content')
<div style="max-width:400px;margin:40px auto;background:#232323;padding:2rem 2.5rem;border-radius:8px;box-shadow:0 2px 8px #0008;">
    <h2 style="text-align:center;margin-bottom:1.5rem;">Criar nova conta</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nome completo</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Digite seu nome">
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input id="telefone" type="text" name="telefone" value="{{ old('telefone') }}" required placeholder="Digite seu telefone">
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input id="password" type="password" name="password" required placeholder="Digite uma senha">
        </div>
        <div class="form-group">
            <label for="password-confirm">Confirmar Senha</label>
            <input id="password-confirm" type="password" name="password_confirmation" required placeholder="Confirme sua senha">
        </div>
        <button type="submit" class="btn" style="width:100%;margin-bottom:1rem;">Registrar</button>
        <div style="text-align:center;">
            <a href="{{ route('login') }}" style="color:#fff;text-decoration:underline;">Já tenho conta</a>
        </div>
    </form>
</div>
@endsection
