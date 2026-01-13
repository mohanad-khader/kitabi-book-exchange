@extends('layouts.app')

@section('title', 'تعديل كتاب: ' . $book->title)

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-warning text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-edit"></i> تعديل كتاب: {{ Str::limit($book->title, 50) }}
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($book->status == 'exchanged')
                        <div class="alert alert-info mb-4">
                            <i class="fas fa-info-circle"></i> 
                            هذا الكتاب تم تبادله بالفعل. يمكنك فقط تعديل المعلومات الأساسية.
                        </div>
                    @endif
                    
                    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- العنوان والمؤلف -->
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label required">
                                    <i class="fas fa-heading text-primary"></i> عنوان الكتاب
                                </label>
                                <input type="text" 
                                       name="title" 
                                       id="title"
                                       class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title', $book->title) }}"
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="author" class="form-label required">
                                    <i class="fas fa-user-pen text-primary"></i> اسم المؤلف
                                </label>
                                <input type="text" 
                                       name="author" 
                                       id="author"
                                       class="form-control @error('author') is-invalid @enderror" 
                                       value="{{ old('author', $book->author) }}"
                                       required>
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- الوصف -->
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left text-primary"></i> وصف الكتاب
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      rows="4">{{ old('description', $book->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <!-- النوع والسعر -->
                            <div class="col-md-6 mb-3">
                                <label for="type" class="form-label required">
                                    <i class="fas fa-tag text-primary"></i> نوع العرض
                                </label>
                                <select name="type" 
                                        id="book_type" 
                                        class="form-select @error('type') is-invalid @enderror" 
                                        required>
                                    <option value="">اختر نوع العرض</option>
                                    <option value="free" {{ old('type', $book->type) == 'free' ? 'selected' : '' }}>مجاني (تبرع)</option>
                                    <option value="paid" {{ old('type', $book->type) == 'paid' ? 'selected' : '' }}>مدفوع (بيع)</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3" id="book_price_field">
                                <label for="price" class="form-label">
                                    <i class="fas fa-money-bill-wave text-primary"></i> السعر (شيكل)
                                </label>
                                <input type="number" 
                                       name="price" 
                                       id="price"
                                       class="form-control @error('price') is-invalid @enderror" 
                                       value="{{ old('price', $book->price) }}"
                                       min="0" 
                                       max="999999.99" 
                                       step="0.01"
                                       placeholder="مثال: 20.50"
                                       {{ $book->type == 'free' ? 'disabled' : '' }}>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- التصنيف والمادة -->
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label required">
                                    <i class="fas fa-bookmark text-primary"></i> التصنيف
                                </label>
                                <select name="category" 
                                        id="category" 
                                        class="form-select @error('category') is-invalid @enderror" 
                                        required>
                                    <option value="">اختر التصنيف</option>
                                    <option value="university" {{ old('category', $book->category) == 'university' ? 'selected' : '' }}>جامعي</option>
                                    <option value="school" {{ old('category', $book->category) == 'school' ? 'selected' : '' }}>مدرسي</option>
                                    <option value="general" {{ old('category', $book->category) == 'general' ? 'selected' : '' }}>عام</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="subject" class="form-label">
                                    <i class="fas fa-book-open text-primary"></i> المادة/التخصص
                                </label>
                                <input type="text" 
                                       name="subject" 
                                       id="subject"
                                       class="form-control @error('subject') is-invalid @enderror" 
                                       value="{{ old('subject', $book->subject) }}"
                                       placeholder="مثال: الرياضيات، الفيزياء...">
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- حالة الكتاب الفيزيائية -->
                            <div class="col-md-6 mb-3">
                                <label for="condition" class="form-label required">
                                    <i class="fas fa-star text-primary"></i> حالة الكتاب
                                </label>
                                <select name="condition" 
                                        id="condition" 
                                        class="form-select @error('condition') is-invalid @enderror" 
                                        required>
                                    <option value="">اختر حالة الكتاب</option>
                                    <option value="new" {{ old('condition', $book->condition) == 'new' ? 'selected' : '' }}>جديد</option>
                                    <option value="good" {{ old('condition', $book->condition) == 'good' ? 'selected' : '' }}>جيدة</option>
                                    <option value="acceptable" {{ old('condition', $book->condition) == 'acceptable' ? 'selected' : '' }}>مقبول</option>
                                </select>
                                @error('condition')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- المنطقة -->
                            <div class="col-md-6 mb-3">
                                <label for="region" class="form-label required">
                                    <i class="fas fa-map-marker-alt text-primary"></i> المنطقة
                                </label>
                                <select name="region" 
                                        id="region" 
                                        class="form-select @error('region') is-invalid @enderror" 
                                        required>
                                    <option value="">اختر المنطقة</option>
                                    @foreach(['north_gaza' => 'شمال غزة', 'gaza' => 'غزة', 'central' => 'الوسطى', 'khan_younis' => 'خان يونس', 'rafah' => 'رفح'] as $key => $value)
                                        <option value="{{ $key }}" {{ old('region', $book->region) == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('region')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- حالة الكتاب (متاح/قيد التفاوض/تم التبادل) -->
                        <div class="mb-3">
                            <label for="status" class="form-label required">
                                <i class="fas fa-info-circle text-primary"></i> حالة الكتاب
                            </label>
                            <select name="status" 
                                    id="status" 
                                    class="form-select @error('status') is-invalid @enderror" 
                                    required>
                                <option value="available" {{ old('status', $book->status) == 'available' ? 'selected' : '' }}>متاح</option>
                                <option value="negotiating" {{ old('status', $book->status) == 'negotiating' ? 'selected' : '' }}>قيد التفاوض</option>
                                <option value="exchanged" {{ old('status', $book->status) == 'exchanged' ? 'selected' : '' }}>تم التبادل</option>
                            </select>
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> قيد التفاوض: يوجد شخص مهتم بالكتاب. تم التبادل: تم بيع/تبادل الكتاب.
                            </small>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- صورة الكتاب -->
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-image text-primary"></i> صورة الكتاب الحالية
                            </label>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    @if($book->image)
                                        <img src="{{ $book->image_url }}" 
                                             alt="صورة الكتاب الحالية" 
                                             class="img-fluid rounded border mb-3"
                                             style="max-height: 200px;">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   name="remove_image" 
                                                   id="remove_image" 
                                                   value="1">
                                            <label class="form-check-label text-danger" for="remove_image">
                                                <i class="fas fa-trash"></i> حذف الصورة الحالية
                                            </label>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle"></i> لا توجد صورة للكتاب حالياً
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="image" class="form-label">
                                        <i class="fas fa-upload text-primary"></i> رفع صورة جديدة
                                    </label>
                                    <input type="file" 
                                           name="image" 
                                           id="book_image"
                                           class="form-control @error('image') is-invalid @enderror"
                                           accept="image/*">
                                    <small class="text-muted">اختياري - سيتم استبدال الصورة الحالية</small>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- معاينة الصورة -->
                                    <div class="mt-3 text-center">
                                        <img id="image-preview" 
                                             src="{{ $book->image_url }}" 
                                             alt="معاينة الصورة" 
                                             class="img-fluid rounded border"
                                             style="max-height: 150px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- أزرار الإرسال -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('books.show', $book) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> إلغاء
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> حفظ التعديلات
                            </button>
                        </div>
                    </form>
                    
                    <!-- نموذج الحذف منفصل -->
                    <div class="mt-3">
                        <form action="{{ route('books.destroy', $book) }}" 
                              method="POST"
                              onsubmit="return confirm('هل أنت متأكد؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> حذف الكتاب
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/books.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // التحكم في حقل السعر حسب النوع
            const bookTypeSelect = document.getElementById('book_type');
            const priceField = document.getElementById('price');
            
            function togglePriceField() {
                if (bookTypeSelect.value === 'free') {
                    priceField.disabled = true;
                    priceField.value = '';
                } else {
                    priceField.disabled = false;
                }
            }
            
            bookTypeSelect.addEventListener('change', togglePriceField);
            togglePriceField();
        });
    </script>
@endpush