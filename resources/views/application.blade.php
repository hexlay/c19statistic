<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>C19Stats</title>
    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
</head>

<body>
<noscript>
    <strong>"No js, no go" :(.</strong>
</noscript>
<div id="app"></div>

<script src="{{ asset(mix('js/app.js')) }}"></script>
</body>
</html>
