<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\LibraryRepositoryInterface;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    protected $library;

    public function __construct(LibraryRepositoryInterface $library)
    {
        $this->library = $library;
    }

    public function index()
    {
        return $this->library->index();
    }

    public function create()
    {
        return $this->library->create();
    }

    public function store(Request $request)
    {
        // هنا نقوم بإضافة التحقق من المدخلات
        $request->validate([
            'title' => 'required|string|max:255',
            'file_name' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'Grade_id' => 'required|exists:grades,id',
            'Classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
        ]);

        return $this->library->store($request);
    }

    public function edit($id)
    {
        return $this->library->edit($id);
    }

    public function update(Request $request)
    {
        // هنا أيضًا نقوم بإضافة التحقق من المدخلات
        $request->validate([
            'title' => 'required|string|max:255',
            'file_name' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'Grade_id' => 'required|exists:grades,id',
            'Classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
        ]);

        return $this->library->update($request);
    }

    public function destroy(Request $request)
    {
        // إذا كانت هناك أخطاء مثل أن الملف غير موجود أو غير معرف، نعرض رسالة خطأ.
        return $this->library->destroy($request);
    }

    public function downloadAttachment($filename)
    {
        return $this->library->download($filename);
    }
}
