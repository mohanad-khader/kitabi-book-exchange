@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2 class="fw-bold">تسجيل الدخول</h2>
                <p>مرحباً بعودتك إلى منصة كتابي</p>
            </div>
            
            <div class="auth-body">
                <form method="POST" action="{{ route('login') }}" class="auth-form">
                    @csrf
                    
                    <!-- البريد الإلكتروني -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope text-primary"></i> البريد الإلكتروني
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email"
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}"
                               required 
                               autocomplete="email" 
                               autofocus
                               placeholder="أدخل بريدك الإلكتروني">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- كلمة المرور -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock text-primary"></i> كلمة المرور
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="form-control @error('password') is-invalid @enderror" 
                               required 
                               autocomplete="current-password"
                               placeholder="أدخل كلمة المرور">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- خيارات إضافية -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="remember" 
                                   id="remember" 
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label auth-small-text" for="remember">
                                <i class="fas fa-check-circle me-1"></i> تذكرني
                            </label>
                        </div>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="auth-small-link">
                                <i class="fas fa-key me-1"></i> نسيت كلمة المرور؟
                            </a>
                        @endif
                    </div>
                    
                    <!-- زر تسجيل الدخول -->
                    <div class="auth-submit-container">
                        <button type="submit" class="auth-btn">
                            <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
                        </button>
                    </div>
                    
                    <!-- الفاصل -->
                    <div class="auth-divider">
                        <span>أو</span>
                    </div>
                    
                    <!-- زر Google -->
                    <div class="mb-3">
                        <a href="{{ route('auth.google') }}" target="_blank" class="google-btn">
                            <i class="fab fa-google"></i> تسجيل الدخول عبر Google
                        </a>
                    </div>
                    
                    <!-- روابط أخرى -->
                    <div class="auth-links">
                        <p class="mb-0">
                            ليس لديك حساب؟ 
                            <a href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> أنشئ حساباً جديداً
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush