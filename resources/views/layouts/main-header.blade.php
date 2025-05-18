<!--=================================
header start-->
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- Logo Section -->
    <div class="navbar-brand-wrapper text-left">
        <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}">
            {{-- <img src="{{ URL::asset('attachments/logo/' . ($setting['logo'] ?? 'default-logo.png')) }}" alt="School Logo"> --}}
            <img 
    src="{{ URL::asset('attachments/logo/' . ($setting['logo'] ?? 'default-logo.png')) }}" 
    alt="School Logo"
    style="
        width: 35px;
        height: 35px;
        object-fit: cover;
        border-radius: 50%;
        transition: transform 0.3s ease-in-out;
    "
    onmouseover="this.style.transform='scale(1.1)'"
    onmouseout="this.style.transform='scale(1)'"
/>

        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}">
            <p style="font-size: 17px; color: black;">{{ $setting['school_name'] ?? 'مدرسة بدون اسم' }}</p>
        </a>
    </div>

    <!-- Top bar left -->
    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item d-flex align-items-center">
            <a id="button-toggle" class="button-toggle-nav ml-20" href="javascript:void(0);">
                <i class="fas fa-bars" style="color: black;"></i>
            </a>
        </li>
    </ul>

    <!-- Top bar right -->
    <ul class="nav navbar-nav ml-auto align-items-center">

        <!-- Language Selector - icon only -->
        <li class="nav-item dropdown d-flex align-items-center">
            <a class="nav-link top-nav d-flex align-items-center" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-globe" style="color: black; font-size: 18px;"></i>
            </a>
            <div class="dropdown-menu">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" style="color: black;">
                        {{ $localeCode == 'ar' ? 'العربية' : $properties['native'] }}
                    </a>
                @endforeach
            </div>
        </li>

        <!-- Notifications -->
        <li class="nav-item dropdown d-flex align-items-center">
            <a class="nav-link top-nav d-flex align-items-center" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell" style="color: black; font-size: 18px;"></i>
                <span class="badge badge-danger notification-status"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                <div class="dropdown-header notifications">
                    <strong>{{ trans('Sidebar_trans.Notifications') }}</strong>
                    <span class="badge badge-pill badge-warning">05</span>
                </div>
            </div>
        </li>

        <!-- Logout Icon -->
        <!-- Logout -->
<li class="nav-item dropdown d-flex align-items-center">
    <a class="nav-link top-nav d-flex align-items-center" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="gap: 10px;">
        <i class="fas fa-sign-out-alt" style="font-size: 18px; color: black;"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-big">
        <div class="dropdown-header notifications">
            <strong>{{ Auth::user()->name }}</strong>
            <div style="font-size: 12px; color: gray;">{{ Auth::user()->email }}</div>
        </div>
        <div class="dropdown-divider"></div>
        @if(auth('student')->check())
            <form method="GET" action="{{ route('logout','student') }}">
        @elseif(auth('teacher')->check())
            <form method="GET" action="{{ route('logout','teacher') }}">
        @elseif(auth('parent')->check())
            <form method="GET" action="{{ route('logout','parent') }}">
        @else
            <form method="GET" action="{{ route('logout','web') }}">
        @endif
            @csrf
            <a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                <i class="bx bx-log-out" style="font-size: 18px;"></i> تسجيل الخروج
            </a>
        </form>
    </div>
</li>

    </ul>
</nav>
<!--=================================
header End-->
