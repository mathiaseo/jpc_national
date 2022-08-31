<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document</title>
</head>
<body>

<header>
 <h3> le header ici </h3>
</header>

    @yield("body")

<footer>
 <h3> le footer ici </h3>
</footer>
<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>