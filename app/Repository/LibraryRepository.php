<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Library;

class LibraryRepository implements LibraryRepositoryInterface
{

    use AttachFilesTrait;

    public function index()
    {
        $books = Library::all();
        return view('pages.library.index',compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.library.create',compact('grades'));
    }

    public function store($request)
    {
        try {
            // التحقق من المدخلات
            $request->validate([
                'title' => 'required|string|max:255',
                'file_name' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',  // تحديد أنواع الملفات المسموح بها
                'Grade_id' => 'required|exists:grades,id',
                'Classroom_id' => 'required|exists:classrooms,id',
                'section_id' => 'required|exists:sections,id',
            ]);
    
            $books = new Library();
            $books->title = $request->title;
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $books->save();
            
            // رفع الملف وتخزينه في مجلد "library"
            $this->uploadFile($request, 'file_name', 'library');  
    
            toastr()->success(trans('messages.success'));
            return redirect()->route('library.create');
        } catch (\Exception $e) {
            // إذا حدث خطأ، سيتم إظهار رسالة الخطأ للمستخدم
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    


    public function edit($id)
    {
        $grades = Grade::all();
        $book = library::findorFail($id);
        return view('pages.library.edit',compact('book','grades'));
    }

        public function update($request)
    {
        try {
            // التحقق من المدخلات
            $request->validate([
                'title' => 'required|string|max:255',
                'file_name' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',  // تحديد أنواع الملفات المسموح بها
                'Grade_id' => 'required|exists:grades,id',
                'Classroom_id' => 'required|exists:classrooms,id',
                'section_id' => 'required|exists:sections,id',
            ]);

            $book = Library::findOrFail($request->id);
            $book->title = $request->title;

            // تحقق إذا كان هناك ملف جديد
            if ($request->hasFile('file_name')) {

                // حذف الملف القديم من مجلد "library"
                $this->deleteFile($book->file_name, 'library');

                // رفع الملف الجديد إلى المجلد "library"
                $this->uploadFile($request, 'file_name', 'library');  

                // تحديث اسم الملف في قاعدة البيانات
                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }

            // تحديث باقي المعلومات
            $book->Grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            // إذا حدث خطأ، سيتم إظهار رسالة الخطأ للمستخدم
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    

    public function destroy($request)
    {
        // حذف الملف من مجلد "library"
        $this->deleteFile($request->file_name, 'library'); // تأكد من تمرير المجلد هنا
        Library::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('library.index');
    }
    

    public function download($filename)
    {
        return response()->download(public_path('attachments/library/'.$filename));
    }
    
}
