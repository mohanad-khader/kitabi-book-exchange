@extends('layouts.app')

@section('title', 'خطأ في تسجيل الدخول عبر Google')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-exclamation-triangle"></i> خطأ في تسجيل الدخول
                    </h4>
                </div>
                <div class="card-body text-center py-5">
                    <i class="fab fa-google fa-5x text-danger mb-4"></i>
                    <h4 class="text-danger mb-3">حدث خطأ أثناء تسجيل الدخول عبر Google</h4>
                    <p class="text-muted mb-4">{{ $error ?? 'الرجاء المحاولة مرة أخرى' }}</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> العودة لتسجيل الدخول
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-home"></i> الصفحة الرئيسية
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection