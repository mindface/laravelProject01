<!DOCTYPE html>
<html lang="ja">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>テスト</title>
    @vite(['resources/css/app.css', 'resources/js/todo.ts'])
</head>

<body>
    @include('components.header')
    @if ($todos->isNotEmpty())
        <ul>
            @foreach ($todos as $item)
                <li>
                    {{ $item->title }}
                </li>
            @endforeach
        </ul>
    @endif

    <div id="todo"></div>
</body>
 
</html>