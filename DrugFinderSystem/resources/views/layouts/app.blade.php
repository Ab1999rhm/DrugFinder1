<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

<!-- Main Styles (Bootstrap or Tailwind via app.css) -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<!-- Custom Styles for Drug UI, Modals, Animations, etc. -->
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

<!-- For page-specific styles pushed via @push('styles') -->
@stack('styles')

<!-- Scripts (if using Vite or Mix, uncomment as needed) -->
<!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
</head>
<body class="font-sans antialiased bg-gray-100">
<div class="min-h-screen">
<!-- Navigation Bar -->
@include('layouts.navigation')

<!-- Page Heading (optional) -->
@hasSection('header')
<header class="bg-white shadow">
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
@yield('header')
</div>
</header>
@endif

<!-- Page Content -->
<main>
@yield('content')
{{ $slot ?? '' }}
</main>
</div>

@stack('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>