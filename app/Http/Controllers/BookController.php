<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of books with filters
     */
    public function index(Request $request)
    {
        $query = Book::available()->with('user');
        
        // البحث بالنص
        if ($request->has('search') && $request->search != '') {
            $query->search($request->search);
        }
        
        // التصفية حسب المنطقة
        if ($request->has('region') && $request->region != '') {
            $query->byRegion($request->region);
        }
        
        // التصفية حسب النوع
        if ($request->has('type') && $request->type != '') {
            $query->byType($request->type);
        }
        
        // التصفية حسب التصنيف
        if ($request->has('category') && $request->category != '') {
            $query->byCategory($request->category);
        }
        
        // الترتيب
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_low':
                $query->orderByRaw('CASE WHEN type = "free" THEN 0 ELSE price END ASC');
                break;
            case 'price_high':
                $query->orderByRaw('CASE WHEN type = "free" THEN 0 ELSE price END DESC');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
        }
        
        // 12 كتاب لكل صفحة (يعطي 4 صفوف × 3 بطاقات)
        $books = $query->paginate(12);
        
        // تمرير معاملات البحث للـ view
        $books->appends($request->except('page'));
        
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created book
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:200',
            'author' => 'required|string|max:100',
            'description' => 'nullable|string',
            'type' => 'required|in:free,paid',
            'price' => 'nullable|required_if:type,paid|numeric|min:0|max:999999.99',
            'category' => 'required|in:university,school,general',
            'subject' => 'nullable|string|max:100',
            'condition' => 'required|in:new,good,acceptable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
            'region' => 'required|in:north_gaza,gaza,central,khan_younis,rafah',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['user_id'] = Auth::id();
        
        // إذا كان الكتاب مجانياً، اجعل السعر null
        if ($request->type == 'free') {
            $data['price'] = null;
        }
    
        // رفع صورة الكتاب
        // رفع صورة الكتاب - الطريقة المبسطة
        if ($request->hasFile('image')) {
            // استخدم store مباشرة - سينشئ المجلد تلقائياً
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image'] = $imagePath;
        }

        $book = Book::create($data);

        return redirect()->route('books.show', $book)
            ->with('success', 'تم إضافة الكتاب بنجاح!');
    }

    /**
     * Display the specified book
     */
    public function show(Book $book)
    {
        // زيادة عدد المشاهدات
        $book->incrementViews();
        
        // تحميل بيانات المستخدم
        $book->load('user');
        
        // الحصول على كتب مشابهة
        $similarBooks = Book::available()
            ->where('id', '!=', $book->id)
            ->where(function($query) use ($book) {
                $query->where('category', $book->category)
                      ->orWhere('subject', 'like', '%' . $book->subject . '%');
            })
            ->with('user')
            ->limit(4)
            ->get();

        return view('books.show', compact('book', 'similarBooks'));
    }

    /**
     * Show the form for editing the specified book
     */
    public function edit(Book $book)
    {
        // التحقق من ملكية الكتاب
        if ($book->user_id != Auth::id()) {
            abort(403, 'ليس لديك صلاحية لتعديل هذا الكتاب');
        }

        // التحقق من عدم بيع الكتاب
        if ($book->status == 'exchanged') {
            return redirect()->route('books.show', $book)
                ->with('error', 'لا يمكن تعديل كتاب تم بيعه/تبادله');
        }

        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified book
     */
    public function update(Request $request, Book $book)
    {
        // التحقق من ملكية الكتاب
        if ($book->user_id != Auth::id()) {
            abort(403, 'ليس لديك صلاحية لتعديل هذا الكتاب');
        }

        // التحقق من عدم بيع الكتاب
        if ($book->status == 'exchanged') {
            return redirect()->route('books.show', $book)
                ->with('error', 'لا يمكن تعديل كتاب تم بيعه/تبادله');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:200',
            'author' => 'required|string|max:100',
            'description' => 'nullable|string',
            'type' => 'required|in:free,paid',
            'price' => 'nullable|required_if:type,paid|numeric|min:0|max:999999.99',
            'category' => 'required|in:university,school,general',
            'subject' => 'nullable|string|max:100',
            'condition' => 'required|in:new,good,acceptable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'region' => 'required|in:north_gaza,gaza,central,khan_younis,rafah',
            'status' => 'required|in:available,negotiating,exchanged',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        
        if ($request->type == 'free') {
            $data['price'] = null;
        }

        // رفع صورة جديدة إذا تم اختيارها
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            
            $path = $request->file('image')->store('books', 'public');
            $data['image'] = $path;
        } elseif ($request->has('remove_image')) {
            // حذف الصورة إذا طلب المستخدم ذلك
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $data['image'] = null;
        }

        $book->update($data);

        return redirect()->route('books.show', $book)
            ->with('success', 'تم تحديث الكتاب بنجاح!');
    }

    /**
     * Remove the specified book
     */
    public function destroy(Book $book)
    {
        // التحقق من ملكية الكتاب
        if ($book->user_id != Auth::id()) {
            abort(403, 'ليس لديك صلاحية لحذف هذا الكتاب');
        }

        // حذف الصورة إذا كانت موجودة
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'تم حذف الكتاب بنجاح!');
    }

    /**
     * تغيير حالة الكتاب (للتواصل الخارجي عبر واتساب)
     */
    public function changeStatus(Request $request, Book $book)
    {
        // التحقق من ملكية الكتاب
        if ($book->user_id != Auth::id()) {
            abort(403, 'ليس لديك صلاحية لتغيير حالة هذا الكتاب');
        }

        $request->validate([
            'status' => 'required|in:available,negotiating,exchanged',
        ]);

        $book->changeStatus($request->status);

        return redirect()->back()
            ->with('success', 'تم تغيير حالة الكتاب بنجاح!');
    }
}