@extends('layouts.app')

@section('title', 'إعادة تعيين كلمة المرور')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2 class="fw-bold">إعادة تعيين كلمة المرور</h2>
                <p>أدخل كلمة المرور الجديدة</p>
            </div>
            
            <div class="auth-body">
                <form method="POST" action="{{ route('password.update') }}" class="auth-form">
                    @csrf
                    
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <!-- البريد الإلكتروني -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope text-primary"></i> البريد الإلكتروني
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email"
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ $email ?? old('email') }}"
                               required 
                               autocomplete="email" 
                               readonly>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- كلمة المرور الجديدة -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock text-primary"></i> كلمة المرور الجديدة
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="form-control @error('password') is-invalid @enderror" 
                               required 
                               autocomplete="new-password"
                               placeholder="أنشئ كلمة مرور جديدة">
                        <div class="password-strength mt-2">
                            <div class="password-strength-meter"></div>
                        </div>
                        <span class="auth-help-text">يجب أن تحتوي على 8 أحرف على الأقل، وتشمل حرف كبير ورقم</span>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- تأكيد كلمة المرور -->
                    <div class="form-group">
                        <label for="password-confirm" class="form-label">
                            <i class="fas fa-lock text-primary"></i> تأكيد كلمة المرور الجديدة
                        </label>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password-confirm"
                               class="form-control" 
                               required 
                               autocomplete="new-password"
                               placeholder="أعد إدخال كلمة المرور الجديدة">
                    </div>
                    
                    <!-- زر إعادة التعيين -->
                    <div class="auth-submit-container">
                        <button type="submit" class="auth-btn">
                            <i class="fas fa-redo"></i> إعادة تعيين كلمة المرور
                        </button>
                    </div>
                    
                    <!-- روابط أخرى -->
                    <div class="auth-links">
                        <p class="mb-0">
                            <a href="{{ route('login') }}">
                                <i class="fas fa-arrow-right"></i> العودة لتسجيل الدخول
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