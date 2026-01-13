@extends('layouts.app')

@section('title', 'الشروط والأحكام')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h3 mb-0">
                            <i class="fas fa-file-contract"></i> الشروط والأحكام
                        </h1>
                        <p class="mb-0 opacity-75">آخر تحديث: {{ date('Y/m/d') }}</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <p class="lead">
                                مرحباً بك في منصة "كتابي". يرجى قراءة هذه الشروط والأحكام بعناية قبل استخدام المنصة. استخدامك للمنصة يعني موافقتك على هذه الشروط.
                            </p>
                        </div>
                        
                        <!-- القبول -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-check-circle"></i> 1. القبول بالشروط
                            </h3>
                            <p>بإنشائك لحساب أو استخدامك لمنصة "كتابي"، فإنك توافق على الالتزام بهذه الشروط والأحكام. إذا كنت لا توافق على أي جزء من هذه الشروط، يرجى عدم استخدام المنصة.</p>
                        </div>
                        
                        <!-- وصف الخدمة -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-info-circle"></i> 2. وصف الخدمة
                            </h3>
                            <p>"كتابي" هي منصة إلكترونية مجانية تربط بين:</p>
                            <ul>
                                <li class="mb-2"><strong>المانحين:</strong> طلاب يريدون التبرع بكتبهم مجاناً</li>
                                <li class="mb-2"><strong>المحتاجين:</strong> طلاب يبحثون عن كتب مجانية</li>
                                <li class="mb-2"><strong>البائعين:</strong> طلاب يبيعون كتبهم بأسعار رمزية</li>
                            </ul>
                            <div class="alert alert-info">
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>ملاحظة:</strong> المنصة توفر وسيلة للتواصل فقط. نحن لا نشارك في عملية البيع أو التبادل، ولا نتحمل مسؤولية أي نزاعات تنشأ بين المستخدمين.
                            </div>
                        </div>
                        
                        <!-- مسؤوليات المستخدم -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-user-check"></i> 3. مسؤوليات المستخدم
                            </h3>
                            <p>أنت توافق على:</p>
                            <ul>
                                <li class="mb-2">توفير معلومات صحيحة ودقيقة عند التسجيل</li>
                                <li class="mb-2">الحفاظ على سرية حسابك وكلمة المرور</li>
                                <li class="mb-2">الإبلاغ عن أي استخدام غير مصرح لحسابك</li>
                                <li class="mb-2">عدم استخدام المنصة لأي أغراض غير قانونية</li>
                                <li class="mb-2">عدم إضافة كتب محمية بحقوق نشر أو غير قانونية</li>
                                <li class="mb-2">تقديم وصف دقيق لحالة الكتب التي تضيفها</li>
                                <li class="mb-2">عدم استخدام المنصة للترويج لمنتجات أو خدمات أخرى</li>
                                <li class="mb-2">عدم محاولة اختراق المنصة أو تعطيلها</li>
                            </ul>
                        </div>
                        
                        <!-- عملية التبادل -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-exchange-alt"></i> 4. عملية التبادل
                            </h3>
                            <p>أنت توافق على:</p>
                            <ul>
                                <li class="mb-2">الالتزام بالأسعار التي تضعها للكتب المدفوعة</li>
                                <li class="mb-2">الدفع نقداً فقط عند استلام الكتاب</li>
                                <li class="mb-2">التقاء في أماكن عامة وآمنة فقط</li>
                                <li class="mb-2">تحديث حالة الكتاب بعد إتمام الصفقة</li>
                                <li class="mb-2">التواصل باحترام مع المستخدمين الآخرين</li>
                            </ul>
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>تحذير:</strong> أنت تتحمل مسؤولية إتمام عمليات البيع والشراء بأمان. لا نتحمل مسؤولية أي خسائر أو أضرار ناتجة عن عمليات التبادل.
                            </div>
                        </div>
                        
                        <!-- المحتوى -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-photo-video"></i> 5. المحتوى
                            </h3>
                            <p>أنت تملك المحتوى الذي تضيفه للمنصة. بإضافتك للمحتوى، فإنك تمنحنا ترخيصاً غير حصري وقابلاً للترخيص من الباطن لاستخدام ونسخ وتعديل وعرض وتوزيع هذا المحتوى على المنصة.</p>
                            <p>أنت توافق على عدم إضافة أي محتوى:</p>
                            <ul>
                                <li class="mb-2">غير قانوني أو ضار أو تهديدي</li>
                                <li class="mb-2">ينتهك حقوق الملكية الفكرية للآخرين</li>
                                <li class="mb-2">تحتوي على فيروسات أو برمجيات خبيثة</li>
                                <li class="mb-2">مضلل أو احتيالي</li>
                                <li class="mb-2">غير لائق أو مسيء</li>
                            </ul>
                        </div>
                        
                        <!-- الإنهاء -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-ban"></i> 6. الإنهاء
                            </h3>
                            <p>نحتفظ بالحق في إنهاء أو تعليق حسابك أو وصولك للمنصة فوراً، دون إشعار مسبق أو مسؤولية، لأي سبب بما في ذلك على سبيل المثال لا الحصر انتهاكك لهذه الشروط.</p>
                        </div>
                        
                        <!-- إخلاء المسؤولية -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-hand-paper"></i> 7. إخلاء المسؤولية
                            </h3>
                            <p>المنصة مقدمة "كما هي" و"كما هي متاحة". نحن لا نقدم أي ضمانات، صريحة أو ضمنية، بما في ذلك على سبيل المثال لا الحصر ضمانات البيعية أو الملاءمة لغرض معين.</p>
                            <p>لا نضمن أن:</p>
                            <ul>
                                <li class="mb-2">المنصة ستكون متاحة دون انقطاع أو خالية من الأخطاء</li>
                                <li class="mb-2">الكتب المعروضة ستكون متاحة أو في الحالة الموصوفة</li>
                                <li class="mb-2">المستخدمين سيكونون صادقين في وصفاتهم</li>
                            </ul>
                        </div>
                        
                        <!-- المسؤولية -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-balance-scale"></i> 8. حدود المسؤولية
                            </h3>
                            <p>لن نكون مسؤولين أمامك أو أمام أي طرف ثالث عن أي أضرار مباشرة أو غير مباشرة أو تبعية أو عرضية أو عقابية، بما في ذلك على سبيل المثال لا الحصر فقدان الأرباح أو البيانات، الناشئة عن أو المتعلقة باستخدامك للمنصة.</p>
                        </div>
                        
                        <!-- التعديلات -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-edit"></i> 9. تعديل الشروط
                            </h3>
                            <p>نحتفظ بالحق في تعديل هذه الشروط في أي وقت. سنقوم بنشر الإشعار بالتغييرات على المنصة. استمرارك في استخدام المنصة بعد التغييرات يعني موافقتك على الشروط المعدلة.</p>
                        </div>
                        
                        <!-- القانون الحاكم -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-gavel"></i> 10. القانون الحاكم
                            </h3>
                            <p>تخضع هذه الشروط وتفسر وفقاً لقوانين فلسطين. أي نزاعات تنشأ عن أو تتعلق بهذه الشروط ستخضع للاختصاص الحصري لمحاكم فلسطين.</p>
                        </div>
                        
                        <!-- الاتصال -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-headset"></i> 11. الاتصال بنا
                            </h3>
                            <p>إذا كان لديك أي أسئلة حول هذه الشروط والأحكام، يرجى التواصل معنا عبر:</p>
                            <ul>
                                <li>صفحة "اتصل بنا" على المنصة</li>
                                <li>البريد الإلكتروني: support@kitabi.example.com</li>
                            </ul>
                        </div>
                        
                        <!-- الموافقة النهائية -->
                        <div class="alert alert-success">
                            <div class="d-flex">
                                <i class="fas fa-file-signature fa-2x me-3"></i>
                                <div>
                                    <h5 class="fw-bold">التأكيد والموافقة</h5>
                                    <p class="mb-0">باستخدامك لمنصة "كتابي"، فإنك تؤكد أنك قد قرأت وفهمت ووافقت على الالتزام بهذه الشروط والأحكام.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection