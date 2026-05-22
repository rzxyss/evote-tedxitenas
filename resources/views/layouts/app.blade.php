<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/choices.js/choices.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/toastify/toastify.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/iconly/bold.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/app.css">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        @include('layouts.section.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>{{ $title }}</h3>
            </div>
            <div class="page-content">
                @yield('content')
            </div>

            <footer>
                @include('layouts.section.footer')
            </footer>
        </div>
    </div>
    <script src="{{ asset('assets') }}/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets') }}/vendors/apexcharts/apexcharts.js"></script>
    <script src="{{ asset('assets') }}/js/pages/dashboard.js"></script>
    <script src="{{ asset('assets') }}/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="{{ asset('assets') }}/vendors/choices.js/choices.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/toastify/toastify.js"></script>

    @if (session('success'))
        <script>
            Toastify({
                text: @json(session('success')),
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#4fbe87",
            }).showToast();
        </script>
    @endif
    @if ($errors->has('error'))
        <script>
            Toastify({
                text: @json($errors->first('error')),
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#e74c3c",
            }).showToast();
        </script>
    @endif

    @stack('scripts')
    <script src="{{ asset('assets') }}/js/main.js"></script>
</body>

</html>
