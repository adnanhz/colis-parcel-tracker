<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Colis</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('css/app.css')}}" />

    <head>

    <body>
        <div id="app"></div>
        <script src="{{asset('js/app.js')}}"></script>
        <script>
            window.laravel = {
                CLIENT_ID: '{{env("CLIENT_ID")}}',
                CLIENT_SECRET: '{{env("CLIENT_SECRET")}}',
                HOST: '{{env("APP_URL")}}'
            }
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
    </body>

</html>