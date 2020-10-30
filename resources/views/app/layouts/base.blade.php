<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            {{$title ?? ""}}  {{config('app.name')}}
        </title>
        @include('app.layouts.assets.styles')
        @yield('styles')
    </head>
    <body class="materialdesign">
         <!-- Header top area start-->
        <div class="wrapper-pro">
            @include('app.layouts.partials._sidebar')
            <!-- Header top area start-->
            <div class="content-inner-all">
                @include('app.layouts.partials._header')
                <!-- Header top area end-->
                @include("app.layouts.partials._breadcome")
                <!-- Breadcome End-->
                <!-- Mobile Menu start -->
                @include('app.layouts.partials._mobilemenu')

                @yield('app-content')

            <div class="modal" id="form">
                <div class="modal-dialog">
                    <div class="modal-content">
                        @yield('form-modal')
                    </div>
                </div>
            </div>

        <div class="modal" id="logout">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <h4 class="modal-title w-100">Etes vous sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez vous réelement vous déconnectez du sytème ? .</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger ok">Déconnexion</button>
                    </div>
                </div>
            </div>
        </div>
        @include('app.layouts.assets.scripts')
        <script>
            $('#logout .ok').click(function(event){
                event.preventDefault();
                document.getElementById('logout-form').submit();
            })
        </script>
       @yield('scripts')

    </body>
</html>
