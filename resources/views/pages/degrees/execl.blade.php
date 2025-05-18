@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('رفع ملف اكسل')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{trans('رفع ملف اكسل')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form method="POST" action="{{ route('degrees.import') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Add filters for Grade, Classroom, Section, etc. -->
                        <div class="form-row">
                            <div class="col-md-3 form-group">
                                <label for="Grade_id">المستوى الدراسي</label>
                                <select class="custom-select mr-sm-2" name="Grade_id" id="Grade_id" required>
                                    <option value="">اختر المستوى الدراسي</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3 form-group">
                                <label for="Classroom_id">الصف الدراسي</label>
                                <select class="custom-select mr-sm-2" name="Classroom_id" id="Classroom_id" required>
                                    <option value="">اختر الصف الدراسي</option>
                                    @foreach($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->Name_Class }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3 form-group">
                                <label for="section_id">القسم</label>
                                <select class="custom-select mr-sm-2" name="section_id" id="section_id" required>
                                    <option value="">اختر القسم</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->Name_Section }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3 form-group">
                                <label for="term">الفصل الدراسي</label>
                                <select class="custom-select mr-sm-2" name="term" id="term" required>
                                    <option value="">اختر الفصل الدراسي</option>
                                    <option value="الفصل الدراسي الأول">الفصل الدراسي الأول</option>
                                    <option value="الفصل الدراسي الثاني">الفصل الدراسي الثاني</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3 form-group">
                                <label for="library_id">المادة</label>
                                <select class="custom-select mr-sm-2" name="library_id" id="library_id" required>
                                    <option value="">اختر المادة</option>
                                    @foreach($library as $lib)
                                        <option value="{{ $lib->id }}">{{ $lib->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3 form-group">
                                <label for="month">الشهر</label>
                                <select class="custom-select mr-sm-2" name="month" id="month" required>
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
                            
                            {{-- <div class="col-md-3 form-group">
                                <label for="year">السنة الدراسية</label>
                                <input type="text" name="year" id="year" class="form-control" required>
                            </div> --}}

                            <div class="col-md-3 form-group">
                                <label for="year" class="control-label">السنة الدراسية</label>
                                <select class="custom-select mr-sm-2" name="year" id="year" required>
                                    <option value="">اختر السنة الدراسية</option>
                                    @for($i = 2000; $i <= now()->year + 1; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            
                            
                            <div class="col-md-3 form-group">
                                <label for="teacher_id">المعلم</label>
                                <select class="custom-select mr-sm-2" name="teacher_id" id="teacher_id" required>
                                    <option value="">اختر المعلم</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <!-- Add additional fields for Teacher, Month, Year, and Term -->

                            <div class="col-md-3 form-group">
                                <label for="file">رفع ملف Excel</label>
                                <input type="file" name="file" id="file" required>
                            </div>
                            

                        <button type="submit" class="btn btn-primary mt-3">رفع الملف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
