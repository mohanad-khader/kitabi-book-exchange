@extends('layouts.app')

@section('title', 'من نحن')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- عنوان الصفحة -->
                <div class="text-center mb-5">
                    <h1 class="display-5 fw-bold text-primary mb-3">
                        <i class="fas fa-info-circle"></i> من نحن
                    </h1>
                    <p class="lead text-muted">تعرف على قصة منصة "كتابي" ورسالتنا</p>
                </div>
                
                <!-- بطاقة التعريف -->
                <div class="card border-0 shadow-sm mb-5">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <div class="p-4 bg-primary text-white rounded-circle d-inline-block">
                                    <i class="fas fa-book fa-4x"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2 class="fw-bold mb-3">مرحباً بك في "كتابي"</h2>
                                <p class="lead">
                                    منصة مجانية لتبادل الكتب الدراسية بين الطلاب، تهدف إلى دعم التعليم وتشجيع ثقافة التشارك والعطاء.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- رؤيتنا ورسالتنا -->
                <div class="row mb-5">
                    <div class="col-md-6 mb-4">
                        <div class="card border-primary h-100">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">
                                    <i class="fas fa-eye"></i> رؤيتنا
                                </h4>
                            </div>
                            <div class="card-body">
                                <p>نطمح إلى بناء مجتمع طلابي مترابط، حيث تكون الكتب الدراسية في متناول كل طالب، بغض النظر عن وضعه المادي.</p>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success"></i>
                                        مجتمع يعتمد على التعاون وليس التنافس
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success"></i>
                                        تقليل الهدر والاستهلاك غير الضروري
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success"></i>
                                        جعل التعليم أكثر استدامة
                                    </li>
                                    <li>
                                        <i class="fas fa-check text-success"></i>
                                        تمكين الطلاب من مساعدة بعضهم البعض
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="card border-success h-100">
                            <div class="card-header bg-success text-white">
                                <h4 class="mb-0">
                                    <i class="fas fa-bullseye"></i> رسالتنا
                                </h4>
                            </div>
                            <div class="card-body">
                                <p>توفير منصة بسيطة وآمنة تربط الطلاب الذين يملكون كتباً لا يحتاجونها بزملائهم الباحثين عنها.</p>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success"></i>
                                        إزالة الحواجز المالية والتقنية
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success"></i>
                                        تبسيط عملية تبادل الكتب
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success"></i>
                                        الحفاظ على الخصوصية والأمان
                                    </li>
                                    <li>
                                        <i class="fas fa-check text-success"></i>
                                        تشجيع ثقافة العطاء والتشارك
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- قيمنا -->
                <div class="card border-warning mb-5">
                    <div class="card-header bg-warning text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-heart"></i> قيمنا الأساسية
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 text-center mb-4">
                                <div class="p-3 border rounded h-100">
                                    <i class="fas fa-hand-holding-heart fa-3x text-danger mb-3"></i>
                                    <h5 class="fw-bold">المجانية</h5>
                                    <p class="text-muted">المنصة مجانية 100%، لا عمولات ولا رسوم</p>
                                </div>
                            </div>
                            
                            <div class="col-md-3 text-center mb-4">
                                <div class="p-3 border rounded h-100">
                                    <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                                    <h5 class="fw-bold">الأمان</h5>
                                    <p class="text-muted">نحمي خصوصيتك ونضمن التواصل الآمن</p>
                                </div>
                            </div>
                            
                            <div class="col-md-3 text-center mb-4">
                                <div class="p-3 border rounded h-100">
                                    <i class="fas fa-users fa-3x text-success mb-3"></i>
                                    <h5 class="fw-bold">المجتمع</h5>
                                    <p class="text-muted">نبني مجتمعاً طلابياً مترابطاً ومتعاوناً</p>
                                </div>
                            </div>
                            
                            <div class="col-md-3 text-center mb-4">
                                <div class="p-3 border rounded h-100">
                                    <i class="fas fa-leaf fa-3x text-info mb-3"></i>
                                    <h5 class="fw-bold">الاستدامة</h5>
                                    <p class="text-muted">نساهم في تقليل الهدر وحماية البيئة</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- كيف بدأنا -->
                <div class="card border-info mb-5">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-history"></i> كيف بدأنا
                        </h4>
                    </div>
                    <div class="card-body">
                        <p>بدأت فكرة "كتابي" من ملاحظة بسيطة: الكثير من الطلاب يملكون كتباً دراسية لم يعودوا بحاجة إليها، بينما يبحث طلاب آخرون عن نفس هذه الكتب بأسعار معقولة.</p>
                        <p>لاحظنا أن:</p>
                        <ul>
                            <li class="mb-2">الكتب الدراسية الجديدة باهظة الثمن</li>
                            <li class="mb-2">لا توجد طريقة منظمة لتبادل الكتب المجانية</li>
                            <li class="mb-2">صعوبة التواصل بين الطلاب الراغبين في التبادل</li>
                            <li class="mb-2">الكثير من الكتب الجيدة ترمى أو تهمل</li>
                        </ul>
                        <p>من هنا، ولدت فكرة إنشاء منصة بسيطة تربط بين هؤلاء الطلاب، لإزالة جميع الحواجز وتسهيل عملية التبادل.</p>
                    </div>
                </div>
                
                <!-- فريقنا -->
                <div class="card border-secondary">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-users-cog"></i> من وراء المنصة
                        </h4>
                    </div>
                    <div class="card-body">
                        <p>"كتابي" هي مبادرة طلابية بدأها مجموعة من الطلاب الذين يؤمنون بقوة التعليم وقيمة التعاون. نحن:</p>
                        <div class="row text-center">
                            <div class="col-md-4 mb-4">
                                <div class="p-3 border rounded h-100">
                                    <div class="mb-3">
                                        <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                                    </div>
                                    <h5 class="fw-bold">طلاب</h5>
                                    <p class="text-muted">نفهم احتياجات الطلاب لأننا طلاب أيضاً</p>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <div class="p-3 border rounded h-100">
                                    <div class="mb-3">
                                        <i class="fas fa-code fa-3x text-success"></i>
                                    </div>
                                    <h5 class="fw-bold">مطورون</h5>
                                    <p class="text-muted">نطور الحلول التقنية التي تسهل حياتنا</p>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <div class="p-3 border rounded h-100">
                                    <div class="mb-3">
                                        <i class="fas fa-hands-helping fa-3x text-warning"></i>
                                    </div>
                                    <h5 class="fw-bold">متطوعون</h5>
                                    <p class="text-muted">نعمل بلا مقابل لخدمة مجتمعنا الطلابي</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- دعوة للانضمام -->
                <div class="text-center mt-5">
                    <div class="p-4 bg-light rounded">
                        <h3 class="fw-bold mb-3">كن جزءاً من رحلتنا</h3>
                        <p class="lead mb-4">ساعدنا في بناء مجتمع أفضل للطلاب</p>
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus"></i> انضم إلينا
                            </a>
                            <a href="{{ route('books.index') }}" class="btn btn-success btn-lg">
                                <i class="fas fa-book-open"></i> ابدأ التبادل
                            </a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-envelope"></i> تواصل معنا
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection