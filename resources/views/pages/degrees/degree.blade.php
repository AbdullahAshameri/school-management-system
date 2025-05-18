@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{trans('عرض درجات الطلاب')}}
@stop

@section('page-header')
    <h1>
        {{ trans('عرض درجات الطلاب') }} - 
        @if($grade && $section)
            {{ $grade->Name }} - {{ $section->Name_Section }}
        @else
            {{ 'غير محدد' }}
        @endif
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    {{-- عرض جدول الدرجات --}}
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
                                            {{-- عرض الدرجة المحفوظة لكل طالب --}}
                                            <input type="number" value="{{ $student->degree }}" class="form-control" readonly>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- زر العودة لتعديل الدرجات --}}
                    <a href="{{ route('degrees.edit', ['Grade_id' => $grade->id, 'section_id' => $section->id]) }}" class="btn btn-warning mt-3">تعديل الدرجات</a>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
