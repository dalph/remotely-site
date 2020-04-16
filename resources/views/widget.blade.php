<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Widget</title>
    </head>
    <body>
        <div id="vue_app">
            <widget-component></widget-component>
        </div>
        <link rel="stylesheet" href="/css/app.css">
        <script>
            window.page_uid = '{{$page_uid ?? 'no page uid'}}';
        </script>
        <script src="/js/app.js"></script>
    </body>
</html>
