@extends('layouts.app')

@section('title', 'نسيت كلمة المرور')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2 class="fw-bold">نسيت كلمة المرور</h2>
                <p>أدخل بريدك الإلكتروني لإرسال رابط إعادة التعيين</p>
            </div>
            
            <div class="auth-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.email') }}" class="auth-form">
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
                    
                    <!-- زر الإرسال -->
                    <div class="auth-submit-container">
                        <button type="submit" class="auth-btn">
                            <i class="fas fa-paper-plane"></i> إرسال رابط إعادة التعيين
                        </button>
                    </div>
                    
                    <!-- روابط أخرى -->
                    <div class="auth-links">
                        <p class="mb-0">
                            تذكرت كلمة المرور؟ 
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