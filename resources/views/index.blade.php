<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Read Bilingual Manga online in Japanese and English. Everything done with just a single click for translation">
    <meta name="keywords" content="Bilingual Manga, Raw Manga, Japanese Manga, Manga, Learn Japanese">
    <meta name="author" content="Bima Team">
    <title>{{ $title }} - Bilingual Manga</title>
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/css/normalize.css">
    @if (isset($css))
        @foreach ($css as $c)
            <link rel="stylesheet" type="text/css"  href="/css/{{ $c }}">
        @endforeach
    @endif
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Sue+Ellen+Francisco'>
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Lato'>
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Indie+Flower'>
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
</head>

<body>
<div id="notify-container">
    @if (session('success'))
        @include('message.success')
    @elseif (session('error'))
        @include('message.error')
    @elseif (count($errors) > 0)
        @include('message.default_error')
    @endif
</div>

<div id="login-container">
    @include('auth.login')
</div>

<div id="register-container">
    @include('auth.register')
</div>

<div id="supreme-container" class="{{ isset($customCss) ? 'custom' : '' }}">
    <div id="blur-overlay" class="hidden" onclick="disableOverlay()"></div>

    @include('elements.header')

    <div class="container">
        @include($content)
    </div>

    @include('elements.footer')
</div>

<div id="md-box"></div>

<script src="/js/jquery.min.js"></script>
@if (isset($js))
    @foreach ($js as $j)
        <script src="/js/{{ $j }}"></script>
    @endforeach
@endif
<script src="/js/main.js"></script>
</body>

</html>
