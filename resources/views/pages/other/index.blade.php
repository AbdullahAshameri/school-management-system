@extends('layouts.master')

@section('css')
    @toastr_css
@section('title')
    قائمة المشورات
@stop
@endsection

@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    قائمة المنشورات
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
                                <a href="{{ route('other.create') }}" class="btn btn-success btn-sm" role="button" aria-pressed="true">
                                    اضافة منشور جديد
                                </a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم المنشور</th>
                                                <th>المرحلة الدراسية</th>
                                                <th>الصف الدراسي</th>
                                                <th>القسم</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($others as $other)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $other->title }}</td>
                                                    <td>{{ $other->grade->Name }}</td>
                                                    <td>{{ $other->classroom->Name_Class }}</td>
                                                    <td>{{ $other->section->Name_Section }}</td>
                                                    <td>
                                                        <!-- تحميل الجدول -->
                                                        <a href="{{ route('other.download', ['filename' => $other->file_name]) }}" title="تحميل الجدول" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                                                            <i class="fas fa-download"></i>
                                                        </a>

                                                        <!-- تعديل الجدول -->
                                                        <a href="{{ route('other.edit', $other->id) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <!-- حذف الجدول -->
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_other{{ $other->id }}" title="حذف">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- Modal للحذف -->
                                                @include('pages.other.destroy', ['other' => $other])

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
