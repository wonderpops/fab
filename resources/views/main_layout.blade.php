<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="/public/js/jquery-barcode.js"></script>  
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script> 
    <script src="/public/js/functions.js"></script>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="/css/print.css" media="print"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.8.0/css/bulma.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <title>Машины</title>
    </head>
    <body>

        @include('layouts.navbar')

        <!-- main-container -->
        <div id="main_container" class="columns main-container">
            <div class="column is-2">@yield('search_block')</div>
            <div class="column is-8">@yield('main_content')</div>
            <div class="column is-2"></div>
        </div>

        <!-- modal-container -->
        <div id="modal_container" class="modal">
            <div class="modal-background" onclick="document.querySelector('#modal_container').classList.toggle('is-active');history.back();"></div>
            <div id="modal_content" class="modal-container">
            </div>
            <button class="modal-close is-large" aria-label="close" onclick="document.querySelector('#modal_container').classList.toggle('is-active');history.back();"></button>
        </div>

    </body>
</html>