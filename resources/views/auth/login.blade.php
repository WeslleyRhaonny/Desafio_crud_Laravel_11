@extends('auth.template')

@section('styles')
@endsection

@section('main')
<form id="formAuthentication" class="mb-3" action="{{ route('login.post') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Entre com seu email" autofocus />
    </div>
    <div class="mb-3 form-password-toggle">
        <div class="form-password-toggle">
            <label class="form-label" for="password">Senha</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" name="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer" id="toggle-password">
                    <i class="ti ti-eye-off" id="toggle-icon"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember_me" name="remember_me" />
            <label class="form-check-label" for="remember_me"> Lembre de mim </label>
        </div>
    </div>

    <button class="btn btn-primary d-grid w-100">Entrar</button>
</form>
@endsection

@section('scripts')
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggle-icon');

        if (togglePassword && passwordInput && toggleIcon) {
            togglePassword.addEventListener('click', function () {
                const isPasswordHidden = passwordInput.type === 'password';
                passwordInput.type = isPasswordHidden ? 'text' : 'password';

                if (isPasswordHidden) {
                    toggleIcon.classList.remove('ti-eye-off');
                    toggleIcon.classList.add('ti-eye');
                } else {
                    toggleIcon.classList.remove('ti-eye');
                    toggleIcon.classList.add('ti-eye-off');
                }
            });
        } else {
            console.error("Não foi possível encontrar os elementos necessários para o controle de visibilidade da senha.");
        }
    });
</script>
