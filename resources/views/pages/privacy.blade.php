@extends('layouts.app')

@section('title', 'سياسة الخصوصية')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h3 mb-0">
                            <i class="fas fa-user-shield"></i> سياسة الخصوصية
                        </h1>
                        <p class="mb-0 opacity-75">آخر تحديث: {{ date('Y/m/d') }}</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <p class="lead">
                                في منصة "كتابي"، نحن نقدّر خصوصيتك ونلتزم بحماية بياناتك الشخصية. تشرح سياسة الخصوصية هذه كيفية جمع واستخدام ومشاركة معلوماتك عند استخدامك لمنصتنا.
                            </p>
                        </div>
                        
                        <!-- المعلومات التي نجمعها -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-info-circle"></i> المعلومات التي نجمعها
                            </h3>
                            <p>نجمع أنواعاً مختلفة من المعلومات لتقديم خدماتنا وتحسينها:</p>
                            <ul>
                                <li class="mb-2">
                                    <strong>المعلومات التي تقدمها لنا:</strong>
                                    <ul>
                                        <li>الاسم الكامل</li>
                                        <li>البريد الإلكتروني</li>
                                        <li>رقم واتساب (اختياري)</li>
                                        <li>المنطقة (من بين 5 مناطق محددة)</li>
                                        <li>الجامعة/المؤسسة التعليمية (اختياري)</li>
                                        <li>معلومات الكتب التي تضيفها</li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>المعلومات التي نجمعها تلقائياً:</strong>
                                    <ul>
                                        <li>معلومات الجهاز والمتصفح</li>
                                        <li>سجلات الاستخدام</li>
                                        <li>عنوان IP</li>
                                        <li>الكوكيز (Cookies)</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- كيفية استخدام المعلومات -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-cogs"></i> كيفية استخدام المعلومات
                            </h3>
                            <p>نستخدم معلوماتك للأغراض التالية:</p>
                            <ul>
                                <li class="mb-2">تقديم خدمات المنصة والسماح لك بتبادل الكتب</li>
                                <li class="mb-2">تمكين التواصل بين المستخدمين عبر واتساب</li>
                                <li class="mb-2">تحسين وتطوير خدماتنا</li>
                                <li class="mb-2">إرسال إشعارات وإعلانات مهمة</li>
                                <li class="mb-2">حماية أمن وسلامة المنصة</li>
                                <li class="mb-2">الامتثال للقوانين واللوائح</li>
                            </ul>
                        </div>
                        
                        <!-- مشاركة المعلومات -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-share-alt"></i> مشاركة المعلومات
                            </h3>
                            <p><strong>نحن لا نبيع بياناتك الشخصية لأي طرف ثالث.</strong> قد نشارك معلوماتك في الحالات التالية:</p>
                            <ul>
                                <li class="mb-2">
                                    <strong>مع مستخدمين آخرين:</strong>
                                    <ul>
                                        <li>يظهر اسمك ومنطقتك مع الكتب التي تضيفها</li>
                                        <li>رقم واتساب يظهر فقط عند الضغط على زر التواصل</li>
                                        <li>لا نشارك عنوان بريدك الإلكتروني مع أي مستخدم</li>
                                    </ul>
                                </li>
                                <li class="mb-2">
                                    <strong>مع مقدمي الخدمات:</strong> مع مزودي الخدمات الذين يساعدوننا في تشغيل المنصة
                                </li>
                                <li class="mb-2">
                                    <strong>لأسباب قانونية:</strong> عند الالتزام بالقوانين أو حماية حقوقنا
                                </li>
                            </ul>
                        </div>
                        
                        <!-- الأمان -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-shield-alt"></i> الأمان
                            </h3>
                            <p>نتخذ تدابير أمنية معقولة لحماية معلوماتك من الوصول غير المصرح به أو التعديل أو الإفشاء أو التدمير:</p>
                            <ul>
                                <li class="mb-2">تشفير كلمات المرور</li>
                                <li class="mb-2">حماية من هجمات SQL Injection</li>
                                <li class="mb-2">التحقق من صحة بيانات الإدخال</li>
                                <li class="mb-2">الوصول المحدود إلى البيانات الحساسة</li>
                            </ul>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <strong>ملاحظة هامة:</strong> بينما نبذل قصارى جهدنا لحماية معلوماتك، لا يمكن ضمان الأمان الكامل لأي معلومات تنقل عبر الإنترنت.
                            </div>
                        </div>
                        
                        <!-- معلومات الاتصال -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-envelope"></i> معلومات الاتصال
                            </h3>
                            <p>إذا كان لديك أي أسئلة حول سياسة الخصوصية هذه، يرجى التواصل معنا عبر:</p>
                            <ul>
                                <li>البريد الإلكتروني: privacy@kitabi.example.com</li>
                                <li>صفحة اتصل بنا على المنصة</li>
                            </ul>
                        </div>
                        
                        <!-- التغييرات -->
                        <div class="mb-4">
                            <h3 class="h4 fw-bold mb-3 text-primary">
                                <i class="fas fa-history"></i> التغييرات على سياسة الخصوصية
                            </h3>
                            <p>قد نقوم بتحديث سياسة الخصوصية هذه من وقت لآخر. سنخطرك بأي تغييرات مهمة عن طريق نشر الإشعار على المنصة أو إرسال بريد إلكتروني إليك. ننصحك بمراجعة هذه الصفحة بشكل دوري.</p>
                        </div>
                        
                        <!-- الموافقة -->
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            باستخدامك لمنصة "كتابي"، فإنك توافق على شروط سياسة الخصوصية هذه.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection