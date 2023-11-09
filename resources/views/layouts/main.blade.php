<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- tailwind --}}
    @vite('resources/css/app.css')

    <title>@yield('title', 'Anwar')</title>
</head>

<body>
    <div class="container mx-auto p">
        @include('layouts.partials.navbar')
        <div class="flex flex-row">
            <div class="sidebar basis-1/4">
                @include('layouts.partials.sidebar')
            </div>
            <div class="content basis-3/4">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
