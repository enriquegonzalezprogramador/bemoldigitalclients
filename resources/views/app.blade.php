<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>

  {{-- Icon --}}
  <link rel="icon" href="{{asset('img/logo-redondo.png')}}">

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app" class="container">
    <div class="row">
        <div class="col-xs-12">
          @yield('content')
        </div>
    </div>
  </div>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
