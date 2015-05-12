<!doctype html>
<html ng-app="app">
<head>
    <meta charset="utf-8">
    <title>Library</title>

    <link rel="stylesheet" href="app/bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="app/bower_components/Bootflat/bootflat/css/bootflat.css">
    <link rel="stylesheet" href="app/bower_components/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" href="app/bower_components/sweetalert/lib/sweet-alert.css">
    <link rel="stylesheet" href="app/bower_components/angularjs-toaster/toaster.css">
    <link rel="stylesheet" href="app/bower_components/sweetalert/lib/sweet-alert.css">
    <link rel="stylesheet" href="app/bower_components/angular-loading-bar/build/loading-bar.css">
    <link rel="stylesheet" href="css/font-mfizz-1.2/font-mfizz.css">
    <link rel="stylesheet" href="css/app.css">

</head>
<body>

<toaster-container></toaster-container>

<navbar ng-if="token"></navbar>

<div ui-view class="container">

</div>

<script src="app/bundle.js"></script>
<script src="app/bower_components/angularjs-toaster/toaster.js"></script>
<script src="app/bower_components/sweetalert/lib/sweet-alert.js"></script>
<script src="app/bower_components/angular-sweetalert/SweetAlert.js"></script>
<script src="app/bower_components/angular-translate-loader-static-files/angular-translate-loader-static-files.js"></script>
<script src="app/bower_components/angular-loading-bar/build/loading-bar.js"></script>

</body>
</html>
