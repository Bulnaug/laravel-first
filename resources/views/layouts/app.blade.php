<!DOCTYPE html>
<html>
<head>
    <title>CRM</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">

    <nav class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">CRM</h1>
        <a href="/contacts" class="text-blue-500">Клиенты</a>
    </nav>

    <div class="bg-white p-6 rounded shadow">
        @yield('content')
    </div>

</div>

</body>
</html>