<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <script src="{{asset('assets/js/axios.min.js')}}"></script>
    <script src="{{asset('assets/js/marked.min.js')}}"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-950 overscroll-y-contain">

@include('components.drawPad')


</body>
</html>
