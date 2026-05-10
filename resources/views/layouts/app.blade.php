<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - {{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.ico" type="image/x-icon">
    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/icons/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/icons/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/icons/fontawesome/css/solid.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="{{ asset('assets') }}/plugin/select2/css/select2.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/board.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/chat.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">
    @stack('page-styles')
</head>

<body>
    <!-- ========== NAVBAR ========== -->
    @include('layouts.section.navbar')

    <!-- ========== SIDEBAR ========== -->
    @include('layouts.section.sidebar')

    <!-- ========== MAIN CONTENT ========== -->
    <main class="main" id="main" role="main">
        @yield('content')
    </main>

    @include('layouts.section.footer')
    @stack('page-scripts')
</body>

</html>
