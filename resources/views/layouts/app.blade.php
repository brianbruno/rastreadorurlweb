<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rastreador de URL</title>

    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 104px;
        }

        .links > a {
            color: #384145;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        a {
            color: inherit; /* blue colors for links too */
            text-decoration: inherit; /* no underline */
        }

        a:hover {
            color: inherit; /* blue colors for links too */
            text-decoration: inherit; /* no underline */
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
