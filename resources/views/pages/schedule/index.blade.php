@extends('layouts.master')

@section('css')
    @toastr_css
@section('title')
    قائمة الجداول
@stop
@endsection

@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    قائمة الجداول
@stop
<!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{ route('schedule.create') }}" class="btn btn-success btn-sm" role="button" aria-pressed="true">
                                    اضافة جدول جديد
                                </a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم الجدول</th>
                                                <th>المرحلة الدراسية</th>
                                                <th>الصف الدراسي</th>
                                                <th>القسم</th>
                                                <th>العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($schedules as $schedule)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $schedule->title }}</td>
                                                    <td>{{ $schedule->grade->Name }}</td>
                                                    <td>{{ $schedule->classroom->Name_Class }}</td>
                                                    <td>{{ $schedule->section->Name_Section }}</td>
                                                    <td>
                                                        <!-- تحميل الجدول -->
                                                        <a href="{{ route('schedule.download', ['filename' => $schedule->file_name]) }}" title="تحميل الجدول" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                                                            <i class="fas fa-download"></i>
                                                        </a>

                                                        <!-- تعديل الجدول -->
                                                        <a href="{{ route('schedule.edit', $schedule->id) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <!-- حذف الجدول -->
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_schedule{{ $schedule->id }}" title="حذف">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- Modal للحذف -->
                                                @include('pages.schedule.destroy', ['schedule' => $schedule])

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
