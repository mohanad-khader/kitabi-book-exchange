@extends('layouts.app')

@section('title', 'التحقق من البريد الإلكتروني')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2 class="fw-bold">التحقق من البريد الإلكتروني</h2>
                <p>يرجى التحقق من بريدك الإلكتروني</p>
            </div>
            
            <div class="auth-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i> تم إرسال رابط تحقق جديد إلى بريدك الإلكتروني
                    </div>
                @endif
                
                <div class="text-center mb-4">
                    <i class="fas fa-envelope fa-4x text-primary mb-3"></i>
                    <p class="auth-small-text">قبل المتابعة، يرجى التحقق من بريدك الإلكتروني عبر رابط التحقق الذي أرسلناه إليك.</p>
                    <p class="auth-small-text">إذا لم تستلم البريد الإلكتروني</p>
                </div>
                
                <form method="POST" action="{{ route('verification.resend') }}" class="auth-form">
                    @csrf
                    
                    <div class="auth-submit-container">
                        <button type="submit" class="auth-btn">
                            <i class="fas fa-paper-plane"></i> إرسال رابط تحقق جديد
                        </button>
                    </div>
                </form>
                
                <!-- خيارات أخرى -->
                <div class="auth-links">
                    <div class="d-flex justify-content-center gap-3">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="auth-inline-btn">
                                <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                            </button>
                        </form>
                        <span class="auth-small-text">|</span>
                        <a href="{{ route('home') }}" class="auth-small-link">
                            <i class="fas fa-home"></i> الصفحة الرئيسية
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection