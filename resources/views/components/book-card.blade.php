{{-- مكون بطاقة الكتاب - يمكن استخدامه في عدة أماكن --}}

<div class="book-card h-100">
    {{-- شارة الحالة --}}
    <span class="status-badge status-{{ $book->status }}">
        {{ $book->status_arabic }}
    </span>
    
    {{-- شارة السعر --}}
    <span class="price-badge {{ $book->isFree() ? 'free-badge' : '' }}">
        {{ $book->price_formatted }}
    </span>
    
    {{-- صورة الكتاب --}}
    <div class="book-image-container">
        <img src="{{ $book->image_url }}" 
             alt="{{ $book->title }}" 
             class="book-image"
             onerror="this.src='{{ asset('images/default-book.jpg') }}'">
    </div>
    
    {{-- محتوى البطاقة --}}
    <div class="p-3">
        {{-- العنوان والمؤلف --}}
        <h5 class="fw-bold mb-2 text-truncate" title="{{ $book->title }}">
            {{ Str::limit($book->title, 40) }}
        </h5>
        <p class="text-muted small mb-2">
            <i class="fas fa-user-pen"></i> {{ Str::limit($book->author, 30) }}
        </p>
        
        {{-- التصنيفات --}}
        <div class="mb-2">
            <span class="category-badge">
                <i class="fas fa-tag"></i> {{ $book->category_arabic }}
            </span>
            <span class="region-badge">
                <i class="fas fa-map-marker-alt"></i> {{ $book->region_arabic }}
            </span>
        </div>
        
        {{-- حالة الكتاب --}}
        @if($book->condition)
            <div class="mb-2">
                <span class="book-condition condition-{{ $book->condition }}">
                    <i class="fas fa-star"></i> {{ $book->condition_arabic }}
                </span>
            </div>
        @endif
        
        {{-- المستخدم --}}
        <div class="d-flex align-items-center mb-3">
            <div class="user-avatar-small bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                {{ $book->user->avatar_initial }}
            </div>
            <small class="text-muted">
                {{ Str::limit($book->user->name, 15) }}
            </small>
        </div>
        
        {{-- أزرار العمل --}}
        <div class="d-grid gap-2">
            <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-eye"></i> عرض التفاصيل
            </a>
            
            {{-- زر واتساب يظهر فقط للكتب المتاحة وللمستخدمين المسجلين --}}
            @if($book->isAvailable() && $book->user->hasWhatsapp())
                @auth
                    @if(Auth::id() != $book->user_id)
                        <a href="{{ $book->whatsapp_link }}" 
                           target="_blank" 
                           class="whatsapp-btn btn-sm"
                           data-message="{{ $book->whatsapp_message }}"
                           onclick="return confirm('سيتم فتح واتساب للتواصل مع البائع. هل تريد المتابعة؟')">
                            <i class="fab fa-whatsapp"></i> تواصل عبر واتساب
                        </a>
                    @endif
                @endauth
            @endif
        </div>
        
        {{-- تاريخ الإضافة --}}
        <div class="mt-2 pt-2 border-top">
            <small class="text-muted">
                <i class="far fa-clock"></i> {{ $book->created_at->diffForHumans() }}
            </small>
            <small class="text-muted float-start">
                <i class="far fa-eye"></i> {{ $book->view_count }}
            </small>
        </div>
    </div>
</div>