<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>مدرسة آزال</title>

    <!-- Favicon -->
    <link rel="shortcut icon" {{--href="images/favicon.ico"--}} />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">

    <style>
        /* تعديل CSS داخلي */
        .form-inline {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .form-inline a {
            display: inline-block;
            width: 100%;
            max-width: 150px; /* تحديد الحد الأقصى للعرض */
            margin: 10px;
            text-align: center;
            background-color: #f8f9fa;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-inline a img {
            max-width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .form-inline a:hover {
            background-color: #e2e6ea;
        }

        @media (max-width: 768px) {
            .form-inline a {
                max-width: 120px; /* تعديل الحجم على الأجهزة الصغيرة */
            }
        }
    </style>
</head>

<body>

    <div class="wrapper">

        <section class="height-100vh d-flex align-items-center page-section-ptb login"
                 style="background-image: url('{{ asset('assets/images/sativa.png')}}');">
            <div class="container">
                <div class="row justify-content-center no-gutters vertical-align">

                    <div style="border-radius: 15px;" class="col-lg-8 col-md-8 bg-white">
                        <div class="login-fancy pb-40 clearfix">
                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">حدد طريقة الدخول</h3>
                            <div class="form-inline">
                                
                                <!-- زر ولي الامر -->
                                <a class="btn btn-default col-lg-3" title="ولي امر" href="{{route('login.show','parent')}}">
                                    <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/parent.png')}}">
                                </a>
                                <!-- زر المعلم -->
                                <a class="btn btn-default col-lg-3" title="معلم" href="{{route('login.show','teacher')}}">
                                    <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/teacher.png')}}">
                                </a>
                                <!-- زر الادمن -->
                                <a class="btn btn-default col-lg-3" title="ادمن" href="{{route('login.show','admin')}}">
                                    <img alt="user-img" width="100px;" src="{{ asset('assets/images/user_icon.png') }}">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--================================= login-->
    </div>

    <!-- jquery -->
    <script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <!-- plugins-jquery -->
    <script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
    <!-- plugin_path -->
    <script>
        var plugin_path = 'js/';
    </script>

    <!-- toastr -->
    @yield('js')
    <!-- custom -->
    <script src="{{ URL::asset('assets/js/custom.js') }}"></script>

</body>

</html>
