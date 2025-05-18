<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    use AttachFilesTrait;

    public function index()
    {
        $schedules = Schedule::all();
        return view('pages.schedule.index', compact('schedules'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.schedule.create', compact('grades'));
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
            $schedule = new Schedule();
            $schedule->title = $request->title;
            $schedule->file_name = $request->file('file_name')->getClientOriginalName();
            $schedule->Grade_id = $request->Grade_id;
            $schedule->classroom_id = $request->Classroom_id;
            $schedule->section_id = $request->section_id;
            $schedule->teacher_id = 1; // تأكد من أنك تحدد المعلم بشكل صحيح
            $schedule->save();

            // رفع الملف وتخزينه في مجلد منفصل خاص بالجدول
            $this->uploadFile($request, 'file_name', 'schedule');  // تخزين الملف في مجلد "schedule"

            toastr()->success(trans('messages.success'));
            return redirect()->route('schedule.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        // استرجاع الجدول بناءً على الـ id
        $schedule = Schedule::findOrFail($id);

        // استرجاع جميع الصفوف الدراسية
        $grades = Grade::all();

        // عرض صفحة التعديل مع البيانات المطلوبة
        return view('pages.schedule.edit', compact('schedule', 'grades'));
    }

    public function update(Request $request, $id)
    {
        try {
            // استرجاع الجدول بناءً على الـ id
            $schedule = Schedule::findOrFail($id);

            // تحديث العنوان
            $schedule->title = $request->title;

            // تحقق إذا كان هناك ملف جديد
            if ($request->hasFile('file_name')) {
                // حذف الملف القديم من المجلد
                $this->deleteFile($schedule->file_name, 'schedule');

                // رفع الملف الجديد
                $this->uploadFile($request, 'file_name', 'schedule');

                // تحديث اسم الملف في قاعدة البيانات
                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $schedule->file_name = $file_name_new;
            }

            // تحديث باقي المعلومات
            $schedule->Grade_id = $request->Grade_id;
            $schedule->classroom_id = $request->Classroom_id;
            $schedule->section_id = $request->section_id;
            $schedule->save();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('schedule.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $schedule = Schedule::findOrFail($id);

            // حذف الملف من المجلد
            $this->deleteFile($schedule->file_name, 'schedule');

            // حذف السجل من قاعدة البيانات
            $schedule->delete();

            toastr()->success(trans('messages.success'));
            return redirect()->route('schedule.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء الحذف');
        }
    }


    public function download($filename)
    {
        // تحميل الملف من مجلد الجدول
        return response()->download(public_path('attachments/schedule/' . $filename));
    }
}
