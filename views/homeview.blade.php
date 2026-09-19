<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
        >
    <title>
        Home Page
    </title>
</head>
<body>
<h1>Get GitHub Activities</h1>
<main>
    <form method="GET" action="/activities">
        <label for="username">Enter Username</lable>
        <input type="text" name="username" id="username" required />
        <button type="submit">Enter</button>
    </form>
</main>
</body>