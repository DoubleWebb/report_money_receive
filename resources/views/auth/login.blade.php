<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | LogIn</title>
    <!-- APP CSS -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('dashmix/css/oneui.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
</head>

<body>
    <!-- Loader -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- From -->
    <div id="page-container">
        <main id="main-container">
            <div class="hero-static">
                <div class="content">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-4">
                            <!-- Sign In Block -->
                            <div class="block block-rounded block-themed mb-0">
                                <div class="block-content">
                                    <div class="p-sm-3 px-lg-4 py-lg-5 text-center">
                                        <h1 class="h2 mb-1">Report Workio Doubleweb</h1>
                                        <p class="text-muted">
                                            ยินดีต้อนรับ กรุณาเข้าสู่ระบบ
                                        </p>
                                        <div id="from_login">
                                            <div class="py-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-alt form-control-lg" id="username" placeholder="Username">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-alt form-control-lg" id="password" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12 col-xl-12">
                                                    <button type="button" class="btn btn-block btn-alt-primary" id="btn_login" onclick="Do_login()">
                                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> ล็อกอินเข้าสู่ระบบ
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content content-full font-size-sm text-muted text-center">
                    <strong>Report Workio</strong> &copy; <span data-toggle="year-copy"></span>
                </div>
            </div>
        </main>
    </div>
</body>
    <!-- APP JS -->
    <script src="{{ url('js/app.js') }}"></script>
    <script src="{{ url('dashmix/js/oneui.app.min.js') }}"></script>
    <script src="{{ url('dashmix/js/oneui.core.min.js') }}"></script>
    <script src="{{ url('js/auth/login.js') }}"></script>
</html>