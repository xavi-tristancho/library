<!doctype html>
<html ng-app="app">
<head>
    <meta charset="utf-8">
    <title>Library</title>

    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="bower_components/Bootflat/bootflat/css/bootflat.css">
    <link rel="stylesheet" href="bower_components/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" href="bower_components/sweetalert/lib/sweet-alert.css">
    <link rel="stylesheet" href="css/font-mfizz-1.2/font-mfizz.css">
    <link rel="stylesheet" href="css/app.css">

</head>
<body>

<div ng-include="'views/partials/navbar.html'"></div>

<div ui-view class="container">

</div>

<script src="js/bundle.js"></script>

</body>
</html>
