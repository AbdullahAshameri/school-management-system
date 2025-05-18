<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('dashboard.parents') }}">
                <div class="pull-left"><i class="nav-icon fas fa-tachometer-alt"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>


        <!-- الابناء-->
        <li>
            <a href="{{route('sons.index')}}"><i class="nav-icon far fa-user"></i><span
                    class="right-nav-text">الابناء</span></a>
        </li>

        <!-- تقرير الحضور والغياب-->
        <li>
            <a href="{{route('sons.attendances')}}"><i class="nav-icon fas fa-table"></i><span
                    class="right-nav-text">تقرير الحضور والغياب</span></a>
        </li>

        <!-- تقرير المالية-->
        <li>
            <a href="{{route('sons.fees')}}"><i class="nav-icon far fa-user"></i><span
                    class="right-nav-text">تقرير المالية</span></a>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{route('profile.show.parent')}}"><i class="far fa-id-card-alt"></i><span
                    class="right-nav-text">الملف الشخصي</span></a>
        </li>

    </ul>
</div>
