<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Other;

class OtherController extends Controller
{
    use AttachFilesTrait;

    public function index()
    {
        $others = Other::all();
        return view('pages.other.index', compact('others'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.other.create', compact('grades'));
    }

    public function store(Request $request)
    {
        try {
            // التحقق من المدخلات (التأكد من قبول الصور و PDF)
            $request->validate([
                'title' => 'required|string|max:255',
                'file_name' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // قبول الصور و PDF
                'Grade_id' => 'required|exists:grades,id',
                'Classroom_id' => 'required|exists:classrooms,id',
                'section_id' => 'required|exists:sections,id',
            ]);

            // إنشاء سجل جديد للجدول
            $other = new Other();
            $other->title = $request->title;
            $other->file_name = $request->file('file_name')->getClientOriginalName();
            $other->Grade_id = $request->Grade_id;
            $other->classroom_id = $request->Classroom_id;
            $other->section_id = $request->section_id;
            $other->teacher_id = 1; // تأكد من أنك تحدد المعلم بشكل صحيح
            $other->save();

            // رفع الملف وتخزينه في مجلد منفصل خاص بالجدول
            $this->uploadFile($request, 'file_name', 'other');  // تخزين الملف في مجلد "other"

            toastr()->success(trans('messages.success'));
            return redirect()->route('other.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        // استرجاع الجدول بناءً على الـ id
        $other = Other::findOrFail($id);

        // استرجاع جميع الصفوف الدراسية
        $grades = Grade::all();

        // عرض صفحة التعديل مع البيانات المطلوبة
        return view('pages.other.edit', compact('other', 'grades'));
    }

    public function update(Request $request, $id)
    {
        try {
            // استرجاع الجدول بناءً على الـ id
            $other = Other::findOrFail($id);

            // تحديث العنوان
            $other->title = $request->title;

            // تحقق إذا كان هناك ملف جديد
            if ($request->hasFile('file_name')) {
                // حذف الملف القديم من المجلد
                $this->deleteFile($other->file_name, 'other');

                // رفع الملف الجديد
                $this->uploadFile($request, 'file_name', 'other');

                // تحديث اسم الملف في قاعدة البيانات
                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $other->file_name = $file_name_new;
            }

            // تحديث باقي المعلومات
            $other->Grade_id = $request->Grade_id;
            $other->classroom_id = $request->Classroom_id;
            $other->section_id = $request->section_id;
            $other->save();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('other.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $other = Other::findOrFail($id);

            // حذف الملف من المجلد
            $this->deleteFile($other->file_name, 'other');

            // حذف السجل من قاعدة البيانات
            $other->delete();

            toastr()->success(trans('messages.success'));
            return redirect()->route('other.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء الحذف');
        }
    }


    public function download($filename)
    {
        // تحميل الملف من مجلد الجدول
        return response()->download(public_path('attachments/other/' . $filename));
    }
}
