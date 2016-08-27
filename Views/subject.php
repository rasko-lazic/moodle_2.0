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

    <title>
        <?php
        $appContainer = new \FDF\Core\Container();
        $subjectController = $appContainer->get('subject');
        echo $subjectController->getTitle();
        ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="/RT5614_Rasko_Lazic/moodle_v2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this view -->
    <link href="/RT5614_Rasko_Lazic/moodle_v2.0/dist/css/moodle/home.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Moodle 2.0</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/RT5614_Rasko_Lazic/moodle_v2.0/home">Home</a></li>
                <li><a href="/RT5614_Rasko_Lazic/moodle_v2.0/user/login">Login</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="content-container">
    <div class="page-header text-center">
        <h1>
            <?php
            echo $subjectController->getTitle();
            ?>
        </h1>
    </div>

    <div class="row">
        <div class="col-md-9">
            <?php
            $subjectController->generateContent();
            ?>
        </div>
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">Saradnici na predmetu</div>
                <div class="panel-body">
                    <?php
                    $subjectController->getAssistantContent();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content-container -->

<footer class="footer">
    <div class="container">
        <p class="footer-text text-center">created with ♥ by Rasko Lazic &copy;<small> August 2016</small></p>
    </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/RT5614_Rasko_Lazic/moodle_v2.0/dist/js/bootstrap.min.js"></script>
</body>
</html>