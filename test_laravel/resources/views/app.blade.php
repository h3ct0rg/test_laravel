<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Test Laravel</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="min-h-screen bg-gray-100 text-[#0D124F]">
<div id="app" class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Test Laravel</h1>
    <router-view></router-view>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
