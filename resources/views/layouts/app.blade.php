<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
     <!-- Favicon من SVG -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta name="theme-color" content="#3498db">
    
    <title>@yield('title', 'منصة كتابي - تبادل الكتب الدراسية')</title>
    
    <!-- Bootstrap محلي -->
    <link href="{{ asset('vendors/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome محلي -->
    <link href="{{ asset('vendors/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <!-- الخط العربي -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS المخصص -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @if(request()->is('login', 'register', 'password/*', 'email/verify*'))
        <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    @endif
    
    @stack('styles')
</head>
<body>
    <!-- الشريط العلوي -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-book"></i>
                كتابي
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> الرئيسية
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                            <i class="fas fa-book-open"></i> الكتب
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('how-it-works') ? 'active' : '' }}" href="{{ route('how-it-works') }}">
                            <i class="fas fa-question-circle"></i> كيف تعمل
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="fas fa-user"></i> الملف الشخصي
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('books.create') }}">
                                        <i class="fas fa-plus-circle"></i> إضافة كتاب
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt"></i> تسجيل خروج
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> تسجيل دخول
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> إنشاء حساب
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- المحتوى الرئيسي -->
    <main class="py-4">
        <div class="container">
            <!-- الرسائل -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show auto-dismiss" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show auto-dismiss" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> يوجد أخطاء في النموذج:
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            <!-- محتوى الصفحة -->
            @yield('content')
        </div>
    </main>

    <!-- الفوتر -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-book"></i> منصة كتابي</h5>
                    <p>منصة مجانية لتبادل الكتب الدراسية بين الطلاب، تهدف إلى دعم التعليم وتشجيع ثقافة التشارك.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>روابط سريعة</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li><a href="{{ route('books.index') }}">الكتب</a></li>
                        <li><a href="{{ route('how-it-works') }}">كيف تعمل</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>الحساب</h5>
                    <ul class="footer-links">
                        @auth
                            <li><a href="{{ route('profile.show') }}">الملف الشخصي</a></li>
                            <li><a href="{{ route('books.create') }}">إضافة كتاب</a></li>
                        @else
                            <li><a href="{{ route('login') }}">تسجيل دخول</a></li>
                            <li><a href="{{ route('register') }}">إنشاء حساب</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>المساعدة</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('contact') }}">اتصل بنا</a></li>
                        <li><a href="{{ route('privacy') }}">سياسة الخصوصية</a></li>
                        <li><a href="{{ route('terms') }}">الشروط والأحكام</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>© 2026 منصة كتابي. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>