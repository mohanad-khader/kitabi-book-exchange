// ===== JavaScript الرئيسي للمنصة =====


document.addEventListener('DOMContentLoaded', function() {
    // مسح حقل البحث
    const searchInput = document.getElementById('search-input');
    const clearSearchBtn = document.getElementById('clear-search');
    
    if (searchInput && clearSearchBtn) {
        searchInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                clearSearchBtn.style.display = 'block';
            } else {
                clearSearchBtn.style.display = 'none';
            }
        });
        
        // البحث الفوري (debounce)
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.trim() !== '') {
                    document.getElementById('search-form').submit();
                }
            }, 800);
        });
    }
    
    // إعادة تعيين الفلاتر
    const resetFiltersBtn = document.getElementById('reset-filters');
    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', function() {
            // مسح جميع الحقول في الفورم
            const form = document.getElementById('filter-form');
            const inputs = form.querySelectorAll('input, select');
            
            inputs.forEach(input => {
                if (input.type === 'text' || input.type === 'search') {
                    input.value = '';
                } else if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                }
            });
            
            // إرسال الفورم
            form.submit();
        });
    }
    
    // فلترة تلقائية عند تغيير القيم
    const filterSelects = document.querySelectorAll('#filter-form select');
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            // إذا كانت قيمة فارغة، انتظر حتى يتم اختيار قيمة
            if (this.value !== '') {
                document.getElementById('filter-form').submit();
            }
        });
    });
    
    // تظليل الفلاتر النشطة
    function highlightActiveFilters() {
        const urlParams = new URLSearchParams(window.location.search);
        
        // تحديث خلفية الأزرار النشطة
        const activeButtons = document.querySelectorAll('.btn-outline-success, .btn-outline-warning, .btn-outline-info');
        activeButtons.forEach(btn => {
            btn.classList.remove('filter-active');
        });
        
        // إضافة خلفية للفلاتر النشطة
        const params = ['type', 'category', 'region'];
        params.forEach(param => {
            const value = urlParams.get(param);
            if (value) {
                const activeBtn = document.querySelector(`a[href*="${param}=${value}"]`);
                if (activeBtn) {
                    activeBtn.classList.add('filter-active');
                }
            }
        });
    }
    
    highlightActiveFilters();
    
    // تحسين عرض البطاقات
    const bookCards = document.querySelectorAll('.book-card');
    bookCards.forEach(card => {
        // تحسين ارتفاع البطاقات المتساوي
        card.style.display = 'flex';
        card.style.flexDirection = 'column';
    });
});

document.addEventListener('DOMContentLoaded', function() {
    
    // تهيئة tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // تهيئة popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    // إدارة رسائل التنبيه التلقائية
    const alerts = document.querySelectorAll('.alert.auto-dismiss');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
    
    // التحقق من قوة كلمة المرور
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    passwordInputs.forEach(input => {
        input.addEventListener('input', function() {
            const meter = this.nextElementSibling?.querySelector('.password-strength-meter');
            if (meter) {
                const password = this.value;
                let strength = 0;
                
                if (password.length >= 8) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;
                
                let width = 0;
                let className = '';
                
                switch(strength) {
                    case 0:
                    case 1:
                        width = 25;
                        className = 'strength-weak';
                        break;
                    case 2:
                    case 3:
                        width = 60;
                        className = 'strength-medium';
                        break;
                    case 4:
                        width = 100;
                        className = 'strength-strong';
                        break;
                }
                
                meter.style.width = width + '%';
                meter.className = 'password-strength-meter ' + className;
            }
        });
    });
    
    // التحقق من رقم الواتساب
    const whatsappInputs = document.querySelectorAll('input[name="whatsapp"]');
    whatsappInputs.forEach(input => {
        input.addEventListener('blur', function() {
            const value = this.value.trim();
            if (!value) return;
            
            // أنماط مسموحة كاملة - يجب أن تكون مطابقة تماماً للأنماط المطلوبة
            const patterns = [
                /^(059|056)\d{7}$/,              // 059xxxxxxx, 056xxxxxxx (7 أرقام بعد 059/056)
                /^\+972(59|56)\d{7}$/,           // +97259xxxxxxx, +97256xxxxxxx
                /^\+970(59|56)\d{7}$/,           // +97059xxxxxxx, +97056xxxxxxx
                /^00972(59|56)\d{7}$/,           // 0097259xxxxxxx, 0097256xxxxxxx
                /^00970(59|56)\d{7}$/            // 0097059xxxxxxx, 0097056xxxxxxx
            ];
            
            let isValid = false;
            for (const pattern of patterns) {
                if (pattern.test(value)) {
                    isValid = true;
                    break;
                }
            }
            
            if (!isValid) {
                this.classList.add('is-invalid');
                        
                // البحث عن عنصر invalid-feedback الحالي
                let existingError = this.parentNode.querySelector('.invalid-feedback.whatsapp-error');
                        
                // إذا لم يكن موجوداً، قم بإنشائه
                if (!existingError) {
                    existingError = document.createElement('div');
                    existingError.className = 'invalid-feedback whatsapp-error';
                    this.parentNode.appendChild(existingError);
                }

                existingError.innerHTML = `
                    <strong>رقم غير صحيح!</strong><br>
                    <small>التنسيقات المقبولة:</small><br>
                    <small>• 0591234567 أو 0561234567</small><br>
                    <small>• +972591234567 أو +972561234567</small><br>
                    <small>• +970591234567 أو +970561234567</small><br>
                    <small>• 00972591234567 أو 00972561234567</small><br>
                    <small>• 00970591234567 أو 00970561234567</small>
                `;
            } else {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');

                // إزالة رسالة الخطأ الخاصة بالواتساب فقط
                const whatsappError = this.parentNode.querySelector('.invalid-feedback.whatsapp-error');
                if (whatsappError) {
                    whatsappError.remove();
                }
            }
        });
    });

    //  Prevent JavaScript from Interfering with Server Validation for whatsapp Number
    const forms = document.querySelectorAll('form[action*="register"], form[action*="profile"]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // مسح جميع أخطاء JavaScript قبل الإرسال
            const jsErrors = this.querySelectorAll('.invalid-feedback.whatsapp-error');
            jsErrors.forEach(error => error.remove());

            const whatsappInputs = this.querySelectorAll('input[name="whatsapp"]');
            whatsappInputs.forEach(input => {
                input.classList.remove('is-invalid', 'is-valid');
            });
        });
    });
    
    // إدارة حالة الكتاب (قيد التفاوض - تم التبادل)
    const statusButtons = document.querySelectorAll('.book-status-btn');
    statusButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const bookId = this.dataset.bookId;
            const newStatus = this.dataset.status;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            
            if (confirm('هل أنت متأكد من تغيير حالة الكتاب؟')) {
                fetch(`/books/${bookId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('حدث خطأ أثناء تغيير الحالة');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ في الاتصال');
                });
            }
        });
    });
    
    // البحث الفوري (debounce)
    let searchTimeout;
    const searchInput = document.getElementById('book-search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                this.form.submit();
            }, 500);
        });
    }
    
    // تحميل الصور
    const bookImages = document.querySelectorAll('.book-image');
    bookImages.forEach(img => {
        img.addEventListener('error', function() {
            this.src = '/images/default-book.jpg';
        });
    });
    
    // إضافة رسالة واتساب تلقائية
    const whatsappButtons = document.querySelectorAll('.whatsapp-btn');
    whatsappButtons.forEach(button => {
        if (button.dataset.message) {
            button.addEventListener('click', function(e) {
                if (!confirm('سيتم فتح محادثة واتساب. هل تريد المتابعة؟')) {
                    e.preventDefault();
                }
            });
        }
    });
    
    // رسالة ترحيب عند أول زيارة
    if (!localStorage.getItem('welcomeShown')) {
        setTimeout(() => {
            const welcomeAlert = document.createElement('div');
            welcomeAlert.className = 'alert alert-info alert-dismissible fade show position-fixed bottom-0 end-0 m-3';
            welcomeAlert.style.zIndex = '1050';
            welcomeAlert.style.maxWidth = '350px';
            welcomeAlert.innerHTML = `
                <h5>مرحباً بك في منصة كتابي! 📚</h5>
                <p>ابدأ رحلتك في تبادل الكتب الدراسية مع زملائك.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(welcomeAlert);
            localStorage.setItem('welcomeShown', 'true');
        }, 2000);
    }
});

// تنسيق صفحات المصادقة تلقائياً
function initializeAuthForms() {
    // تنسيق جميع حقول الإدخال في صفحات المصادقة
    const authInputs = document.querySelectorAll('.auth-form .form-control, .auth-form .form-select');
    authInputs.forEach(input => {
        // إضافة سمة required للأحقول الإلزامية
        if (input.hasAttribute('required')) {
            const label = input.previousElementSibling;
            if (label && label.classList.contains('form-label')) {
                // إضافة علامة النجمة للإلزامية
                if (!label.innerHTML.includes('*')) {
                    const requiredSpan = document.createElement('span');
                    requiredSpan.className = 'text-danger ms-1';
                    requiredSpan.textContent = '*';
                    label.appendChild(requiredSpan);
                }
            }
        }
        
        // إضافة تأثير التركيز
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
    
    // تنسيق الروابط في صفحات المصادقة
    const authLinks = document.querySelectorAll('.auth-links a, .auth-small-link');
    authLinks.forEach(link => {
        if (!link.classList.contains('btn')) {
            link.classList.add('auth-link-styled');
        }
    });
}

// تشغيل التنسيق عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    initializeAuthForms();
    
    // إذا كانت الصفحة تحتوي على فورم مصادقة
    if (document.querySelector('.auth-form')) {
        // إضافة أنماط إضافية
        const style = document.createElement('style');
        style.textContent = `
            .auth-form .form-group.focused .form-label {
                color: #667eea;
                font-weight: 700;
            }
            
            .auth-link-styled {
                transition: all 0.3s ease;
                padding: 2px 4px;
                border-radius: 4px;
            }
            
            .auth-link-styled:hover {
                background-color: rgba(102, 126, 234, 0.1);
            }
            
            .auth-form .form-control::placeholder,
            .auth-form .form-select::placeholder {
                color: #aaa;
                font-size: 0.9rem;
            }
        `;
        document.head.appendChild(style);
    }
});

// تحذير عند النقر على زر Google
document.addEventListener('DOMContentLoaded', function() {
    const googleButtons = document.querySelectorAll('.google-btn');
    
    googleButtons.forEach(button => {
        if (button.href.includes('auth/google')) {
            button.addEventListener('click', function(e) {
                // التحقق مما إذا كانت النافذة المنبثقة محجوبة
                if (!isPopupBlocked()) {
                    const confirmation = confirm('سيتم توجيهك إلى Google للمصادقة. هل تريد المتابعة؟');
                    if (!confirmation) {
                        e.preventDefault();
                    }
                }
            });
        }
    });
    
    // دالة للتحقق من حجب النوافذ المنبثقة
    function isPopupBlocked() {
        const width = 600;
        const height = 600;
        const left = (screen.width / 2) - (width / 2);
        const top = (screen.height / 2) - (height / 2);
        
        const popup = window.open('', 'google_auth', 
            `width=${width},height=${height},top=${top},left=${left}`);
        
        if (!popup || popup.closed || typeof popup.closed === 'undefined') {
            return true;
        } else {
            popup.close();
            return false;
        }
    }
});