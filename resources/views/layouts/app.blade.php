<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expense Tracker</title>

    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>

    @include('layouts.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

</body>
</html>
