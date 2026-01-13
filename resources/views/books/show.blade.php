@extends('layouts.app')

@section('title', $book->title . ' - منصة كتابي')

@section('content')
    <div class="row">
        <!-- الصور والمعلومات الأساسية -->
        <div class="col-lg-8">
            <div class="book-detail-card p-4 mb-4">
                <div class="row">
                    <!-- صورة الكتاب -->
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="border rounded p-3 text-center bg-light">
                            <img src="{{ $book->image_url }}" 
                                 alt="{{ $book->title }}" 
                                 class="book-main-image img-fluid"
                                 onerror="this.src='{{ asset('images/default-book.jpg') }}'">
                        </div>
                        
                        <!-- أزرار الصورة -->
                        @if($book->image)
                            <div class="mt-3 text-center">
                                <a href="{{ $book->image_url }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-expand"></i> عرض الصورة كاملة
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    <!-- معلومات الكتاب -->
                    <div class="col-md-8">
                        <!-- العنوان والسعر -->
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h1 class="h2 fw-bold mb-2">{{ $book->title }}</h1>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <span class="badge bg-{{ $book->isFree() ? 'success' : 'primary' }} fs-6">
                                        {{ $book->price_formatted }}
                                    </span>
                                    <span class="status-badge status-{{ $book->status }}">
                                        {{ $book->status_arabic }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- أزرار المشاركة -->
                            @auth
                                @if(Auth::id() == $book->user_id)
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" 
                                                type="button" 
                                                data-bs-toggle="dropdown">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('books.edit', $book) }}">
                                                    <i class="fas fa-edit"></i> تعديل
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('books.destroy', $book) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الكتاب؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-trash"></i> حذف
                                                    </button>
                                                </form>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item book-status-btn" 
                                                   href="#"
                                                   data-book-id="{{ $book->id }}"
                                                   data-status="negotiating">
                                                    <i class="fas fa-comments"></i> وضع قيد التفاوض
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item book-status-btn" 
                                                   href="#"
                                                   data-book-id="{{ $book->id }}"
                                                   data-status="exchanged">
                                                    <i class="fas fa-check-circle"></i> تم التبادل
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        
                        <!-- معلومات الكتاب -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-user-pen text-primary"></i>
                                        <strong>المؤلف:</strong> {{ $book->author }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-tag text-primary"></i>
                                        <strong>التصنيف:</strong> 
                                        <span class="category-badge">{{ $book->category_arabic }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-book text-primary"></i>
                                        <strong>المادة/التخصص:</strong> 
                                        {{ $book->subject ?? 'غير محدد' }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                        <strong>المنطقة:</strong> 
                                        <span class="region-badge">{{ $book->region_arabic }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-star text-primary"></i>
                                        <strong>الحالة:</strong> 
                                        <span class="book-condition condition-{{ $book->condition }}">
                                            {{ $book->condition_arabic }}
                                        </span>
                                    </li>
                                    <li class="mb-2">
                                        <i class="far fa-clock text-primary"></i>
                                        <strong>تاريخ الإضافة:</strong> 
                                        {{ $book->created_at->format('Y/m/d') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- الوصف -->
                        @if($book->description)
                            <div class="mb-4">
                                <h5 class="fw-bold mb-2">
                                    <i class="fas fa-align-left text-primary"></i> وصف الكتاب
                                </h5>
                                <div class="bg-light p-3 rounded">
                                    <p class="mb-0" style="white-space: pre-line;">{{ $book->description }}</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- زر التواصل -->
                        @if($book->isAvailable() && $book->user->hasWhatsapp())
                            <div class="d-grid gap-2 d-md-flex">
                                @auth
                                    @if(Auth::id() != $book->user_id)
                                        <a href="{{ $book->whatsapp_link }}" 
                                           target="_blank" 
                                           class="whatsapp-btn btn-lg flex-fill"
                                           onclick="return confirm('سيتم فتح واتساب للتواصل مع البائع. هل تريد المتابعة؟')">
                                            <i class="fab fa-whatsapp"></i> تواصل مع البائع عبر واتساب
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg flex-fill">
                                        <i class="fas fa-sign-in-alt"></i> سجل دخول للتواصل مع البائع
                                    </a>
                                @endauth
                                
                                <!-- زر المشاركة -->
                                <button class="btn btn-outline-primary btn-lg share-btn"
                                        data-url="{{ url()->current() }}"
                                        data-title="{{ $book->title }}">
                                    <i class="fas fa-share-alt"></i> مشاركة
                                </button>
                            </div>
                            
                            <!-- رسالة واتساب جاهزة -->
                            <div class="mt-3 p-3 bg-light rounded">
                                <small class="text-muted d-block mb-1">
                                    <i class="fas fa-info-circle"></i> سيتم إرسال الرسالة التالية تلقائياً:
                                </small>
                                <code class="text-dark">{{ $book->whatsapp_message }}</code>
                            </div>
                        @elseif(!$book->isAvailable())
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                هذا الكتاب غير متاح حالياً للتبادل.
                            </div>
                        @elseif(!$book->user->hasWhatsapp())
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                البائع لم يضف رقم واتساب للتواصل.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- معلومات البائع -->
            <div class="book-detail-card p-4 mb-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-user text-primary"></i> معلومات البائع
                </h5>
                <div class="row align-items-center">
                    <div class="col-md-3 text-center mb-3 mb-md-0">
                        <div class="user-avatar mx-auto">
                            {{ $book->user->avatar_initial }}
                        </div>
                        <div class="mt-2">
                            <span class="badge bg-secondary">{{ $book->user->region_arabic }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold">{{ $book->user->name }}</h6>
                        <ul class="list-unstyled mb-0">
                            @if($book->user->university)
                                <li class="mb-1">
                                    <i class="fas fa-university text-muted"></i>
                                    {{ $book->user->university }}
                                </li>
                            @endif
                            <li class="mb-1">
                                <i class="far fa-calendar text-muted"></i>
                                مسجل منذ {{ $book->user->created_at->diffForHumans() }}
                            </li>
                            <li class="mb-1">
                                <i class="fas fa-books text-muted"></i>
                                {{ $book->user->books_listed_count }} كتاب معروض
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 text-center">
                        @if($book->user->hasWhatsapp())
                            <div class="mb-2">
                                <span class="badge bg-success">
                                    <i class="fab fa-whatsapp"></i> متوفر على واتساب
                                </span>
                            </div>
                            <small class="text-muted d-block">
                                رقم التواصل: {{ $book->user->safe_whatsapp }}
                            </small>
                        @else
                            <span class="badge bg-secondary">
                                <i class="fas fa-phone-slash"></i> غير متوفر على واتساب
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- كتب مشابهة -->
            @if($similarBooks->count() > 0)
                <div class="book-detail-card p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-book text-primary"></i> كتب مشابهة
                    </h5>
                    <div class="row g-3">
                        @foreach($similarBooks as $similarBook)
                            <div class="col-md-4">
                                <div class="border rounded p-3 h-100">
                                    <h6 class="fw-bold mb-2">
                                        <a href="{{ route('books.show', $similarBook) }}" class="text-decoration-none">
                                            {{ Str::limit($similarBook->title, 40) }}
                                        </a>
                                    </h6>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-{{ $similarBook->isFree() ? 'success' : 'primary' }}">
                                            {{ $similarBook->price_formatted }}
                                        </span>
                                        <small class="text-muted">{{ $similarBook->region_arabic }}</small>
                                    </div>
                                    <a href="{{ route('books.show', $similarBook) }}" 
                                       class="btn btn-sm btn-outline-primary w-100">
                                        <i class="fas fa-eye"></i> عرض التفاصيل
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        
        <!-- الشريط الجانبي -->
        <div class="col-lg-4">
            <!-- نصائح الأمان -->
            <div class="card border-warning mb-4">
                <div class="card-header bg-warning text-white">
                    <i class="fas fa-shield-alt"></i> نصائح أمان
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success"></i>
                            <small>التقاء في أماكن عامة وآمنة</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success"></i>
                            <small>الدفع نقداً عند الاستلام فقط</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success"></i>
                            <small>تأكد من حالة الكتاب قبل الشراء</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success"></i>
                            <small>لا تشارك معلوماتك الشخصية</small>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- إحصائيات الكتاب -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <i class="fas fa-chart-bar"></i> إحصائيات
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="p-2 border rounded">
                                <i class="far fa-eye fa-2x text-primary mb-2"></i>
                                <h6 class="fw-bold mb-0">{{ $book->view_count }}</h6>
                                <small class="text-muted">مشاهدة</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="p-2 border rounded">
                                <i class="far fa-calendar fa-2x text-success mb-2"></i>
                                <h6 class="fw-bold mb-0">{{ $book->created_at->format('Y/m/d') }}</h6>
                                <small class="text-muted">تاريخ الإضافة</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- روابط سريعة -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <i class="fas fa-link"></i> روابط سريعة
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('books.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-books"></i> عرض جميع الكتب
                        </a>
                        @auth
                            <a href="{{ route('books.create') }}" class="btn btn-outline-success">
                                <i class="fas fa-plus-circle"></i> إضافة كتاب جديد
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-outline-success">
                                <i class="fas fa-user-plus"></i> انضم إلينا الآن
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/books.js') }}"></script>
@endpush