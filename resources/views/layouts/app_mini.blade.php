<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TimeMastert</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
        
        <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

        <!-- タイムピッカー-->
        <link rel="stylesheet" href="{{ secure_asset('css/bootstrap-clockpicker.min.css') }}">
        <script type="text/javascript" src="{{ secure_asset('js/bootstrap-clockpicker.min.js') }}"></script>
        
        <!--モーダルウィンドウ -->
        <link rel="stylesheet" href="{{ secure_asset('css/modal-3.css') }}">
        <script src="{{ secure_asset('js/modal-3.js') }}"></script>
        
          
        
        
        
        <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">
    </head>
    <body>

        <div class="container">
            @include('commons.error_messages')
            @yield('content')
        </div>

        @include('commons.footer')
    </body>
</html>