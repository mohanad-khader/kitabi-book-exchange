@extends('layouts.app')

@section('title', 'إنشاء حساب جديد')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2 class="fw-bold">إنشاء حساب جديد</h2>
                <p>انضم إلى مجتمع تبادل الكتب الدراسية</p>
            </div>
            
            <div class="auth-body">
                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    @csrf
                    
                    <!-- الاسم -->
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="fas fa-user text-primary"></i> الاسم الكامل
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name"
                               class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name') }}"
                               required 
                               autocomplete="name" 
                               autofocus
                               placeholder="أدخل اسمك الكامل">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
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
                               placeholder="أدخل بريدك الإلكتروني">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- رقم الواتساب -->
                    <div class="form-group">
                        <label for="whatsapp" class="form-label">
                            <i class="fab fa-whatsapp text-success"></i> رقم واتساب
                        </label>
                        <input type="text" 
                               name="whatsapp" 
                               id="whatsapp"
                               class="form-control @error('whatsapp') is-invalid @enderror" 
                               value="{{ old('whatsapp') }}"
                               placeholder="059XXXXXXX أو +97059XXXXXXX">
                        <small class="text-muted">اختياري - سيتم استخدامه للتواصل معك بشأن الكتب</small>
                        <small class="text-muted d-block mt-1">
                            أمثلة: 0591234567, 0561234567, +970591234567, +972591234567
                        </small>
                        @error('whatsapp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- المنطقة -->
                    <div class="form-group">
                        <label for="region" class="form-label">
                            <i class="fas fa-map-marker-alt text-primary"></i> المنطقة
                        </label>
                        <select name="region" 
                                id="region" 
                                class="form-select @error('region') is-invalid @enderror" 
                                required>
                            <option value="">اختر المنطقة</option>
                            @foreach(['north_gaza' => 'شمال غزة', 'gaza' => 'غزة', 'central' => 'الوسطى', 'khan_younis' => 'خان يونس', 'rafah' => 'رفح'] as $key => $value)
                                <option value="{{ $key }}" {{ old('region') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        @error('region')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- الجامعة -->
                    <div class="form-group">
                        <label for="university" class="form-label">
                            <i class="fas fa-university text-primary"></i> الجامعة/المؤسسة التعليمية <span class="auth-help-text">(اختياري)</span>
                        </label>
                        <input type="text" 
                               name="university" 
                               id="university"
                               class="form-control @error('university') is-invalid @enderror" 
                               value="{{ old('university') }}"
                               placeholder="مثال: جامعة الأقصى">
                        @error('university')
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
                               autocomplete="new-password"
                               placeholder="أنشئ كلمة مرور قوية">
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
                            <i class="fas fa-lock text-primary"></i> تأكيد كلمة المرور
                        </label>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password-confirm"
                               class="form-control" 
                               required 
                               autocomplete="new-password"
                               placeholder="أعد إدخال كلمة المرور">
                    </div>
                    
                    <!-- اتفاقية الاستخدام -->
                    <div class="form-group form-check terms-check">
                        <input type="checkbox" 
                               name="terms" 
                               id="terms"
                               class="form-check-input @error('terms') is-invalid @enderror" 
                               required>
                        <label class="form-check-label auth-small-text" for="terms">
                            أوافق على <a href="{{ route('terms') }}" target="_blank">الشروط والأحكام</a> و <a href="{{ route('privacy') }}" target="_blank">سياسة الخصوصية</a>
                        </label>
                        @error('terms')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- زر التسجيل -->
                    <div class="auth-submit-container">
                        <button type="submit" class="auth-btn">
                            <i class="fas fa-user-plus"></i> إنشاء حساب
                        </button>
                    </div>

                    <!-- الفاصل -->
                    <div class="auth-divider">
                        <span>أو</span>
                    </div>

                    <!-- زر Google -->
                    <div class="mb-3">
                        <a href="{{ route('auth.google') }}" target="_blank" class="google-btn">
                            <i class="fab fa-google"></i> التسجيل عبر Google
                        </a>
                    </div>
                    
                    <!-- روابط أخرى -->
                    <div class="auth-links">
                        <p class="mb-0">
                            لديك حساب بالفعل؟ 
                            <a href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> سجل دخول
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