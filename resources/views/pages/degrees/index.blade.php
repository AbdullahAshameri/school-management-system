@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{trans('إدخال درجات الطلاب')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('إدخال درجات الطلاب')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Form Start -->
                <form method="POST" action="{{ route('degrees.filter') }}">
                    @csrf

                    <div class="form-row">
                        <div class="col-md-3 form-group">
                            <label for="Grade_id">المرحلة</label>
                            <select name="Grade_id" id="Grade_id" class="custom-select mr-sm-2" required>
                                <option value="">اختر المرحلة</option>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="Classroom_id">الصف</label>
                            <select name="Classroom_id" id="Classroom_id" class="custom-select mr-sm-2" required>
                                <option value="">اختر الصف</option>
                                @foreach($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}">{{ $classroom->Name_Class }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="section_id">القسم</label>
                            <select name="section_id" id="section_id" class="custom-select mr-sm-2" required>
                                <option value="">اختر القسم</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->Name_Section }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="library_id">المادة</label>
                            <select name="library_id" id="library_id" class="custom-select mr-sm-2" required>
                                <option value="">اختر المادة</option>
                                @foreach($library as $lib)
                                    <option value="{{ $lib->id }}">{{ $lib->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3 form-group">
                            <label for="teacher_id">المعلم</label>
                            <select name="teacher_id" id="teacher_id" class="custom-select mr-sm-2" required>
                                <option value="">اختر المعلم</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->Name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="month">الشهر</label>
                            <select name="month" id="month" class="custom-select mr-sm-2" required>
                                <option value="">اختر الشهر</option>
                                <option value="محرم">محرم</option>
                                <option value="صفر">صفر</option>
                                <option value="ربيع الأول">ربيع الأول</option>
                                <option value="ربيع الآخر">ربيع الآخر</option>
                                <option value="جمادى الأول">جمادى الأول</option>
                                <option value="جمادى الآخر">جمادى الآخر</option>
                                <option value="رجب">رجب</option>
                                <option value="شعبان">شعبان</option>
                                <option value="رمضان">رمضان</option>
                                <option value="شوال">شوال</option>
                                <option value="ذو القعدة">ذو القعدة</option>
                                <option value="ذو الحجة">ذو الحجة</option>
                            </select>
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="year" class="control-label">السنة الدراسية</label>
                            <select name="year" id="year" class="custom-select mr-sm-2" required>
                                <option value="">اختر السنة الدراسية</option>
                                @for($i = 2000; $i <= now()->year + 1; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="term">الفصل الدراسي</label>
                            <select name="term" id="term" class="custom-select mr-sm-2" required>
                                <option value="">اختر الفصل الدراسي</option>
                                @foreach($terms as $term)
                                    <option value="{{ $term }}">{{ $term }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">عرض الطلاب</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    @toastr_js
    @toastr_render

    <script type="text/javascript">
        $(document).ready(function(){
            // عندما يتغير القسم، يحدث طلب AJAX لتحديث المواد
            $('#section_id').change(function(){
                var section_id = $(this).val();

                // التحقق من أن القسم تم اختياره
                if(section_id){
                    $.ajax({
                        url: '{{ url('get-materials') }}/' + section_id,  // الرابط لجلب المواد بناءً على القسم
                        type: 'GET',
                        success: function(data) {
                            // تنظيف حقل المواد
                            $('#library_id').empty();  
                            $('#library_id').append('<option value="">اختر المادة</option>');
                            // إضافة المواد الجديدة بناءً على القسم المحدد
                            $.each(data, function(key, value){
                                $('#library_id').append('<option value="'+value.id+'">'+value.title+'</option>');
                            });
                        }
                    });
                } else {
                    $('#library_id').empty();  // تنظيف حقل المواد إذا لم يتم اختيار قسم
                }
            });
        });
    </script>
@endsection

