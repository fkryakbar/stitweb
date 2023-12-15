<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    @vite(['resources/css/app.css'])
</head>

<body class="h-screen flex justify-center items-center flex-col">
    <img src="{{ asset('No data-amico.svg') }}" class="lg:w-[20%] w-[90%]" alt="404">
    <div class="flex gap-2 flex-wrap font-semibold text-slate-500">
        <p>
            @yield('code') |
        </p>
        <p>
            @yield('message')
        </p>
    </div>
    <a href="/" class="text-center text-green-500 underline hover:text-green-700">Back to Home</a>
</body>

</html>
