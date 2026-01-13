@extends('layouts.app')

@section('title', 'تعديل الملف الشخصي')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-user-edit"></i> تعديل الملف الشخصي
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- الاسم -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label required">
                                    <i class="fas fa-user text-primary"></i> الاسم الكامل
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name"
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $user->name) }}"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- البريد الإلكتروني -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label required">
                                    <i class="fas fa-envelope text-primary"></i> البريد الإلكتروني
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email"
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email', $user->email) }}"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- رقم الواتساب -->
                            <div class="col-md-6 mb-3">
                                <label for="whatsapp" class="form-label">
                                    <i class="fab fa-whatsapp text-success"></i> رقم واتساب
                                </label>
                                <input type="text" 
                                       name="whatsapp" 
                                       id="whatsapp"
                                       class="form-control @error('whatsapp') is-invalid @enderror" 
                                       value="{{ old('whatsapp', $user->whatsapp) }}"
                                       placeholder="059XXXXXXX أو +97059XXXXXXX">
                                <small class="text-muted">اختياري - سيتم استخدامه للتواصل معك بشأن الكتب</small>
                                <small class="text-muted d-block mt-1">
                                    أمثلة: 0591234567, 0561234567, +970591234567, +972591234567
                                </small>
                                @error('whatsapp')
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
                                        <option value="{{ $key }}" {{ old('region', $user->region) == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('region')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- الجامعة -->
                        <div class="mb-3">
                            <label for="university" class="form-label">
                                <i class="fas fa-university text-primary"></i> الجامعة/المؤسسة التعليمية
                            </label>
                            <input type="text" 
                                   name="university" 
                                   id="university"
                                   class="form-control @error('university') is-invalid @enderror" 
                                   value="{{ old('university', $user->university) }}"
                                   placeholder="مثال: جامعة الأقصى">
                            @error('university')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- تغيير كلمة المرور -->
                        <div class="card border-info mb-4">
                            <div class="card-header bg-info text-white">
                                <i class="fas fa-key"></i> تغيير كلمة المرور
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> اترك الحقول فارغة إذا كنت لا تريد تغيير كلمة المرور.
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="current_password" class="form-label">
                                            <i class="fas fa-lock text-primary"></i> كلمة المرور الحالية
                                        </label>
                                        <input type="password" 
                                               name="current_password" 
                                               id="current_password"
                                               class="form-control @error('current_password') is-invalid @enderror">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="new_password" class="form-label">
                                            <i class="fas fa-lock text-primary"></i> كلمة المرور الجديدة
                                        </label>
                                        <input type="password" 
                                               name="new_password" 
                                               id="new_password"
                                               class="form-control @error('new_password') is-invalid @enderror">
                                        <div class="password-strength mt-2">
                                            <div class="password-strength-meter"></div>
                                        </div>
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="new_password_confirmation" class="form-label">
                                            <i class="fas fa-lock text-primary"></i> تأكيد كلمة المرور الجديدة
                                        </label>
                                        <input type="password" 
                                               name="new_password_confirmation" 
                                               id="new_password_confirmation"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- أزرار الإرسال -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> إلغاء
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> حفظ التعديلات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush