<!DOCTYPE html>
<html lang="ja">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>テスト</title>
    @vite(['resources/css/app.css', 'resources/js/task.ts'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('components.header')
    @if ($tasks->isNotEmpty())
        <ul>
            @foreach ($tasks as $item)
                <li>
                    {{ $item["title"] }}
                </li>
            @endforeach
        </ul>
    @endif
    <div id="task"></div>
</body>
 
</html>