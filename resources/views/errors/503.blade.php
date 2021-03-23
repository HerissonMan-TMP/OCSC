<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="icon" type="image/png" href="{{ asset("img/ocsc_logo.png") }}">
        <link rel="stylesheet" href="{{ asset("css/app.css") }}">
        <script src="https://kit.fontawesome.com/6cbe367b1a.js" crossorigin="anonymous"></script>

        <title>503 Service Unavailable - {{ config("app.name") }}</title>
    </head>
    <body class="bg-gray-700 h-screen flex flex-col justify-center items-center">
        <i class="flex-shrink-0 text-yellow-500 fas fa-wrench fa-fw fa-6x"></i>

        <div class="text-center mt-6 rounded-md px-4 py-5 md:p-16 overflow-hidden">
            <div class="mb-8">
                <span class="font-bold text-6xl text-gray-300 mt-2 mb-6">503</span>
            </div>
            <span class="font-light text-2xl text-gray-300 mt-2 mb-6">{{ config('app.name') }} website is currently in maintenance.</span>
        </div>
    </body>
</html>
