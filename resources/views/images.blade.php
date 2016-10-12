<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title>FileAPI</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('upload-image/css/common.css')}}">
</head>
<body>

<div class="container">
    <div id="file" class="fl"><canvas id="view" width="64" height="64"></canvas></div>
    <div class="upload-btn fl">
        <span>+</span>
        <input type="file" name="upload" id="fu">
    </div>
</div>

<script type="text/javascript" src="{{URL::asset('upload-image/scripts/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('upload-image/scripts/app.js')}}"></script>
</body>
</html>