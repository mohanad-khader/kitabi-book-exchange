@extends('layouts.app')

@section('title', 'منصة كتابي - تبادل الكتب الدراسية')

@section('content')
    <!-- قسم الترحيب -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold">تبادل الكتب الدراسية أصبح أسهل مع "كتابي"</h1>
                    <p class="lead mb-4">منصة مجانية تربط الطلاب الراغبين في تبادل الكتب الدراسية، سواء مجاناً أو بأسعار رمزية.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('books.index') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-search"></i> تصفح الكتب
                        </a>
                        @auth
                            <a href="{{ route('books.create') }}" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-plus"></i> أضف كتاب
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-user-plus"></i> انضم إلينا
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="modern-book-container">
                        <div class="modern-book">
                            <!-- Left page -->
                            <div class="book-left">
                                <div class="page-content">
                                    <div class="arabic-text">الكتاب خير جليس</div>
                                    <div class="decorative-line"></div>
                                    <div class="arabic-text">وأفضل أنيس</div>
                                </div>
                                <div class="page-fold"></div>
                            </div>
                            
                            <!-- Right page -->
                            <div class="book-right">
                                <div class="page-content">
                                    <div class="book-icon">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <div class="platform-name">منصة كتابي</div>
                                </div>
                            </div>
                            
                            <!-- Book spine -->
                            <div class="book-spine"></div>
                            
                            <!-- Floating elements -->
                            <div class="knowledge-dots">
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- إحصائيات سريعة -->
    <section class="py-4">
        <div class="container">
            <div class="row text-center gy-4">
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-white shadow-sm">
                        <i class="fas fa-book fa-2x text-primary mb-2"></i>
                        <h3 class="h2 fw-bold">{{ App\Models\Book::available()->count() }}</h3>
                        <p class="text-muted mb-0">كتاب متاح</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-white shadow-sm">
                        <i class="fas fa-users fa-2x text-success mb-2"></i>
                        <h3 class="h2 fw-bold">{{ App\Models\User::count() }}</h3>
                        <p class="text-muted mb-0">مستخدم مسجل</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-white shadow-sm">
                        <i class="fas fa-exchange-alt fa-2x text-warning mb-2"></i>
                        <h3 class="h2 fw-bold">{{ App\Models\Book::where('status', 'exchanged')->count() }}</h3>
                        <p class="text-muted mb-0">كتاب تم تبادله</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-white shadow-sm">
                        <i class="fas fa-gift fa-2x text-danger mb-2"></i>
                        <h3 class="h2 fw-bold">{{ App\Models\Book::free()->count() }}</h3>
                        <p class="text-muted mb-0">كتاب مجاني</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- أحدث الكتب -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 fw-bold">
                    <i class="fas fa-clock text-primary"></i> أحدث الكتب المضافة
                </h2>
                <a href="{{ route('books.index') }}" class="btn btn-outline-primary">
                    عرض الكل <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            
            @if($latestBooks->count() > 0)
                <div class="row g-4">
                    @foreach($latestBooks as $book)
                        <div class="col-md-3 col-sm-6">
                            @include('components.book-card', ['book' => $book])
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-book fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">لا توجد كتب متاحة حالياً</h4>
                    <p class="text-muted">كن أول من يضيف كتاب!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- الكتب المجانية -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 fw-bold">
                    <i class="fas fa-gift text-success"></i> كتب مجانية
                </h2>
                <a href="{{ route('books.index', ['type' => 'free']) }}" class="btn btn-outline-success">
                    عرض الكل <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            
            @if($freeBooks->count() > 0)
                <div class="row g-4">
                    @foreach($freeBooks as $book)
                        <div class="col-md-3 col-sm-6">
                            @include('components.book-card', ['book' => $book])
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-gift fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">لا توجد كتب مجانية حالياً</h4>
                </div>
            @endif
        </div>
    </section>

    <!-- الكتب الجامعية -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 fw-bold">
                    <i class="fas fa-university text-warning"></i> كتب جامعية
                </h2>
                <a href="{{ route('books.index', ['category' => 'university']) }}" class="btn btn-outline-warning">
                    عرض الكل <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            
            @if($universityBooks->count() > 0)
                <div class="row g-4">
                    @foreach($universityBooks as $book)
                        <div class="col-md-3 col-sm-6">
                            @include('components.book-card', ['book' => $book])
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-university fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">لا توجد كتب جامعية حالياً</h4>
                </div>
            @endif
        </div>
    </section>

    <!-- كيف تعمل -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="h3 fw-bold text-center mb-5">
                <i class="fas fa-cogs text-primary"></i> كيف تعمل المنصة؟
            </h2>
            
            <div class="row gy-4">
                <div class="col-md-3 text-center">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <div class="mb-3">
                            <span class="display-6 fw-bold text-primary">1</span>
                        </div>
                        <i class="fas fa-user-plus fa-3x text-primary mb-3"></i>
                        <h4 class="h5 fw-bold">إنشاء حساب</h4>
                        <p class="text-muted">سجل في المنصة مجاناً خلال دقيقة واحدة</p>
                    </div>
                </div>
                
                <div class="col-md-3 text-center">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <div class="mb-3">
                            <span class="display-6 fw-bold text-success">2</span>
                        </div>
                        <i class="fas fa-book fa-3x text-success mb-3"></i>
                        <h4 class="h5 fw-bold">أضف كتبك</h4>
                        <p class="text-muted">ضع كتبك للتبادل مجاناً أو بأسعار رمزية</p>
                    </div>
                </div>
                
                <div class="col-md-3 text-center">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <div class="mb-3">
                            <span class="display-6 fw-bold text-warning">3</span>
                        </div>
                        <i class="fab fa-whatsapp fa-3x text-warning mb-3"></i>
                        <h4 class="h5 fw-bold">تواصل مباشر</h4>
                        <p class="text-muted">تواصل مع المشترين مباشرة عبر واتساب</p>
                    </div>
                </div>
                
                <div class="col-md-3 text-center">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <div class="mb-3">
                            <span class="display-6 fw-bold text-danger">4</span>
                        </div>
                        <i class="fas fa-handshake fa-3x text-danger mb-3"></i>
                        <h4 class="h5 fw-bold">قابل واستلم</h4>
                        <p class="text-muted">قابل المشتري في مكان عام واستلم الكتاب</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('how-it-works') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-info-circle"></i> تعرف أكثر على آلية العمل
                </a>
            </div>
        </div>
    </section>

    <!-- دعوة للإضافة -->
    @guest
        <section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <div class="container text-center">
                <h2 class="h2 fw-bold mb-3">انضم إلى مجتمعنا الآن!</h2>
                <p class="lead mb-4">سجل مجاناً وابدأ رحلتك في تبادل الكتب مع زملائك الطلاب</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-user-plus"></i> إنشاء حساب جديد
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-sign-in-alt"></i> تسجيل دخول
                    </a>
                </div>
            </div>
        </section>
    @endguest
@endsection