{{-- @extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{ trans('إدخال درجات الطلاب') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form method="POST" action="{{ route('grades.store') }}">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
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
                                                <input type="number" name="scores[{{ $student->id }}]" class="form-control" step="0.01" min="0" max="100" required>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
@endsection --}}
@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{ trans('إدخال درجات الطلاب') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form method="POST" action="{{ route('grades.store') }}">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الطالب</th>
                                        <th>الدرجة</th>
                                        <th>تعديل الدرجة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->degree->score }}</td>
                                            <td>
                                                <!-- Form to edit the grade -->
                                                <form method="POST" action="{{ route('grades.update', $student->degree->id) }}">
                                                    @csrf
                                                    <input type="number" name="score" class="form-control" value="{{ $student->degree->score }}" step="0.01" min="0" max="100" required>
                                                    <button type="submit" class="btn btn-warning mt-2">تعديل</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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

