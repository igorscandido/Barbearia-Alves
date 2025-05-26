@extends('layouts.app')

@section('content')
<div style="max-width:400px;margin:40px auto;background:#232323;padding:2rem 2.5rem;border-radius:8px;box-shadow:0 2px 8px #0008;">
    <h2 style="text-align:center;margin-bottom:1.5rem;">Entrar no sistema</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="role">Entrar como</label>
            <select id="role" name="role" onchange="updateLoginLabel()" required>
                <option value="cliente" {{ request('role') === 'cliente' ? 'selected' : '' }}>Cliente</option>
                <option value="barbeiro" {{ request('role') === 'barbeiro' ? 'selected' : '' }}>Barbeiro</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Administrador</option>
            </select>
        </div>
        <div class="form-group">
            <label for="login" id="login-label">
                @if(request('role') === 'cliente') Telefone @else E-mail @endif
            </label>
            <input id="login" type="text" name="login" value="{{ old('login') }}" required autofocus placeholder="@if(request('role') === 'cliente') Digite seu telefone @else Digite seu e-mail @endif">
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input id="password" type="password" name="password" required placeholder="Digite sua senha">
        </div>
        <div class="form-group" style="margin-bottom:0.5rem; display:flex; align-items:center; gap:8px; white-space:nowrap;">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="margin:0;">
            <label for="remember" style="display:inline; margin:0; white-space:nowrap;">Manter-me conectado</label>
        </div>
        <button type="submit" class="btn" style="width:100%;margin-bottom:1rem;">Entrar</button>
        <div style="text-align:center;">
            <a href="{{ route('register') }}" style="color:#fff;text-decoration:underline;">Não tem conta? Cadastre-se</a>
        </div>
        <div style="text-align:center;margin-top:0.5rem;">
            <a href="{{ route('password.request') }}" style="color:#fff;text-decoration:underline;">Esqueci minha senha</a>
        </div>
    </form>
</div>
<script>
function updateLoginLabel() {
    var role = document.getElementById('role').value;
    var label = document.getElementById('login-label');
    var input = document.getElementById('login');
    if (role === 'cliente') {
        label.textContent = 'Telefone';
        input.placeholder = 'Digite seu telefone';
        input.type = 'text';
    } else {
        label.textContent = 'E-mail';
        input.placeholder = 'Digite seu e-mail';
        input.type = 'email';
    }
}
document.addEventListener('DOMContentLoaded', updateLoginLabel);
document.getElementById('role').addEventListener('change', updateLoginLabel);
</script>
@endsection
