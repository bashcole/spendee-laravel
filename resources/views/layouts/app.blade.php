<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
    <script src="{{ asset('js/litepicker/litepicker.min.js') }}"></script>
    <script src="{{ asset('js/litepicker/plugins/ranges.min.js') }}"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="flex flex-col justify-start min-h-screen">

    <!-- Page Heading -->
    <header class="bg-white shadow-sm">
        @include('common.header')
    </header>

    <!-- Page Content -->
    <main class="grow bg-gray-50">
        <div class="max-w-max-w-screen-lg mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    @if (isset($footer))
        <footer class="bg-white mt-auto hidden">
            {{ $footer }}
        </footer>
    @endif
</div>

</body>
</html>
