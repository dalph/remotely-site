<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Widget Local Submit</title>
    </head>
    <body>
        <div>
            <div id="widget">
                    <form id="form" @submit.prevent="sendMessage()">
                        <div class="row">
                            <label for="name">Имя:</label>
                            <input type="text" name="name" id="name">
                        </div>
                        <div class="row">
                            <label for="message">Сообщение:</label>
                        </div>
                        <div class="row">
                            <textarea name="message" id="message"></textarea>
                        </div>
                        <div class="row">
                            <button>Отправить</button>
                        </div>
                    </form>
                    <div id="messages">
                        @foreach ($messages as $message)
                            <div class="row">
                                <b>{{$message->name}}</b>: <span>{!! $message->message !!}</span>. <i>({{ \Carbon\Carbon::parse($message->created)->format('d.m.Y H:i:s')}})</i>
                            </div>
                        @endforeach
                    </div>
                </div>
        </div>
        <link rel="stylesheet" href="/css/app.css">
        <script src="/js/app.js"></script>
    </body>
</html>
