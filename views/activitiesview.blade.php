<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
        >
    <title>
        Result Page
    </title>
</head>
<body>
    <h1>Last activities for {{$username}}</h1>
    <table>
        <tr>
            <th>Activity Type</th>
            <th>Repository</th>
            <th>Created At</th>
        </tr>
        @foreach ($events as $event)
            <tr>
                <td>{{$event->type}}</td>
                <td>{{$event->repo->name}}</td>
                <td>{{$event->created_at}}</td>
            </tr>
        @endforeach
    </table>
    <button type="button" onclick="window.location.href='/home'">Back</button>
</body>