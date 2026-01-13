@extends('layouts.app')

@section('title', 'كيف تعمل المنصة')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- عنوان الصفحة -->
                <div class="text-center mb-5">
                    <h1 class="display-5 fw-bold text-primary mb-3">
                        <i class="fas fa-cogs"></i> كيف تعمل منصة "كتابي"؟
                    </h1>
                    <p class="lead text-muted">دليل خطوة بخطوة لاستخدام المنصة بفعالية وأمان</p>
                </div>
                
                <!-- خطوات العمل -->
                <div class="card border-0 shadow-sm mb-5">
                    <div class="card-body p-4">
                        <div class="row">
                            <!-- الخطوة 1 -->
                            <div class="col-md-6 mb-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <span class="display-6 fw-bold text-primary">1</span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h4 class="fw-bold mb-3">إنشاء حساب مجاني</h4>
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                سجل باستخدام بريدك الإلكتروني
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                أضف معلوماتك الشخصية (الاسم، المنطقة)
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                أضف رقم واتساب للتواصل (اختياري)
                                            </li>
                                            <li>
                                                <i class="fas fa-check-circle text-success"></i>
                                                انتهيت خلال دقيقة واحدة!
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- الخطوة 2 -->
                            <div class="col-md-6 mb-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <span class="display-6 fw-bold text-success">2</span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h4 class="fw-bold mb-3">إضافة الكتب للتبادل</h4>
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                اختر "إضافة كتاب جديد"
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                أدخل بيانات الكتاب (العنوان، المؤلف، التصنيف)
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                اختر النوع: مجاني (تبرع) أو مدفوع (بيع)
                                            </li>
                                            <li>
                                                <i class="fas fa-check-circle text-success"></i>
                                                اختر منطقتك وقم بنشر الكتاب
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- الخطوة 3 -->
                            <div class="col-md-6 mb-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <span class="display-6 fw-bold text-warning">3</span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h4 class="fw-bold mb-3">البحث والاكتشاف</h4>
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                ابحث عن كتب باستخدام الكلمات المفتاحية
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                صفّف النتائج حسب المنطقة، النوع، التصنيف
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                شاهد تفاصيل الكتاب وصورته
                                            </li>
                                            <li>
                                                <i class="fas fa-check-circle text-success"></i>
                                                اقرأ وصف الكتاب وحالته
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- الخطوة 4 -->
                            <div class="col-md-6 mb-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <span class="display-6 fw-bold text-danger">4</span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h4 class="fw-bold mb-3">التواصل المباشر</h4>
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                اضغط على زر "تواصل عبر واتساب"
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                ستفتح محادثة واتساب تلقائياً
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                ستجد رسالة جاهزة باسم الكتاب
                                            </li>
                                            <li>
                                                <i class="fas fa-check-circle text-success"></i>
                                                ابدأ المحادثة مباشرة مع البائع
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- الخطوة 5 -->
                            <div class="col-md-6 mb-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <span class="display-6 fw-bold text-info">5</span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h4 class="fw-bold mb-3">الاتفاق والترتيب</h4>
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                اتفق مع البائع على السعر (إن وجد)
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                حدد مكان عام للقاء في المنطقة
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                اختر وقتاً مناسباً للطرفين
                                            </li>
                                            <li>
                                                <i class="fas fa-check-circle text-success"></i>
                                                البائع سيغير حالة الكتاب لـ"قيد التفاوض"
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- الخطوة 6 -->
                            <div class="col-md-6 mb-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <span class="display-6 fw-bold text-dark">6</span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h4 class="fw-bold mb-3">اللقاء وإتمام الصفقة</h4>
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                تقابل في المكان والوقت المتفق عليه
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                تأكد من حالة الكتاب
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success"></i>
                                                الدفع نقداً عند الاستلام (إن وجد)
                                            </li>
                                            <li>
                                                <i class="fas fa-check-circle text-success"></i>
                                                البائع يغير حالة الكتاب لـ"تم التبادل"
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- نصائح الأمان -->
                <div class="card border-warning shadow-sm mb-5">
                    <div class="card-header bg-warning text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-shield-alt"></i> نصائح أمان هامة
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fas fa-map-marker-alt text-danger fa-lg me-3 mt-1"></i>
                                    <div>
                                        <h5 class="fw-bold">اللقاء في أماكن عامة</h5>
                                        <p class="text-muted mb-0">اختر أماكن عامة وآمنة للقاء، مثل المقاهي، الحدائق العامة، أو أمام المؤسسات المعروفة.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fas fa-money-bill-wave text-success fa-lg me-3 mt-1"></i>
                                    <div>
                                        <h5 class="fw-bold">الدفع عند الاستلام فقط</h5>
                                        <p class="text-muted mb-0">لا تقم بالدفع المسبق أبداً. الدفع يكون نقداً فقط عند استلام الكتاب والتأكد من حالته.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fas fa-user-shield text-primary fa-lg me-3 mt-1"></i>
                                    <div>
                                        <h5 class="fw-bold">الحفاظ على الخصوصية</h5>
                                        <p class="text-muted mb-0">لا تشارك عنوان منزلك أو معلومات شخصية حساسة. المنصة تعرض المنطقة العامة فقط.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fas fa-book-open text-info fa-lg me-3 mt-1"></i>
                                    <div>
                                        <h5 class="fw-bold">التأكد من حالة الكتاب</h5>
                                        <p class="text-muted mb-0">تأكد من حالة الكتاب المادية قبل الشراء، واقرأ الوصف جيداً.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- أسئلة شائعة -->
                <div class="card border-info shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-question-circle"></i> أسئلة شائعة
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="faqAccordion">
                            <!-- سؤال 1 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        هل المنصة مجانية حقاً؟
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        نعم، المنصة مجانية 100% للمستخدمين. لا توجد اشتراكات، ولا عمولات على المبيعات، ولا رسوم إطلاقاً.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- سؤال 2 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        كيف يتم التواصل بين البائع والمشتري؟
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        التواصل يتم مباشرة عبر واتساب. عندما تجد كتاباً مهتماً به، اضغط على زر "تواصل عبر واتساب" وسيتم فتح محادثة واتساب مع البائع تلقائياً.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- سؤال 3 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                        هل يمكنني إضافة كتب مجانية؟
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        نعم، يمكنك إضافة كتب للتبرع بها مجاناً. اختر "مجاني" عند إضافة الكتاب.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- سؤال 4 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                        كيف أضمن سلامتي أثناء التبادل؟
                                    </button>
                                </h2>
                                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>التقاء في أماكن عامة مزدحمة وآمنة</li>
                                            <li>الدفع نقداً فقط عند استلام الكتاب</li>
                                            <li>تأكد من حالة الكتاب قبل الشراء</li>
                                            <li>لا تشارك معلوماتك الشخصية الحساسة</li>
                                            <li>أحضر معك شخصاً إذا أمكن</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- سؤال 5 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                        ماذا أفعل إذا لم أستلم الكتاب أو كان تالفاً؟
                                    </button>
                                </h2>
                                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        ننصحك بالتأكد من حالة الكتاب قبل الدفع. إذا كان الكتاب تالفاً أو غير مطابق للوصف، يمكنك رفض الشراء. ننصح أيضاً بالتواصل الجيد مع البائع قبل اللقاء للتفاهم على التفاصيل.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- دعوة للانضمام -->
                <div class="text-center mt-5">
                    @auth
                        <a href="{{ route('books.create') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus-circle"></i> ابدأ بإضافة كتابك الأول
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus"></i> انضم إلينا الآن مجاناً
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection