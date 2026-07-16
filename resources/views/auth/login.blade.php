@extends('layouts.guest')
@section('title', 'Login')

@section('content')
    {{-- Brand --}}
    <div class="auth-brand">
        <div class="auth-brand-icon">
            <i class="bi bi-box-seam-fill"></i>
        </div>
        <h1 class="auth-title">Welcome back</h1>
        <p class="auth-subtitle">Sign in to your Product Manager account</p>
    </div>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger mb-3" style="background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.2);color:#fca5a5;border-radius:10px;font-size:.825rem;">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Session Messages --}}
    @if(session('success'))
        <div class="alert alert-success mb-3" style="background:rgba(16,185,129,.12);border:1px solid rgba(16,185,129,.2);color:#6ee7b7;border-radius:10px;font-size:.825rem;">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" id="loginForm">
        @csrf

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    placeholder="you@example.com"
                    required
                    autocomplete="email"
                >
            </div>
            @error('email')
                <div class="invalid-feedback d-block" style="color:#f87171;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                >
                <button type="button" class="input-group-text" style="border-left:none;border-radius:0 10px 10px 0;cursor:pointer;"
                        onclick="togglePassword('password', this)">
                    <i class="bi bi-eye-fill" id="password-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="invalid-feedback d-block" style="color:#f87171;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-auth" id="login-btn" onclick="showBtnSpinner(this)">
            <span id="login-spinner" class="spinner-border spinner-border-sm me-2 d-none" role="status"></span>
            <i class="bi bi-box-arrow-in-right me-2" id="login-icon"></i>
            Sign In
        </button>
    </form>

    <div class="auth-footer">
        Don't have an account? <a href="{{ route('register') }}">Create one &rarr;</a>
    </div>
@endsection

@push('scripts')
<script>
    function togglePassword(fieldId, btn) {
        const field = document.getElementById(fieldId);
        const icon  = btn.querySelector('i');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
        } else {
            field.type = 'password';
            icon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
        }
    }

    function showBtnSpinner(btn) {
        btn.querySelector('#login-spinner').classList.remove('d-none');
        btn.querySelector('#login-icon').classList.add('d-none');
    }
</script>
@endpush
