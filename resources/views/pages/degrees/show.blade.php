@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{ trans('عرض الدرجات') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form method="POST" action="{{ route('grades.filter') }}">
                        @csrf
                        <!-- Filters for Grade, Classroom, Section, etc. -->
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <label for="Grade_id">المستوى الدراسي</label>
                                <select name="Grade_id" id="Grade_id" class="form-control" required>
                                    <option value="">اختر المستوى الدراسي</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="Classroom_id">الصف الدراسي</label>
                                <select name="Classroom_id" id="Classroom_id" class="form-control" required>
                                    <option value="">اختر الصف الدراسي</option>
                                    @foreach($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->Name_Class }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="section_id">القسم</label>
                                <select name="section_id" id="section_id" class="form-control" required>
                                    <option value="">اختر القسم</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->Name_Section }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <label for="teacher_id">المعلم</label>
                                <select name="teacher_id" id="teacher_id" class="form-control" required>
                                    <option value="">اختر المعلم</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="month">الشهر</label>
                                <select name="month" id="month" class="form-control" required>
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
                            <div class="col-md-4 form-group">
                                <label for="year">السنة الدراسية</label>
                                <input type="text" name="year" id="year" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <label for="term">الفصل الدراسي</label>
                                <select name="term" id="term" class="form-control" required>
                                    <option value="">اختر الفصل الدراسي</option>
                                    <option value="الفصل الدراسي الأول">الفصل الدراسي الأول</option>
                                    <option value="الفصل الدراسي الثاني">الفصل الدراسي الثاني</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">عرض الدرجات</button>
                    </form>

                    <!-- Display the filtered degrees -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>اسم الطالب</th>
                                    <th>الدرجة</th>
                                    <th>المعلم</th>
                                    <th>الشهر</th>
                                    <th>السنة الدراسية</th>
                                    <th>الفصل الدراسي</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($degrees as $degree)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $degree->student->name }}</td>
                                        <td>{{ $degree->score }}</td>
                                        <td>{{ $degree->teacher->Name }}</td>
                                        <td>{{ $degree->month }}</td>
                                        <td>{{ $degree->year }}</td>
                                        <td>{{ $degree->term }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
