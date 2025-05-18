@extends('layouts.master')

@section('css')
    @toastr_css
@section('title')
    قائمة الحضور والغياب للطلاب
@stop
@endsection

@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    قائمة الحضور والغياب للطلاب
@stop
<!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <h5 style="font-family: 'Cairo', sans-serif; color: red;">
                تاريخ اليوم: {{ date('Y-m-d') }}
            </h5>

            <!-- عرض المرحلة، الصف، القسم في نفس السطر -->
            {{-- <p>
                <strong>{{ trans('Students_trans.Grade') }}:</strong> {{ $grade->Name ?? 'غير محدد' }} 
                / 
                <strong>{{ trans('Students_trans.classrooms') }}:</strong> {{ $classroom->Name_Class ?? 'غير محدد' }} 
                / 
                <strong>{{ trans('Students_trans.section') }}:</strong> {{ $section->Name_Section ?? 'غير محدد' }}
            </p> --}}

            <form method="post" action="{{ route('Attendance.store') }}">
                @csrf
                <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                    <thead>
                        <tr>
                            <th class="alert-success">#</th>
                            <th class="alert-success">{{ trans('Students_trans.name') }}</th>
                            <th class="alert-success">الغياب</th>
                            <th class="alert-success">{{ trans('Students_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $student->name }}</td>
                                <td>
                                    @php
                                        $absentCount = $student->attendances()->where('attendence_status', 0)->count();
                                    @endphp
                                    {{ $absentCount }}
                                </td>
                                <td>
                                    @if(isset($student->attendance()->where('attendence_date',date('Y-m-d'))->first()->student_id))
                                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                            <input name="attendences[{{ $student->id }}]" disabled 
                                                   {{ $student->attendance()->first()->attendence_status == 1 ? 'checked' : '' }}
                                                   class="leading-tight" type="radio" value="presence">
                                            <span class="text-success">حضور</span>
                                        </label>

                                        <label class="ml-4 block text-gray-500 font-semibold">
                                            <input name="attendences[{{ $student->id }}]" disabled 
                                                   {{ $student->attendance()->first()->attendence_status == 0 ? 'checked' : '' }}
                                                   class="leading-tight" type="radio" value="absent">
                                            <span class="text-danger">غياب</span>
                                        </label>
                                    @else
                                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                            <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio" value="presence">
                                            <span class="text-success">حضور</span>
                                        </label>

                                        <label class="ml-4 block text-gray-500 font-semibold">
                                            <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio" value="absent">
                                            <span class="text-danger">غياب</span>
                                        </label>
                                    @endif

                                    <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                    <input type="hidden" name="grade_id" value="{{ $student->Grade_id }}">
                                    <input type="hidden" name="classroom_id" value="{{ $student->Classroom_id }}">
                                    <input type="hidden" name="section_id" value="{{ $student->section_id }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <P>
                    <button class="btn btn-success" type="submit">{{ trans('Students_trans.submit') }}</button>
                </P>
            </form><br>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
