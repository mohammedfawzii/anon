<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/site/images/logo/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/site/css/style-prefix.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <x-ovrely />
    <x-notification />
    <x-header />
    <main>
        <div class="product-container">
            <div class="container">
                <div class="product-box">
                    @yield('content')
                </div>
            </div>
        </div>

    </main>

    <x-footer />
    <script src="{{ asset('assets/site/js/script.js') }}"></script>
    <script src="{{ asset('assets/site/js/main.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
