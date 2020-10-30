<!DOCTYPE html>
<html>
    <head lang="en">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>2MA FILES</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    </head>
    <body>
        <div style="height: 600px;">
            <div id="fm"></div>
        </div>
        <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    </body>
</html>
