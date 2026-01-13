@extends('layouts.app')

@section('title', 'اتصل بنا')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- عنوان الصفحة -->
                <div class="text-center mb-5">
                    <h1 class="display-5 fw-bold text-primary mb-3">
                        <i class="fas fa-envelope"></i> اتصل بنا
                    </h1>
                    <p class="lead text-muted">نحن هنا لمساعدتك. تواصل معنا لأي استفسارات أو اقتراحات</p>
                </div>
                
                <div class="row">
                    <!-- معلومات الاتصال -->
                    <div class="col-lg-5 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">
                                    <i class="fas fa-info-circle"></i> معلومات الاتصال
                                </h4>
                            </div>
                            <div class="card-body">
                                <!-- البريد الإلكتروني -->
                                <div class="d-flex align-items-start mb-4">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-envelope fa-2x text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fw-bold">البريد الإلكتروني</h5>
                                        <p class="mb-1">للاقتراحات والشكاوى الفنية</p>
                                        <a href="mailto:support@kitabi.example.com" class="text-decoration-none">
                                            support@kitabi.example.com
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- وقت الاستجابة -->
                                <div class="d-flex align-items-start mb-4">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-clock fa-2x text-warning"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fw-bold">وقت الاستجابة</h5>
                                        <p class="mb-0">نحن نحاول الرد على جميع الرسائل خلال 24-48 ساعة</p>
                                    </div>
                                </div>
                                
                                <!-- الدعم -->
                                <div class="d-flex align-items-start mb-4">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-headset fa-2x text-success"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fw-bold">الدعم</h5>
                                        <p class="mb-1">للأسئلة حول استخدام المنصة</p>
                                        <a href="{{ route('how-it-works') }}" class="text-decoration-none">
                                            <i class="fas fa-arrow-left"></i> راجع صفحة "كيف تعمل"
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- تواصل اجتماعي -->
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-hashtag fa-2x text-info"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fw-bold">وسائل التواصل</h5>
                                        <p class="mb-2">تابعنا على وسائل التواصل الاجتماعي</p>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-decoration-none text-primary" 
                                               onclick="alert('الصفحة قيد الإنشاء')">
                                                <i class="fab fa-facebook fa-2x"></i>
                                            </a>
                                            <a href="#" class="text-decoration-none text-info" 
                                               onclick="alert('الصفحة قيد الإنشاء')">
                                                <i class="fab fa-twitter fa-2x"></i>
                                            </a>
                                            <a href="#" class="text-decoration-none text-danger" 
                                               onclick="alert('الصفحة قيد الإنشاء')">
                                                <i class="fab fa-instagram fa-2x"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- نموذج الاتصال -->
                    <div class="col-lg-7 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h4 class="mb-0">
                                    <i class="fas fa-paper-plane"></i> أرسل رسالة
                                </h4>
                            </div>
                            <div class="card-body p-4">
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                                    </div>
                                @endif
                                
                                <form id="contact-form">
                                    @csrf
                                    
                                    <!-- الاسم -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-user text-primary"></i> اسمك
                                        </label>
                                        <input type="text" 
                                               name="name" 
                                               id="name"
                                               class="form-control" 
                                               required
                                               value="{{ Auth::check() ? Auth::user()->name : '' }}">
                                    </div>
                                    
                                    <!-- البريد الإلكتروني -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope text-primary"></i> بريدك الإلكتروني
                                        </label>
                                        <input type="email" 
                                               name="email" 
                                               id="email"
                                               class="form-control" 
                                               required
                                               value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                    </div>
                                    
                                    <!-- نوع الرسالة -->
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">
                                            <i class="fas fa-tag text-primary"></i> نوع الرسالة
                                        </label>
                                        <select name="subject" id="subject" class="form-select" required>
                                            <option value="">اختر نوع الرسالة</option>
                                            <option value="استفسار">استفسار عام</option>
                                            <option value="مقترح">اقتراح لتطوير المنصة</option>
                                            <option value="مشكلة">مشكلة تقنية</option>
                                            <option value="إبلاغ">إبلاغ عن إساءة استخدام</option>
                                            <option value="تعاون">طلب تعاون أو شراكة</option>
                                            <option value="أخرى">أخرى</option>
                                        </select>
                                    </div>
                                    
                                    <!-- الرسالة -->
                                    <div class="mb-3">
                                        <label for="message" class="form-label">
                                            <i class="fas fa-comment-dots text-primary"></i> رسالتك
                                        </label>
                                        <textarea name="message" 
                                                  id="message" 
                                                  class="form-control" 
                                                  rows="6" 
                                                  required
                                                  placeholder="اكتب رسالتك هنا..."></textarea>
                                    </div>
                                    
                                    <!-- زر الإرسال -->
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg" id="send-btn">
                                            <i class="fas fa-paper-plane"></i> إرسال الرسالة
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- أسئلة شائعة -->
                <div class="card border-info mt-4">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-question-circle"></i> أسئلة متكررة قد تحتاج إجابتها
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded h-100">
                                    <h6 class="fw-bold">
                                        <i class="fas fa-question text-primary"></i> كيف أبلغ عن مشكلة في كتاب؟
                                    </h6>
                                    <p class="text-muted mb-0">استخدم نموذج الاتصال واختر "إبلاغ عن إساءة استخدام"، مع ذكر رابط الكتاب والمشكلة.</p>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded h-100">
                                    <h6 class="fw-bold">
                                        <i class="fas fa-question text-primary"></i> لدي فكرة لتطوير المنصة، كيف أشاركها؟
                                    </h6>
                                    <p class="text-muted mb-0">اختر "اقتراح لتطوير المنصة" في نموذج الاتصال، وسنكون سعداء بسماع أفكارك.</p>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="p-3 border rounded h-100">
                                    <h6 class="fw-bold">
                                        <i class="fas fa-question text-primary"></i> أريد التعاون أو الشراكة مع المنصة
                                    </h6>
                                    <p class="text-muted mb-0">اختر "طلب تعاون أو شراكة" في نموذج الاتصال، مع ذكر تفاصيل عرضك.</p>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="p-3 border rounded h-100">
                                    <h6 class="fw-bold">
                                        <i class="fas fa-question text-primary"></i> كيف أتعامل مع مشكلة في عملية التبادل؟
                                    </h6>
                                    <p class="text-muted mb-0">ننصح بالتواصل المباشر مع الطرف الآخر. إذا لم تحل المشكلة، يمكنك الإبلاغ عبر النموذج.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.getElementById('contact-form');
            const sendBtn = document.getElementById('send-btn');
            
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // تعطيل الزر أثناء الإرسال
                sendBtn.disabled = true;
                sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...';
                
                // محاكاة إرسال الرسالة (في الواقع، سيكون هناك اتصال بالخادم)
                setTimeout(function() {
                    // في التطبيق الحقيقي، هنا سيتم إرسال البيانات إلى الخادم
                    alert('شكراً لتواصلك معنا! سوف نرد عليك في أقرب وقت ممكن.');
                    
                    // إعادة تعيين النموذج
                    contactForm.reset();
                    
                    // إعادة تفعيل الزر
                    sendBtn.disabled = false;
                    sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i> إرسال الرسالة';
                }, 2000);
            });
        });
    </script>
@endpush