<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printing | CV Mitra Jaya</title>
    @include('frontend.includes.link')
    @stack('after-link')
</head>

<body>
    <div class="whatsapp">
        <a class="icons" target="_blank" href="https://api.whatsapp.com/send?phone=NomorTelephon&text=Caption"><svg
                viewBox="0 0 800 800">
                <path
                    d="M519 454c4 2 7 10-1 31-6 16-33 29-49 29-96 0-189-113-189-167 0-26 9-39 18-48 8-9 14-10 18-10h12c4 0 9 0 13 10l19 44c5 11-9 25-15 31-3 3-6 7-2 13 25 39 41 51 81 71 6 3 10 1 13-2l19-24c5-6 9-4 13-2zM401 200c-110 0-199 90-199 199 0 68 35 113 35 113l-20 74 76-20s42 32 108 32c110 0 199-89 199-199 0-111-89-199-199-199zm0-40c133 0 239 108 239 239 0 132-108 239-239 239-67 0-114-29-114-29l-127 33 34-124s-32-49-32-119c0-131 108-239 239-239z" />
            </svg><span>Hubungi Via WhatsApp</span></a>
    </div>
    @include('frontend.includes.navbar-auth')

    @yield('content')

    @include('frontend.includes.footer')
    @include('frontend.includes.script')
    @stack('after-script')
    @include('sweetalert::alert')
</body>

</html>
