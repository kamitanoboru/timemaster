
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="{{ secure_asset('js/jquery-ui.js') }}"></script>
        
        <!--fontawesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

        <!-- タイムピッカー-->
        <link rel="stylesheet" href="{{ secure_asset('css/bootstrap-clockpicker.min.css') }}">
        <script type="text/javascript" src="{{ secure_asset('js/bootstrap-clockpicker.min.js') }}"></script>
        
        <!--日付ピッカー-->
        <link rel="stylesheet" href="{{ secure_asset('css/bootstrap-datepicker.min.css') }}">
        <script type="text/javascript" src="{{ secure_asset('js/bootstrap-datepicker.min.js') }}"></script>        
        <script type="text/javascript" src="{{ secure_asset('js/bootstrap-datepicker.ja.min.js') }}"></script>     
        
        <!--モーダルウィンドウ -->
        <link rel="stylesheet" href="{{ secure_asset('css/modal-3.css') }}">
        <script src="{{ secure_asset('js/modal-3.js') }}"></script>
        
        <!--ポップアップ-->
        <script src="{{ secure_asset('js/jquery.modal_fix.js') }}"></script>          
        
        <!--プッシュ通知-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>
        
        
        <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">
        
        
<script>
Push.Permission.request();

</script>