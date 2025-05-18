@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{ trans('اختيار الفلاتر') }}
@stop

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
                    <form method="POST" action="{{ route('grades.filter') }}">
                        @csrf

                        <div class="form-row">
                            <div class="col-md-3 form-group">
                                <label for="Grade_id">المرحلة الدراسية</label>
                                <select name="Grade_id" id="Grade_id" class="custom-select mr-sm-2" required>
                                    <option value="">اختر المرحلة الدراسية</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="Classroom_id">الصف الدراسي</label>
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
                        

                        <button type="submit" class="btn btn-primary mt-3">عرض الدرجات</button>
                    </form>

                    <!-- عرض النتائج -->
                    @if(isset($filteredGrades) && $filteredGrades->count() > 0)
                        <a href="{{ route('grades.export', request()->all()) }}" class="btn btn-success mt-3">تحميل درجات Excel</a>

                        <div class="table-responsive mt-4">
                            <table class="table table-bordered text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الطالب</th>
                                        <th>الدرجة</th>
                                        <th>تعديل الدرجة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($filteredGrades as $degree)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $degree->student->name }}</td>
                                            <td>{{ $degree->score }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('grades.update', $degree->id) }}">
                                                    @csrf
                                                    <input type="number" name="score" class="form-control" value="{{ $degree->score }}" step="0.01" min="0" max="100" required>
                                                    <button type="submit" class="btn btn-warning mt-2">تعديل</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mt-3">لا توجد درجات تطابق الفلاتر المدخلة.</p>
                    @endif
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
            $('#section_id').change(function(){
                var section_id = $(this).val();
                if(section_id){
                    $.ajax({
                        url: '{{ url('get-materials') }}/' + section_id,
                        type: 'GET',
                        success: function(data) {
                            $('#library_id').empty();
                            $('#library_id').append('<option value="">اختر المادة</option>');
                            $.each(data, function(key, value){
                                $('#library_id').append('<option value="'+value.id+'">'+value.title+'</option>');
                            });
                        }
                    });
                } else {
                    $('#library_id').empty();
                }
            });
        });
    </script>
@endsection
