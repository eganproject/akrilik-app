<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Media Gudang Acc' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('public/assets/images/logo/thumb.png') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Space+Grotesk:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icons (Lucide via UNPKG - Fixed Version) -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- Custom Config & Styles -->
    @yield('custom_style')
</head>

<body class="font-sans text-slate-800 antialiased overflow-x-hidden">

    @include('partials.navbar')

    <main>
        @yield('content')

    </main>
    @include('partials.footer')


   @yield('custom_script')
</body>

</html>
