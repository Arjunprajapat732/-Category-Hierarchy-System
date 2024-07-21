<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('layout.header')
</head>
<body>
    <div class="container">
        @include('layout.navbar')
        @yield('content')
    </div>
    @include('layout.script')
    @yield('scripts')
<script>
    function deleteCategory(url, id, message, paramName) {
        const fullUrl = `${url}?${paramName}=${id}`;

        if (confirm(message)) {
            window.location.href = fullUrl;
        }
    }
</script>
</body>
</html>