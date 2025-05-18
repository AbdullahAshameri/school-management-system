@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{trans('تعديل درجات الطلاب')}}
@stop

@section('page-header')
    <h1>{{trans('تعديل درجات الطلاب')}} - {{ $grade->Name }} - {{ $section->Name_Section }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <form method="POST" action="{{ route('degrees.store') }}">
                        @csrf

                        {{-- بيانات الفلترة --}}
                        <input type="hidden" name="Grade_id" value="{{ $request->Grade_id }}">
                        <input type="hidden" name="Classroom_id" value="{{ $request->Classroom_id }}">
                        <input type="hidden" name="section_id" value="{{ $request->section_id }}">
                        <input type="hidden" name="library_id" value="{{ $request->library_id }}">
                        <input type="hidden" name="teacher_id" value="{{ $request->teacher_id }}">
                        <input type="hidden" name="month" value="{{ $request->month }}">
                        <input type="hidden" name="year" value="{{ $request->year }}">
                        <input type="hidden" name="term" value="{{ $request->term }}">

                        {{-- نوع التقييم --}}
                        <div class="form-group">
                            <label for="type">نوع التقييم</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="تحريري">تحريري</option>
                                <option value="واجبات">واجبات</option>
                                <option value="شفوي">شفوي</option>
                                <option value="المواضبة">المواضبة</option>
                            </select>
                        </div>

                        {{-- جدول الدرجات --}}
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الطالب</th>
                                        <th>الدرجة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>
                                                <input type="number" name="scores[{{ $student->id }}]"
                                                       class="form-control" step="0.01" min="0" max="100"
                                                       value="{{ old('scores.' . $student->id, $student->degree) }}"
                                                       required placeholder="ادخل الدرجة">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- زر الحفظ --}}
                        <button type="submit" class="btn btn-success mt-3">حفظ الدرجات</button>
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
