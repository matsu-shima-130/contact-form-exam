<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact-form-exam</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@300;450;700&display=swap" rel="stylesheet">

    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__spacer"></div>
                <a class="header__logo" href="/">
                    FashionablyLate
                </a>
                <div class="header__actions">
                    @yield('header-actions')
                </div>
            </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>


</html>