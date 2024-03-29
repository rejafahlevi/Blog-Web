<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Birdy</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
<script>
    // Fungsi untuk menyembunyikan pesan setelah beberapa detik
    function hideMessage() {
        $('#success-message, #error-message').fadeOut('slow');
    }

    // Panggil fungsi hideMessage() setelah 3000 milidetik (2 detik)
    $(document).ready(function() {
        setTimeout(hideMessage, 2000);
    });
</script>
<script src="//code.jquery.com/jquery-3.7.0.js"></script>
<script src="//cdn.datatables.net/1.13.7/js/dataTables.tailwindcss.min.js"></script>
<script src="//cdn.tailwindcss.com"></script>

<!-- DataTables -->
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    let table = new DataTable('#myTable');
</script>

</html>