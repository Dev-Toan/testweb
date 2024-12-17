<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Quản lý người dùng</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A project management Bootstrap theme by Medium Rare">
        @if (session('toastr'))
            <script>
                var TYPE_MESSAGE = "{{ session('toastr.type') }}";
                var MESSAGE = "{{ session('toastr.message') }}";
            </script>
        @endif
        <link href="assets/img/favicon.ico" rel="icon" type="image/x-icon">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('user/theme.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{ asset('user/css.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{ asset('user/toastr.min.css') }}" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
        <div class="layout layout-nav-side">
            <div class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
                <a class="navbar-brand" href="/">
                <img alt="Pipeline" src="https://pipeline.mediumra.re/assets/img/logo.svg" />
                </a>
                <div class="d-flex align-items-center">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="d-block d-lg-none ml-2">
                        <div class="dropdown">
                            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img alt="Image" src="https://pipeline.mediumra.re/assets/img/avatar-male-4.jpg" class="avatar" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="nav-side-user.html" class="dropdown-item">Profile</a>
                                <a href="utility-account-settings.html" class="dropdown-item">Account Settings</a>
                                <a href="#" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse flex-column" id="navbar-collapse">
                    <ul class="navbar-nav d-lg-block">
                        <li class="nav-item">
                            <a class="nav-link" href="/profile">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('get.user.update_info') }}">Cập Nhật Thông Tin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('get.user.transaction') }}">Quản Lý Đơn Hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('get.user.favourite') }}">Sản Phẩm Yêu Thích</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('get.user.change.password') }}">Thay Đổi password</a>
                        </li>
                    </ul>
                    <hr>

                </div>
                <div class="d-none d-lg-block">
                    <div class="dropup">
                        <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img alt="Image" src="https://pipeline.mediumra.re/assets/img/avatar-male-4.jpg" class="avatar" />
                        </a>
                        <div class="dropdown-menu">
                            <a href="nav-side-user.html" class="dropdown-item">Profile</a>
                            <a href="utility-account-settings.html" class="dropdown-item">Account Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-container">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-xl-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Required vendor scripts (Do not remove) -->
        <script type="text/javascript" src="{{ asset('user/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/bootstrap.js') }}"></script>

        <script type="text/javascript" src="{{ asset('user/autosize.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/flatpickr.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/draggable.bundle.legacy.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/swap-animation.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/list.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/theme.js') }}"></script>
        <!-- This appears in the demo only - demonstrates different layouts -->
        <style type="text/css">
            .layout-switcher{ position: fixed; bottom: 0; left: 50%; transform: translateX(-50%) translateY(73px); color: #fff; transition: all .35s ease; background: #343a40; border-radius: .25rem .25rem 0 0; padding: .75rem; z-index: 999; }
            .layout-switcher:not(:hover){ opacity: .95; }
            .layout-switcher:not(:focus){ cursor: pointer; }
            .layout-switcher-head{ font-size: .75rem; font-weight: 600; text-transform: uppercase; }
            .layout-switcher-head i{ font-size: 1.25rem; transition: all .35s ease; }
            .layout-switcher-body{ transition: all .55s ease; opacity: 0; padding-top: .75rem; transform: translateY(24px); text-align: center; }
            .layout-switcher:focus{ opacity: 1; outline: none; transform: translateX(-50%) translateY(0); }
            .layout-switcher:focus .layout-switcher-head i{ transform: rotateZ(180deg); opacity: 0; }
            .layout-switcher:focus .layout-switcher-body{ opacity: 1; transform: translateY(0); }
            .layout-switcher-option{ width: 72px; padding: .25rem; border: 2px solid rgba(255,255,255,0); display: inline-block; border-radius: 4px; transition: all .35s ease; }
            .layout-switcher-option.active{ border-color: #007bff; }
            .layout-switcher-icon{ width: 100%; border-radius: 4px; }
            .layout-switcher-body:hover .layout-switcher-option:not(:hover){ opacity: .5; transform: scale(0.9); }
            @media all and (max-width: 990px){ .layout-switcher{ min-width: 250px; } }
            @media all and (max-width: 767px){ .layout-switcher{ display: none; } }
        </style>
        <div class="layout-switcher" tabindex="1">
            <div class="layout-switcher-head d-flex justify-content-between">
                <span>Select Layout</span>
                <i class="material-icons">arrow_drop_up</i>
            </div>
            <div class="layout-switcher-body">
            </div>
        </div>
        <script src="https://codeseven.github.io/toastr/build/toastr.min.js"></script>
        <script>
            if(typeof TYPE_MESSAGE != "undefined"){
                switch(TYPE_MESSAGE){
                    case 'success':
                        toastr.success(MESSAGE)
                        break;
                    case 'error':
                        toastr.error(MESSAGE)
                        break;
                    case 'warning':
                        toastr.warning(MESSAGE)
                        break;
                    case 'info':
                        toastr.info(MESSAGE)
                        break;
                }
            }
            //$(function(){
            //    $('#popup-messages').modal();
            //});
        </script>
    </body>

</html>
