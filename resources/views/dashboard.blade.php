<!DOCTYPE html>
<html lang="en">
@section('title')
{{trans('main_trans.Main_title')}}
@stop
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @include('layouts.head')
    @livewireStyles
</head>

<body style="font-family: 'Cairo', sans-serif">

    <div class="wrapper" style="font-family: 'Cairo', sans-serif">


        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
       <!-- main-content -->
<div class="content-wrapper">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0" style="font-family: 'Cairo', sans-serif; color: #2d3436;">لوحة التحكم </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                </ol>
            </div>
        </div>
    </div>
    <!-- widgets -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100 shadow-lg" style="border-radius: 12px; transition: transform 0.3s;">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                <i class="nav-icon far fa-user highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark" style="font-weight: 600;">الطلاب</p>
                            <h4 class="text-primary" style="font-size: 1.6rem;">{{\App\Models\Student::count()}}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top" style="font-size: 0.9rem;">
                        <i class="nav-icon far fa-user mr-1" aria-hidden="true"></i>
                        <a href="{{route('Students.index')}}" target="_blank">
                            <span class="text-danger">عرض</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100 shadow-lg" style="border-radius: 12px; transition: transform 0.3s;">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-warning">
                                <i class="nav-icon far fa-user highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark" style="font-weight: 600;">المعلمين</p>
                            <h4 class="text-primary" style="font-size: 1.6rem;">{{\App\Models\Teacher::count()}}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top" style="font-size: 0.9rem;">
                        <i class="nav-icon far fa-user mr-1" aria-hidden="true"></i>
                        <a href="{{route('Teachers.index')}}" target="_blank">
                            <span class="text-danger">عرض</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100 shadow-lg" style="border-radius: 12px; transition: transform 0.3s;">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                <i class="nav-icon far fa-user highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark" style="font-weight: 600;">اولياء الامور</p>
                            <h4 class="text-primary" style="font-size: 1.6rem;">{{\App\Models\My_Parent::count()}}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top" style="font-size: 0.9rem;">
                        <i class="nav-icon far fa-user mr-1" aria-hidden="true"></i>
                        <a href="{{route('add_parent')}}" target="_blank">
                            <span class="text-danger">عرض</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100 shadow-lg" style="border-radius: 12px; transition: transform 0.3s;">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-primary">
                                <i class="nav-icon fas fa-table highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark" style="font-weight: 600;">الفصول الدراسية</p>
                            <h4 class="text-primary" style="font-size: 1.6rem;">{{\App\Models\Section::count()}}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top" style="font-size: 0.9rem;">
                        <i class="nav-icon fas fa-table mr-1" aria-hidden="true"></i>
                        <a href="{{route('Sections.index')}}" target="_blank">
                            <span class="text-danger">عرض</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <livewire:calendar />

            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')
    @livewireScripts
    @stack('scripts')

</body>

</html>
