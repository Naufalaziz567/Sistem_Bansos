<!DOCTYPE html>
<html class="h-full bg-gray-100 dark:bg-gray-900" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
</head>
<body class="h-full">
    
</body>
</html>
<div class="min-h-full">
  <x-navbar> </x-navbar>
  <x-header>{{ $title }}</x-header>

  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
        {{ $slot }}
        </div>
      
    </div>
  </main>
</div>