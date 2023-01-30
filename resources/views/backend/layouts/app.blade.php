<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PRINTING CV MITRA JAYA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('backend.includes.link')
    @stack('after-link')
</head>
@auth('karyawan')

    <body>
        @include('backend.includes.header')

        @auth('karyawan')
            @include('backend.includes.aside')
        @endauth

        <main id="main" class="main">
            @yield('content')
        </main>

        @include('backend.includes.footer')

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        @include('backend.includes.script')
        @include('sweetalert::alert')
        @stack('after-script')
    </body>
@endauth

@auth('user')

    <body class="toggle-sidebar">
        @include('backend.includes.header')

        @auth('karyawan')
            @include('backend.includes.aside')
        @endauth

        <main id="main" class="main">
            @yield('content')
        </main>

        @include('backend.includes.footer')

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        @include('backend.includes.script')
        @include('sweetalert::alert')
        @stack('after-script')
    </body>
@endauth


</html>
