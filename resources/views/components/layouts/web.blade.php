<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ env('APP_URL') }}" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="{{ env('APP_URL') }}/storage/@yield('thumbnail')" />

    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ env('APP_URL') }}" />
    <meta property="twitter:title" content="@yield('title')" />
    <meta property="twitter:description" content="@yield('description')" />
    <meta property="twitter:image" content="{{ env('APP_URL') }}/storage/@yield('thumbnail')" />
</head>

<body x-data="{ open: false }">
    <x-navbar />
    {{ $slot }}
</body>

</html>
