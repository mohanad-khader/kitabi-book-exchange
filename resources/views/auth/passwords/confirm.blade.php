@extends('layouts.app')

@section('title', 'تأكيد كلمة المرور')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2 class="fw-bold">تأكيد كلمة المرور</h2>
                <p>يرجى تأكيد كلمة المرور للمتابعة</p>
            </div>
            
            <div class="auth-body">
                <form method="POST" action="{{ route('password.confirm') }}" class="auth-form">
                    @csrf
                    
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
                               autofocus
                               placeholder="أدخل كلمة المرور الحالية">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- زر التأكيد -->
                    <div class="auth-submit-container">
                        <button type="submit" class="auth-btn">
                            <i class="fas fa-check-circle"></i> تأكيد كلمة المرور
                        </button>
                    </div>
                    
                    <!-- رابط استعادة كلمة المرور -->
                    <div class="auth-links">
                        <p class="mb-0">
                            <a href="{{ route('password.request') }}">
                                <i class="fas fa-key"></i> نسيت كلمة المرور؟
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection