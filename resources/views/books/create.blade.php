@extends('layouts.app')

@section('title', 'إضافة كتاب جديد - منصة كتابي')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle"></i> إضافة كتاب جديد
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" id="book-form">
                        @csrf
                        
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
                                       value="{{ old('title') }}"
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
                                       value="{{ old('author') }}"
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
                                      rows="4">{{ old('description') }}</textarea>
                            <small class="text-muted">يمكنك وصف حالة الكتاب، أي ملاحظات إضافية، أو سبب التبرع/البيع.</small>
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
                                    <option value="free" {{ old('type') == 'free' ? 'selected' : '' }}>مجاني (تبرع)</option>
                                    <option value="paid" {{ old('type') == 'paid' ? 'selected' : '' }}>مدفوع (بيع)</option>
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
                                       value="{{ old('price') }}"
                                       min="0" 
                                       max="999999.99" 
                                       step="0.01"
                                       placeholder="مثال: 20.50">
                                <small class="text-muted">للكتب المدفوعة فقط. اتركه فارغاً إذا كان الكتاب مجانياً.</small>
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
                                    <option value="university" {{ old('category') == 'university' ? 'selected' : '' }}>جامعي</option>
                                    <option value="school" {{ old('category') == 'school' ? 'selected' : '' }}>مدرسي</option>
                                    <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>عام</option>
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
                                       value="{{ old('subject') }}"
                                       placeholder="مثال: الرياضيات، الفيزياء...">
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- حالة الكتاب -->
                            <div class="col-md-6 mb-3">
                                <label for="condition" class="form-label required">
                                    <i class="fas fa-star text-primary"></i> حالة الكتاب
                                </label>
                                <select name="condition" 
                                        id="condition" 
                                        class="form-select @error('condition') is-invalid @enderror" 
                                        required>
                                    <option value="">اختر حالة الكتاب</option>
                                    <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>جديد</option>
                                    <option value="good" {{ old('condition') == 'good' ? 'selected' : '' }}>جيدة</option>
                                    <option value="acceptable" {{ old('condition') == 'acceptable' ? 'selected' : '' }}>مقبول</option>
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
                                        <option value="{{ $key }}" {{ old('region') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('region')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- صورة الكتاب -->
                        <div class="mb-4">
                            <label for="image" class="form-label">
                                <i class="fas fa-image text-primary"></i> صورة الكتاب
                            </label>
                            <input type="file" 
                                   name="image" 
                                   id="book_image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/*">
                            <small class="text-muted">اختياري - يمكنك رفع صورة للكتاب (الحجم الأقصى: 5MB)</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- معاينة الصورة -->
                            <div class="mt-3 text-center">
                                <img id="image-preview" 
                                     src="{{ asset('images/default-book.jpg') }}" 
                                     alt="معاينة الصورة" 
                                     class="img-fluid rounded border"
                                     style="max-height: 200px;">
                            </div>
                        </div>
                        
                        <!-- أزرار الإرسال -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-right"></i> عودة
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check-circle"></i> نشر الكتاب
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- نصائح -->
            <div class="card border-info mt-4">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-lightbulb"></i> نصائح هامة
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li class="mb-2">📸 صورة واضحة للكتاب تزيد من فرص بيعه/تبادله</li>
                        <li class="mb-2">✍️ وصف دقيق لحالة الكتاب يساعد المشتري في اتخاذ القرار</li>
                        <li class="mb-2">📍 اختر المنطقة الصحيحة لتسهيل عملية الاستلام</li>
                        <li class="mb-2">💰 ضع سعراً مناسباً للكتب المدفوعة</li>
                        <li class="mb-0">🔄 قم بتحديث حالة الكتاب بعد البيع/التبادل</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/books.js') }}"></script>
@endpush