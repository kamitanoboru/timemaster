<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TimeMaster</title>
        @include('layouts.css_js')
    </head>
    <body>
        @include('commons.navbar')

        @yield('cover')

        <div class="container">
            @include('commons.error_messages')
            @yield('content')
        </div>

        @include('commons.footer')
    </body>
</html>