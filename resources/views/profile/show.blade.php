@extends('layouts.app')

@section('title', 'الملف الشخصي - ' . $user->name)

@section('content')
    <div class="row">
        <!-- معلومات المستخدم -->
        <div class="col-lg-4 mb-4">
            <div class="user-card">
                <div class="user-avatar">
                    {{ $user->avatar_initial }}
                </div>
                <h4 class="fw-bold mb-2">{{ $user->name }}</h4>
                
                <div class="mb-3">
                    <span class="badge bg-primary">
                        <i class="fas fa-map-marker-alt"></i> {{ $user->region_arabic }}
                    </span>
                </div>
                
                <ul class="list-unstyled mb-4">
                    @if($user->university)
                        <li class="mb-2">
                            <i class="fas fa-university text-primary"></i> {{ $user->university }}
                        </li>
                    @endif
                    <li class="mb-2">
                        <i class="fas fa-envelope text-primary"></i> {{ $user->email }}
                    </li>
                    @if($user->hasWhatsapp())
                        <li class="mb-2">
                            <i class="fab fa-whatsapp text-success"></i> {{ $user->safe_whatsapp }}
                        </li>
                    @endif
                    <li class="mb-2">
                        <i class="far fa-calendar text-primary"></i>
                        مسجل منذ {{ $user->created_at->diffForHumans() }}
                    </li>
                </ul>
                
                <div class="d-grid gap-2">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> تعديل الملف الشخصي
                    </a>
                    <a href="{{ route('books.create') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> إضافة كتاب جديد
                    </a>
                </div>

                <!-- إضافة زر ربط Google -->
                <div class="mt-4">
                    @if(Auth::user()->isGoogleUser())
                        <div class="alert alert-success">
                            <i class="fab fa-google text-success"></i>
                            حسابك مرتبط بحساب Google
                            <form action="{{ route('auth.google.unlink') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger ms-2">
                                    <i class="fas fa-unlink"></i> إلغاء الربط
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fab fa-google text-info"></i>
                            يمكنك ربط حساب Google لتسجيل دخول أسرع
                            <a href="{{ route('auth.google') }}" target="_blank" class="btn btn-sm btn-outline-success ms-2">
                                <i class="fab fa-google"></i> ربط حساب Google
                            </a>
                        </div>
                    @endif
                </div>

            </div>
            
            <!-- إحصائيات -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <i class="fas fa-chart-pie"></i> إحصائيات
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="p-3 border rounded">
                                <i class="fas fa-book fa-2x text-primary mb-2"></i>
                                <h4 class="fw-bold mb-0">{{ $user->books_listed_count }}</h4>
                                <small class="text-muted">كتاب معروض</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="p-3 border rounded">
                                <i class="fas fa-exchange-alt fa-2x text-success mb-2"></i>
                                <h4 class="fw-bold mb-0">{{ $user->books_exchanged_count }}</h4>
                                <small class="text-muted">كتاب تم تبادله</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 border rounded">
                                <i class="fas fa-shopping-cart fa-2x text-warning mb-2"></i>
                                <h4 class="fw-bold mb-0">{{ count($negotiatingBooks) }}</h4>
                                <small class="text-muted">قيد التفاوض</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 border rounded">
                                <i class="fas fa-gift fa-2x text-danger mb-2"></i>
                                <h4 class="fw-bold mb-0">{{ $user->books()->free()->count() }}</h4>
                                <small class="text-muted">مجاني</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- كتب المستخدم -->
        <div class="col-lg-8">
            <!-- الكتب المتاحة -->
            @if($availableBooks->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-check-circle"></i> الكتب المتاحة
                            <span class="badge bg-light text-dark">{{ $availableBooks->count() }}</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach($availableBooks as $book)
                                <div class="col-md-6 col-lg-4">
                                    <div class="border rounded p-3 h-100">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="fw-bold mb-0">
                                                <a href="{{ route('books.show', $book) }}" class="text-decoration-none">
                                                    {{ Str::limit($book->title, 30) }}
                                                </a>
                                            </h6>
                                            <span class="badge bg-{{ $book->isFree() ? 'success' : 'primary' }}">
                                                {{ $book->price_formatted }}
                                            </span>
                                        </div>
                                        <p class="text-muted small mb-2">
                                            <i class="fas fa-user-pen"></i> {{ Str::limit($book->author, 25) }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="far fa-clock"></i> {{ $book->created_at->diffForHumans() }}
                                            </small>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('books.edit', $book) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('books.destroy', $book) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الكتاب؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- الكتب قيد التفاوض -->
            @if($negotiatingBooks->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-warning text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-comments"></i> الكتب قيد التفاوض
                            <span class="badge bg-light text-dark">{{ $negotiatingBooks->count() }}</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>الكتاب</th>
                                        <th>المؤلف</th>
                                        <th>النوع</th>
                                        <th>آخر تحديث</th>
                                        <th>إجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($negotiatingBooks as $book)
                                        <tr>
                                            <td>
                                                <a href="{{ route('books.show', $book) }}" class="text-decoration-none">
                                                    {{ Str::limit($book->title, 25) }}
                                                </a>
                                            </td>
                                            <td>{{ Str::limit($book->author, 20) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $book->isFree() ? 'success' : 'primary' }}">
                                                    {{ $book->type_arabic }}
                                                </span>
                                            </td>
                                            <td>{{ $book->updated_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('books.show', $book) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('books.status', $book) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="status" value="available">
                                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                                            <i class="fas fa-undo"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('books.status', $book) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="status" value="exchanged">
                                                        <button type="submit" class="btn btn-sm btn-outline-info">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- الكتب المتبادلة -->
            @if($exchangedBooks->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-check-double"></i> الكتب المتبادلة
                            <span class="badge bg-light text-dark">{{ $exchangedBooks->count() }}</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>الكتاب</th>
                                        <th>المؤلف</th>
                                        <th>النوع</th>
                                        <th>تاريخ التبادل</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exchangedBooks as $book)
                                        <tr>
                                            <td>
                                                <a href="{{ route('books.show', $book) }}" class="text-decoration-none">
                                                    {{ Str::limit($book->title, 25) }}
                                                </a>
                                            </td>
                                            <td>{{ Str::limit($book->author, 20) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $book->isFree() ? 'success' : 'primary' }}">
                                                    {{ $book->type_arabic }}
                                                </span>
                                            </td>
                                            <td>{{ $book->updated_at->format('Y/m/d') }}</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('books.show', $book) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('books.status', $book) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="status" value="available">
                                                        <button type="submit" class="btn btn-sm btn-outline-warning">
                                                            <i class="fas fa-redo"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- حالة عدم وجود كتب -->
            @if($user->books->count() == 0)
                <div class="text-center py-5 my-5">
                    <div class="mb-4">
                        <i class="fas fa-book-open fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">لم تقم بإضافة أي كتب بعد</h4>
                    <p class="text-muted mb-4">ابدأ بإضافة كتبك للتبادل مع زملائك الطلاب</p>
                    <a href="{{ route('books.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle"></i> أضف أول كتاب
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection