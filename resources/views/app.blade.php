<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        $PAGE_TITLE = $PAGE_TITLE ?? "LaraPod - Play, Upload, Get Podcasts";
        $authenticatedUser = Auth::user(); // Retrieve authenticated user 
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title><?= $PAGE_TITLE ?></title>
    <!-- Include your CSS styles -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <!-- Pass authenticated user as meta -->
    @if($authenticatedUser)
        <meta name="user" content="{{ json_encode($authenticatedUser) }}">
    @endif
</head>
<body id="app" class="antialiased">
    <!-- Include your JavaScript files -->
    @vite('resources/js/app.js')
</body>
</html>
