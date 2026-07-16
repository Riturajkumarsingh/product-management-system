@extends('layouts.guest')
@section('title', 'Register')

@section('content')
    {{-- Brand --}}
    <div class="auth-brand">
        <div class="auth-brand-icon">
            <i class="bi bi-person-plus-fill"></i>
        </div>
        <h1 class="auth-title">Create Account</h1>
        <p class="auth-subtitle">Join Product Management System today</p>
    </div>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert mb-3" style="background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.2);color:#fca5a5;border-radius:10px;font-size:.825rem;">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Please fix the errors below:</strong>
            <ul class="mb-0 mt-1 ps-3" style="font-size:.8rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST" id="registerForm">
        @csrf

        {{-- Full Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="John Doe"
                    required
                    autocomplete="name"
                >
            </div>
            @error('name')
                <div class="invalid-feedback d-block" style="color:#f87171;">{{ $message }}</div>
            @enderror
        </div>

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
                    placeholder="Min. 8 characters"
                    required
                    autocomplete="new-password"
                >
                <button type="button" class="input-group-text" style="border-left:none;border-radius:0 10px 10px 0;cursor:pointer;"
                        onclick="togglePassword('password')">
                    <i class="bi bi-eye-fill"></i>
                </button>
            </div>
            @error('password')
                <div class="invalid-feedback d-block" style="color:#f87171;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Re-enter password"
                    required
                    autocomplete="new-password"
                >
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-auth" id="register-btn">
            <span class="spinner-border spinner-border-sm me-2 d-none" id="reg-spinner" role="status"></span>
            <i class="bi bi-person-check-fill me-2" id="reg-icon"></i>
            Create Account
        </button>
    </form>

    <div class="auth-footer">
        Already have an account? <a href="{{ route('login') }}">Sign in &rarr;</a>
    </div>
@endsection

@push('scripts')
<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        field.type = field.type === 'password' ? 'text' : 'password';
    }

    document.getElementById('registerForm').addEventListener('submit', function() {
        document.getElementById('reg-spinner').classList.remove('d-none');
        document.getElementById('reg-icon').classList.add('d-none');
    });
</script>
@endpush
