<html lang="zxx" class="js">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
    <title>@yield('titre') | JOBOPTIQUE</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashlitee1e3.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/themee1e3.css') }}">
</head>

<body class="nk-body bg-white npc-default pg-error no-touch nk-nio-theme">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">

                @yield('content')
                
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/bundlee1e3.js') }}"></script>
    <script src="{{ asset('assets/js/scriptse1e3.js') }}"></script>
    <script src="{{ asset('assets/js/demo-settingse1e3.js') }}"></script>

</body>

</html>
