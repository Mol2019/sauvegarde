<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config("app.name")}}</title>
        <link href="{{asset('assets/public/css/bootstrap.min.css')}}" rel="stylesheet" /> <!-- https://getbootstrap.com/ -->
        <link href="{{asset('assets/public/fontawesome/css/all.min.css')}}" rel="stylesheet" /> <!-- https://fontawesome.com/ -->
        <link href="{{asset('assets/public/css/templatemo-diagoona.css')}}" rel="stylesheet" />
    </head>
   <body>
        <div class="tm-container">        
          <div>
              @include('layouts.partials._nav')
              
              @yield('content')
          </div>        
              @include('layouts.partials._footer')
    </div>
    
      <script src="{{asset('assets/public/js/jquery-3.4.1.min.js')}}"></script>
      <script src="{{asset('assets/public/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('assets/public/js/jquery.backstretch.min.js')}}"></script>
      <script src="{{asset('assets/public/js/templatemo-script.js')}}"></script>
  </body>
</html>
