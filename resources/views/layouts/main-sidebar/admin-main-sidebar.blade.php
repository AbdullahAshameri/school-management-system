<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- Sidebar User Panel -->
       <!-- Sidebar User Panel as Icon -->
        <li class="user-panel d-flex align-items-center px-3 py-2" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
            <div class="d-flex align-items-center w-100 {{ app()->getLocale() != 'ar' ? 'flex-row-reverse' : '' }}">
                <!-- User Icon -->
                <span 
                    class="user-icon" 
                    style="
                        width: 35px;
                        height: 35px;
                        background: url('{{ asset('assets/images/user_icon.png') }}') center/cover no-repeat;
                        border-radius: 50%;
                        display: inline-block;
                        margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 10px;
                        transition: transform 0.3s ease-in-out;
                    "
                    onmouseover="this.style.transform='scale(1.1)'"
                    onmouseout="this.style.transform='scale(1)'"
                ></span>

                <!-- User Name -->
                <span class="mb-0 text-white font-weight-semibold text-truncate" style="font-size: 14px;">
                    {{ Auth::user()->name }}
                </span>
            </div>
        </li>
        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="pull-left"><i class="nav-icon fas fa-tachometer-alt"></i><span class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>

                <!-- students-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu">
                <div class="pull-left">
                    <i class="nav-icon far fa-user"></i>
                    <span class="right-nav-text">{{trans('main_trans.students')}}</span>
                </div>
                <div class="pull-right"><i class="ti-angle-left "></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="students-menu" class="collapse" data-parent="#sidebarnav">
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">
                        <div class="pull-left">
                            <i class="far fa-circle nav-icon"></i>
                            <span class="right-nav-text">{{trans('main_trans.Student_information')}}</span>
                        </div>
                        <div class="pull-right"><i class="ti-angle-left "></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Student_information" class="collapse">
                        <li> <a href="{{route('Students.create')}}"><i class="#"></i> {{trans('main_trans.add_student')}}</a></li>
                        <li> <a href="{{route('Students.index')}}"><i class="#"></i> {{trans('main_trans.list_students')}}</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">
                        <div class="pull-left">
                            <i class="far fa-circle nav-icon"></i>
                            <span class="right-nav-text">{{trans('main_trans.Students_Promotions')}}</span>
                        </div>
                        <div class="pull-right"><i class="ti-angle-left "></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Students_upgrade" class="collapse">
                        <li> <a href="{{route('Promotion.index')}}"><i class="#"></i> {{trans('main_trans.add_Promotion')}}</a></li>
                        <li> <a href="{{route('Promotion.create')}}"><i class="#"></i> {{trans('main_trans.list_Promotions')}}</a> </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate_students">
                        <div class="pull-left">
                            <i class="far fa-circle nav-icon"></i>
                            <span class="right-nav-text">{{trans('main_trans.Graduate_students')}}</span>
                        </div>
                        <div class="pull-right"><i class="ti-angle-left "></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Graduate_students" class="collapse">
                        <li> <a href="{{route('Graduated.create')}}"><i class="#"></i> {{trans('main_trans.add_Graduate')}}</a> </li>
                        <li> <a href="{{route('Graduated.index')}}"><i class="#"></i> {{trans('main_trans.list_Graduate')}}</a> </li>
                    </ul>
                </li>
            </ul>
        </li>
        

        <!-- menu title -->
        {{-- <li class="mt-10 mb-10 text-white pl-4 font-weight-bold menu-title">{{trans('main_trans.Programname')}}</li> --}}


        <!-- Teachers-->
        {{-- <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                <div class="pull-left">
                    <i class="nav-icon far fa-user"></i>
                    <span class="right-nav-text">{{trans('main_trans.Teachers')}}</span>
                </div>
                <div class="pull-right"><i class="ti-angle-left"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('Teachers.index')}}"><i class="far fa-circle nav-icon"></i> {{trans('main_trans.List_Teachers')}}</a> </li>
            </ul>
        </li> --}}
        <li>
            <a href="{{ route('Teachers.index') }}">
                <i class="nav-icon far fa-user"></i> {{ trans('main_trans.Teachers') }}
            </a>
        </li>

        <!-- Parents-->
        {{-- <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                <div class="pull-left">
                    <i class="nav-icon far fa-user"></i>
                    <span class="right-nav-text">{{trans('main_trans.Parents')}}</span>
                </div>
                <div class="pull-right"><i class="ti-angle-left "></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{url('add_parent')}}"><i class="far fa-circle nav-icon"></i> {{trans('main_trans.List_Parents')}}</a> </li>
            </ul>
        </li> --}}
        <li>
            <a href="{{ route('add_parent') }}">
                <i class="nav-icon far fa-user"></i> {{ trans('main_trans.Parents') }}
            </a>
        </li>
        
        <!-- Attendance-->
        {{-- <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                <div class="pull-left">
                    <i class="nav-icon fas fa-table"></i>
                    <span class="right-nav-text">{{trans('main_trans.Attendance')}}</span>
                </div>
                <div class="pull-right"><i class="ti-angle-left "></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('Attendance.index')}}"><i class="far fa-circle nav-icon"></i> قائمة الطلاب</a> </li>
            </ul>
        </li> --}}
        <li>
            <a href="{{route('Attendance.index')}}">
                <i class="nav-icon far fa-user"></i>{{trans('main_trans.Attendance')}}
            </a>
        </li>

        <!--المدخلات -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Inserts-icon">
                <div class="pull-left">
                    <i class="nav-icon fas fa-table"></i>
                    <span class="right-nav-text">رفع الدرجات</span>
                </div>
                <div class="pull-right"><i class="ti-angle-left "></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Inserts-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('degrees.create') }}"><i class="far fa-circle nav-icon"></i>ادخال الدرجات</a> </li>
                <li> <a href="{{ route('degrees.execl') }}"><i class="far fa-circle nav-icon"></i>رفع ملف اكسل</a> </li>
                <li> <a href="{{ route('grades.filter.page') }}"><i class="far fa-circle nav-icon"></i>عرض وتعديل الدرجات</a> </li>
            </ul>
        </li>
        <!--المدخلات -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Inserts-schedule">
                <div class="pull-left">
                    <i class="nav-icon fas fa-table"></i>
                    <span class="right-nav-text">جداول الحصص والاختبارات</span>
                </div>
                <div class="pull-right"><i class="ti-angle-left "></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Inserts-schedule" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('schedule.index') }}"><i class="far fa-circle nav-icon"></i>رفع الجدالول</a> </li>
                <li> <a href="{{ route('other.index') }}"><i class="far fa-circle nav-icon"></i>اخرى</a> </li>
            </ul>
        </li>


        <!-- Academic Settings -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#AcademicSettings-menu">
                <div class="pull-left">
                    <i class="nav-icon fas fa-table"></i>
                    <span class="right-nav-text">{{ trans('main_trans.Academic_Settings') }}</span>
                </div>
                <div class="pull-right"><i class="ti-angle-left "></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="AcademicSettings-menu" class="collapse" data-parent="#sidebarnav">
                <!-- Grades -->
                <li>
                    <a href="{{ route('Grades.index') }}">
                        <i class="far fa-circle nav-icon"></i> {{ trans('main_trans.Grades') }}
                    </a>
                </li>
                <!-- Classes -->
                <li>
                    <a href="{{ route('Classrooms.index') }}">
                        <i class="far fa-circle nav-icon"></i> {{ trans('main_trans.classes') }}
                    </a>
                </li>
                <!-- Sections -->
                <li>
                    <a href="{{ route('Sections.index') }}">
                        <i class="far fa-circle nav-icon"></i> {{ trans('main_trans.sections') }}
                    </a>
                </li>
            </ul>
        </li>

        
        <!-- إضافة زر لرفع الدرجات الشهرية -->
        {{-- route('monthly_grades.index') --}}
        {{-- {{ trans('main_trans.Add_Monthly_Grades') }} --}}

        <!-- Subjects-->
        {{-- <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subjects">
                <div class="pull-left">
                    <i class="nav-icon fas fa-table"></i>
                    <span class="right-nav-text">المواد الدراسية</span>
                </div>
                <div class="pull-right"><i class="ti-angle-left "></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Subjects" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('subjects.index')}}"><i class="far fa-circle nav-icon"></i> قائمة المواد</a> </li>
            </ul>
        </li> --}}
        <li>
            <a href="{{route('subjects.index')}}">
                <i class="nav-icon fas fa-table"></i>{{trans('المواد الدراسية')}}
            </a>
        </li>

        <!-- Quizzes-->
        {{-- <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                <div class="pull-left">
                    <i class="fas fa-book-open"></i>
                    <span class="right-nav-text">الاختبارات</span>
                </div>
                <div class="pull-right"><i class="ti-angle-left "></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('Quizzes.index')}}"><i class="fas fa-list"></i> قائمة الاختبارات</a> </li>
                <li> <a href="{{route('questions.index')}}"><i class="fas fa-question-circle"></i> قائمة الاسئلة</a> </li>
            </ul>
        </li> --}}

        <!-- library-->
        {{-- <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
                <div class="pull-left">
                    <i class="nav-icon fas fa-table"></i>
                    <span class="right-nav-text">{{trans('main_trans.library')}}</span>
                </div>
                <div class="pull-right"><i class="ti-angle-left "></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('library.index')}}"><i class="far fa-circle nav-icon"></i> قائمة الكتب</a> </li>
            </ul>
        </li> --}}
        <li>
            <a href="{{route('library.index')}}">
                <i class="nav-icon fas fa-table"></i>{{trans('main_trans.library')}}
            </a>
        </li>

        <!-- Online classes-->
        {{-- <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left">
                    <i class="fas fa-video"></i>
                    <span class="right-nav-text">{{trans('main_trans.Onlineclasses')}}</span>
                </div>
                <div class="pull-right"><i class="ti-angle-left "></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('online_classes.index')}}"><i class="fas fa-list"></i> حصص اونلاين مع زوم</a> </li>
            </ul>
        </li> --}}
        <!-- Settings -->
        <li>
            <a href="{{ route('settings.index') }}">
                <i class="fas fa-sliders-h"></i> {{ trans('main_trans.Settings') }}
            </a>
        </li>
        
    </ul>
</div>

<style>
    /* User Panel Styles */
    .user-panel {
        padding: 15px;
        margin-bottom: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .profile-container {
        display: flex;
        align-items: center;
    }

    .profile-image {
        width: 45px;
        height: 45px;
        margin-right: 10px;
    }

    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .profile-info {
        display: flex;
        flex-direction: column;
    }

    .profile-name {
        color: #fff;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 2px;
    }

    .profile-status {
        display: flex;
        align-items: center;
        font-size: 12px;
        color: #adb5bd;
    }

    .status-icon {
        color: #28a745;
        font-size: 10px;
        margin-right: 5px;
    }

    /* تعديلات بسيطة لتحسين المظهر */
    .side-menu-bg {
        background-color: #343a40;
    }

    .side-menu a {
        color: #c2c7d0;
    }

    .side-menu a:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.813);
    }
</style>