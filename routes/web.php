<?php

use App\Http\Controllers\Other\OtherController;
use App\Http\Controllers\Students\DegreesController;
use App\Http\Controllers\Students\GradesController;
use App\Http\Controllers\Students\ScheduleController;
use Illuminate\Support\Facades\Route;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes();

Route::get('/', 'HomeController@index')->name('selection');

Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login/{type}', 'LoginController@loginForm')->middleware('guest')->name('login.show');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::get('/logout/{type}', 'LoginController@logout')->name('logout');
});



//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

        //==============================dashboard============================
        Route::group(['namespace' => 'Grades'], function () {
            Route::resource('Grades', 'GradeController');
        });

        //==============================Classrooms============================
        Route::group(['namespace' => 'Classrooms'], function () {
            Route::resource('Classrooms', 'ClassroomController');
            Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');

            Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
        });


        //==============================Sections============================

        Route::group(['namespace' => 'Sections'], function () {

            Route::resource('Sections', 'SectionController');

            Route::get('/classes/{id}', 'SectionController@getclasses');
        });

        //==============================parents============================

        Route::view('add_parent', 'livewire.show_Form')->name('add_parent');

        //==============================Teachers============================
        Route::group(['namespace' => 'Teachers'], function () {
            Route::resource('Teachers', 'TeacherController');
        });


        //==============================Students============================
        Route::group(['namespace' => 'Students'], function () {
            Route::resource('Students', 'StudentController');
            Route::resource('online_classes', 'OnlineClasseController');
            Route::get('indirect_admin', 'OnlineClasseController@indirectCreate')->name('indirect.create.admin');
            Route::post('indirect_admin', 'OnlineClasseController@storeIndirect')->name('indirect.store.admin');
            Route::resource('Graduated', 'GraduatedController');
            Route::resource('Promotion', 'PromotionController');
            Route::resource('Fees_Invoices', 'FeesInvoicesController');
            Route::resource('Fees', 'FeesController');
            Route::resource('receipt_students', 'ReceiptStudentsController');
            Route::resource('ProcessingFee', 'ProcessingFeeController');
            Route::resource('Payment_students', 'PaymentController');
            Route::resource('Attendance', 'AttendanceController');
            // Route::resource('degrees', 'DegreeController');
            Route::get('download_file/{filename}', 'LibraryController@downloadAttachment')->name('downloadAttachment');
            Route::resource('library', 'LibraryController');
            Route::get('schedule/download/{filename}', [ScheduleController::class, 'download'])->name('schedule.download');

            Route::resource('schedule', 'ScheduleController');
            Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
            Route::get('Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
            Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');











            Route::get('/degrees/create', [DegreesController::class, 'create'])->name('degrees.create');
            // Route::post('/degrees', [DegreesController::class, 'store'])->name('degrees.store');
            Route::post('/degrees/store', [DegreesController::class, 'store'])->name('degrees.store');
            // Route::post('/degrees/filter', [DegreesController::class, 'filter'])->name('degrees.filter');
            // Route::post('/degrees/filter', [DegreesController::class, 'filter'])->name('filter');
            Route::post('/degrees/filter', [DegreesController::class, 'filter'])->name('degrees.filter');
            Route::post('/degrees/store', [DegreesController::class, 'store'])->name('degrees.store');

            Route::get('get-materials/{section_id}', [DegreesController::class, 'getMaterials']);



        });

        //==============================Students 2 ============================
        Route::group(['namespace' => 'Students'], function () {
            // عرض جميع الجداول
            Route::get('schedule', [ScheduleController::class, 'index'])->name('schedule.index');

            // عرض صفحة إنشاء جدول جديد
            Route::get('schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');

            // حفظ جدول جديد
            Route::post('schedule', [ScheduleController::class, 'store'])->name('schedule.store');

            // حذف جدول
            Route::delete('schedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

            // تحميل ملف من الجدول
            Route::get('schedule/download/{filename}', [ScheduleController::class, 'download'])->name('schedule.download');
        });
        Route::post('/degrees/import', [DegreesController::class, 'import'])->name('degrees.import');
        Route::get('/degrees/import', [DegreesController::class, 'viewImport'])->name('degrees.execl');
        Route::get('/degrees/filter', [DegreesController::class, 'filterDegrees'])->name('degrees.show');


        // export excel 
        Route::get('/grades/export', [GradesController::class, 'exportGradesToExcel'])->name('grades.export');

        
        // عرض صفحة الفلاتر
        Route::get('/grade-filter', [GradesController::class, 'showFilterPage'])->name('grades.filter.page');

        // فلترة الدرجات بناءً على الفلاتر وعرض النتائج
        Route::post('/grades/filter', [GradesController::class, 'filterGrades'])->name('grades.filter');
        Route::post('/grades/update/{degree_id}', [GradesController::class, 'updateGrade'])->name('grades.update');

        // عرض صفحة إدخال الدرجات بناءً على الفلاتر المحددة
        Route::get('/grades/assign', [GradesController::class, 'assignGradesPage'])->name('grades.assign.page');


        // other
        Route::get('classes/{gradeId}', [OtherController::class, 'getClasses'])->name('other.getClasses');


        //==============================Other============================
        Route::group(['namespace' => 'App\Http\Controllers\Other'], function () {

            Route::get('/other', [OtherController::class, 'index'])->name('other.index');
            Route::get('/other/create', [OtherController::class, 'create'])->name('other.create');
            Route::post('/other', [OtherController::class, 'store'])->name('other.store');
            Route::get('/other/{id}/edit', [OtherController::class, 'edit'])->name('other.edit');
            Route::put('/other/{id}', [OtherController::class, 'update'])->name('other.update');
            Route::delete('/other/{id}', [OtherController::class, 'destroy'])->name('other.destroy');
        });



        //==============================subjects============================
        Route::group(['namespace' => 'Subjects'], function () { // Subjects => folder => in app/Models/http/cotrollers/[Subjects]
            Route::resource('subjects', 'SubjectController');
        });

        //SubjectController => المسار

        //==============================Quizzes============================
        Route::group(['namespace' => 'Quizzes'], function () {
            Route::resource('Quizzes', 'QuizzController');
        });

        //==============================questions============================
        Route::group(['namespace' => 'questions'], function () {
            Route::resource('questions', 'QuestionController');
        });

        //==============================Setting============================
        Route::resource('settings', 'SettingController');

        //==============================degrees============================

        Route::group(['namespace' => 'Students'], function () {
            // Route::get('/degrees/create', [DegreesController::class, 'create'])->name('degrees.create');
            // // Route::post('/degrees', [DegreesController::class, 'store'])->name('degrees.store');
            // Route::post('/degrees/store', [DegreesController::class, 'store'])->name('degrees.store');
            // // Route::post('/degrees/filter', [DegreesController::class, 'filter'])->name('degrees.filter');
            // // Route::post('/degrees/filter', [DegreesController::class, 'filter'])->name('filter');
            // Route::post('/degrees/filter', [DegreesController::class, 'filter'])->name('degrees.filter');
            // Route::post('/degrees/store', [DegreesController::class, 'store'])->name('degrees.store');

            // Route::get('get-materials/{section_id}', [DegreesController::class, 'getMaterials']);




            //         // عرض درجات الطلاب بناءً على الفلاتر
            // Route::get('/degrees/show', [DegreesController::class, 'show'])->name('degrees.show');

            // // تعديل درجات الطلاب
            // Route::get('/degrees/edit', [DegreesController::class, 'edit'])->name('degrees.edit');

        });
    }
);
