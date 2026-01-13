@extends('layouts.app')

@section('title', 'تصفح الكتب - منصة كتابي')

@section('content')
    <div class="row">
        <!-- الشريط الجانبي للتصفية -->
        <div class="col-lg-3 mb-4">
            <div class="filter-section">
                <h5 class="filter-title">
                    <i class="fas fa-filter"></i> تصفية النتائج
                </h5>
                
                <form action="{{ route('books.index') }}" method="GET" id="filter-form">
                    <!-- البحث -->
                    <div class="mb-3">
                        <label for="search" class="form-label">
                            <i class="fas fa-search"></i> البحث
                        </label>
                        <input type="text" 
                               name="search" 
                               id="book-search-input"
                               class="form-control" 
                               placeholder="ابحث عن كتاب أو مؤلف..."
                               value="{{ request('search') }}">
                    </div>
                    
                    <!-- المنطقة -->
                    <div class="mb-3">
                        <label for="region" class="form-label">
                            <i class="fas fa-map-marker-alt"></i> المنطقة
                        </label>
                        <select name="region" id="region" class="form-select">
                            <option value="">جميع المناطق</option>
                            @foreach(['north_gaza' => 'شمال غزة', 'gaza' => 'غزة', 'central' => 'الوسطى', 'khan_younis' => 'خان يونس', 'rafah' => 'رفح'] as $key => $value)
                                <option value="{{ $key }}" {{ request('region') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- النوع -->
                    <div class="mb-3">
                        <label for="type" class="form-label">
                            <i class="fas fa-tag"></i> النوع
                        </label>
                        <select name="type" id="type" class="form-select">
                            <option value="">جميع الأنواع</option>
                            <option value="free" {{ request('type') == 'free' ? 'selected' : '' }}>مجاني</option>
                            <option value="paid" {{ request('type') == 'paid' ? 'selected' : '' }}>مدفوع</option>
                        </select>
                    </div>
                    
                    <!-- التصنيف -->
                    <div class="mb-3">
                        <label for="category" class="form-label">
                            <i class="fas fa-bookmark"></i> التصنيف
                        </label>
                        <select name="category" id="category" class="form-select">
                            <option value="">جميع التصنيفات</option>
                            <option value="university" {{ request('category') == 'university' ? 'selected' : '' }}>جامعي</option>
                            <option value="school" {{ request('category') == 'school' ? 'selected' : '' }}>مدرسي</option>
                            <option value="general" {{ request('category') == 'general' ? 'selected' : '' }}>عام</option>
                        </select>
                    </div>
                    
                    <!-- الترتيب -->
                    <div class="mb-3">
                        <label for="sort" class="form-label">
                            <i class="fas fa-sort-amount-down"></i> الترتيب حسب
                        </label>
                        <select name="sort" id="sort" class="form-select">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>الأحدث أولاً</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>الأقدم أولاً</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>السعر (منخفض إلى مرتفع)</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>السعر (مرتفع إلى منخفض)</option>
                        </select>
                    </div>
                    
                    <!-- الأزرار -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> تطبيق التصفية
                        </button>
                        <button type="button" id="reset-filters" class="btn btn-outline-secondary">
                            <i class="fas fa-undo"></i> إعادة تعيين
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- إحصائيات -->
            <div class="mt-4 p-3 bg-light rounded">
                <h6 class="fw-bold">
                    <i class="fas fa-chart-bar"></i> إحصائيات
                </h6>
                <ul class="list-unstyled mb-0">
                    <li class="py-1">
                        <small>الكتب المتاحة: <span class="fw-bold">{{ $books->total() }}</span></small>
                    </li>
                    <li class="py-1">
                        <small>مجانية: <span class="fw-bold">{{ App\Models\Book::free()->count() }}</span></small>
                    </li>
                    <li class="py-1">
                        <small>جامعية: <span class="fw-bold">{{ App\Models\Book::byCategory('university')->count() }}</span></small>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- قائمة الكتب -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 fw-bold">
                    <i class="fas fa-books"></i> الكتب المتاحة
                    @if(request()->hasAny(['search', 'region', 'type', 'category']))
                        <small class="text-muted fs-6">({{ $books->total() }} نتيجة)</small>
                    @endif
                </h1>
                
                @auth
                    <a href="{{ route('books.create') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> إضافة كتاب جديد
                    </a>
                @endauth
            </div>
            
            <!-- شريط البحث السريع -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <form action="{{ route('books.index') }}" method="GET" id="search-form" class="d-flex gap-2">
                        <div class="input-group flex-grow-1">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="ابحث عن كتاب، مؤلف، أو مادة..."
                                   value="{{ request('search') }}"
                                   id="search-input">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> بحث
                            </button>
                            @if(request()->has('search') && request('search') != '')
                                <button type="button" 
                                        class="btn btn-outline-secondary" 
                                        id="clear-search"
                                        onclick="clearSearch()">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('books.index', ['type' => 'free']) }}" class="btn btn-outline-success btn-sm">
                            مجاني <span class="badge bg-success">{{ App\Models\Book::free()->count() }}</span>
                        </a>
                        <a href="{{ route('books.index', ['category' => 'university']) }}" class="btn btn-outline-warning btn-sm">
                            جامعي <span class="badge bg-warning">{{ App\Models\Book::byCategory('university')->count() }}</span>
                        </a>
                        <a href="{{ route('books.index', ['category' => 'school']) }}" class="btn btn-outline-info btn-sm">
                            مدرسي <span class="badge bg-info">{{ App\Models\Book::byCategory('school')->count() }}</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- الكتب -->
            @if($books->count() > 0)
                <div class="row g-4">
                    @foreach($books as $book)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                            @include('components.book-card', ['book' => $book])
                        </div>
                    @endforeach
                </div>
                
                <!-- معلومات Pagination -->
                @if($books->count() > 0)
                    <div class="pagination-info">
                        <p class="mb-0">
                            عرض الكتب 
                            <strong>{{ $books->firstItem() }}</strong> 
                            إلى 
                            <strong>{{ $books->lastItem() }}</strong> 
                            من أصل 
                            <strong>{{ $books->total() }}</strong> 
                            كتاب
                        </p>
                    </div>
                @endif

                <!-- الترقيم الصفحي -->
                <div class="mt-4">
                    {{ $books->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                </div>
            @else
                <!-- حالة عدم وجود كتب -->
                <div class="text-center py-5 my-5">
                    <div class="mb-4">
                        <i class="fas fa-book-open fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">لا توجد كتب مطابقة لبحثك</h4>
                    <p class="text-muted mb-4">جرب تغيير كلمات البحث أو إزالة بعض الفلاتر</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('books.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-undo"></i> عرض جميع الكتب
                        </a>
                        @auth
                            <a href="{{ route('books.create') }}" class="btn btn-success">
                                <i class="fas fa-plus-circle"></i> أضف أول كتاب
                            </a>
                        @endauth
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* تنسيق البطاقات - 3 بطاقات في الصف */
    .col-xl-4 {
        flex: 0 0 auto;
        width: 33.33333333%;
    }
    
    @media (max-width: 1200px) {
        .col-xl-4 {
            width: 50%;
        }
    }
    
    @media (max-width: 768px) {
        .col-xl-4 {
            width: 100%;
        }
    }
    
    /* تحسين التباعد بين البطاقات */
    .g-4 {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 1.5rem;
    }
    
    /* تنسيق Pagination مخصص */
    .pagination {
        justify-content: center;
        flex-wrap: wrap;
        gap: 5px;
    }
    
    .page-item .page-link {
        border-radius: 8px;
        margin: 0 3px;
        border: 1px solid #dee2e6;
        color: #2c3e50;
        font-weight: 500;
        min-width: 40px;
        text-align: center;
    }
    
    .page-item.active .page-link {
        background-color: #3498db;
        border-color: #3498db;
        color: white;
    }
    
    .page-item.disabled .page-link {
        color: #95a5a6;
        background-color: #f8f9fa;
    }
    
    .page-link:hover {
        background-color: #ecf0f1;
        color: #3498db;
        border-color: #3498db;
    }
    
    /* إخفاء الأسماء الطويلة في Pagination */
    .page-item:not(.active):not(.disabled) .page-link {
        padding: 0.375rem 0.5rem;
    }
    
    /* زر البحث */
    #search-form .input-group {
        border-radius: 10px;
        overflow: hidden;
    }
    
    #search-form .form-control {
        border-radius: 10px 0 0 10px;
    }
    
    #search-form .btn-primary {
        border-radius: 0 10px 10px 0;
    }
    
    #clear-search {
        border-radius: 0;
        border-left: 0;
    }
    
    /* تحسين ظهور الفلاتر النشطة */
    .filter-active {
        background-color: #e3f2fd !important;
        border-color: #2196f3 !important;
        color: #1976d2 !important;
    }
</style>
@endpush

@push('scripts')
    <script src="{{ asset('js/books.js') }}"></script>
    <script>
        // مسح حقل البحث
        function clearSearch() {
            document.getElementById('search-input').value = '';
            document.getElementById('search-form').submit();
        }
        
        // إعادة تعيين جميع الفلاتر
        document.addEventListener('DOMContentLoaded', function() {
            const resetBtn = document.getElementById('reset-filters');
            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    const form = document.getElementById('filter-form');
                    if (form) {
                        // مسح جميع الحقول
                        const inputs = form.querySelectorAll('input, select');
                        inputs.forEach(input => {
                            if (input.type === 'text' || input.type === 'search') {
                                input.value = '';
                            } else if (input.tagName === 'SELECT') {
                                input.selectedIndex = 0;
                            }
                        });
                        
                        // إعادة التوجيه للصفحة الرئيسية للكتب
                        window.location.href = "{{ route('books.index') }}";
                    }
                });
            }
            
            // إظهار الفلاتر النشطة
            highlightActiveFilters();
        });
        
        // تظليل الفلاتر النشطة
        function highlightActiveFilters() {
            const urlParams = new URLSearchParams(window.location.search);
            
            // المنطقة
            const region = urlParams.get('region');
            if (region) {
                const regionBtn = document.querySelector('a[href*="region=' + region + '"]');
                if (regionBtn) regionBtn.classList.add('filter-active');
            }
            
            // النوع
            const type = urlParams.get('type');
            if (type) {
                const typeBtn = document.querySelector('a[href*="type=' + type + '"]');
                if (typeBtn) typeBtn.classList.add('filter-active');
            }
            
            // التصنيف
            const category = urlParams.get('category');
            if (category) {
                const categoryBtn = document.querySelector('a[href*="category=' + category + '"]');
                if (categoryBtn) categoryBtn.classList.add('filter-active');
            }
        }
    </script>
@endpush