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
    <div class="container mx-auto">
        @include('layouts.partials.navbar')
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-4 m-5 ">
            @include('layouts.partials.sidebar')

            <div class="content col-span-3 ">
                <div class="flex flex-col items-center gap-3 justify-center">
                    <h1 class="text-6xl font-bold text-gray-700 pb-3 ">@yield('heading')</h1>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

</html>
