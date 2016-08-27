<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/RT5614_Rasko_Lazic/moodle_v2.0/dist/img/favicon.ico">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="/RT5614_Rasko_Lazic/moodle_v2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this view -->
    <link href="/RT5614_Rasko_Lazic/moodle_v2.0/dist/css/moodle/login.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
    <div class="alert alert-danger fade" id="login-error" role="alert">
        <p class="text-center" id="login-error-message"></p>
    </div>

    <form class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="login-button">Sign in</button>
    </form>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="/RT5614_Rasko_Lazic/moodle_v2.0/dist/js/bootstrap.min.js"></script>
<script src="/RT5614_Rasko_Lazic/moodle_v2.0/dist/js/app.js"></script>
</body>
</html>
