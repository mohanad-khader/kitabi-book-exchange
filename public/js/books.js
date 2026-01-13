// ===== JavaScript الخاص بالكتب =====

document.addEventListener('DOMContentLoaded', function() {
    
    // معاينة الصورة قبل الرفع
    const imageInput = document.getElementById('book_image');
    const imagePreview = document.getElementById('image-preview');
    
    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                
                reader.addEventListener('load', function() {
                    imagePreview.src = reader.result;
                    imagePreview.classList.remove('d-none');
                });
                
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '/images/default-book.jpg';
            }
        });
    }
    
    // التحكم في حقل السعر حسب النوع
    const bookTypeSelect = document.getElementById('book_type');
    const priceField = document.getElementById('book_price_field');
    
    if (bookTypeSelect && priceField) {
        function togglePriceField() {
            if (bookTypeSelect.value === 'free') {
                priceField.classList.add('d-none');
                document.getElementById('book_price').value = '';
            } else {
                priceField.classList.remove('d-none');
            }
        }
        
        bookTypeSelect.addEventListener('change', togglePriceField);
        togglePriceField(); // التشغيل الأولي
    }
    
    // إعادة تعيين الفلترة
    const resetFiltersBtn = document.getElementById('reset-filters');
    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', function() {
            const form = this.closest('form');
            form.reset();
            window.location.href = form.action.split('?')[0];
        });
    }
    
    // مشاركة الكتاب
    const shareButtons = document.querySelectorAll('.share-btn');
    shareButtons.forEach(button => {
        button.addEventListener('click', function() {
            const bookUrl = this.dataset.url;
            const bookTitle = this.dataset.title;
            
            if (navigator.share) {
                navigator.share({
                    title: bookTitle,
                    text: 'شاهد هذا الكتاب على منصة كتابي',
                    url: bookUrl,
                });
            } else {
                // Fallback: نسخ الرابط
                navigator.clipboard.writeText(bookUrl)
                    .then(() => alert('تم نسخ رابط الكتاب!'))
                    .catch(() => {
                        // Fallback أقدم
                        const tempInput = document.createElement('input');
                        tempInput.value = bookUrl;
                        document.body.appendChild(tempInput);
                        tempInput.select();
                        document.execCommand('copy');
                        document.body.removeChild(tempInput);
                        alert('تم نسخ رابط الكتاب!');
                    });
            }
        });
    });
});