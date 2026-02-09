<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <link rel="icon" type="image/png" href="{{ asset('public/assets/images/logo/thumb.png') }}">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            500: '#38bdf8',
                            600: '#0ea5e9',
                            700: '#0284c7',
                        },
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full bg-slate-950 text-slate-100 antialiased">
    <div class="min-h-screen grid grid-cols-[260px_1fr] lg:grid-cols-[240px_1fr] xl:grid-cols-[280px_1fr]">
        @include('admin.partials.sidebar')

        <div class="flex flex-col min-h-screen">
            @include('admin.partials.navbar')

            <main class="flex-1 p-6 lg:p-8 space-y-6 bg-gradient-to-b from-slate-950 via-slate-950 to-slate-900">
                @yield('content')
            </main>

            @include('admin.partials.footer')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
