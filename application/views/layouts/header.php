<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width,initial-scale=1" name="viewport">
<meta content="" name="description">
<meta content="" name="keywords">
<meta content="Paradise Ekpereta" name="author">
<title> HTML5 APP > <?= $page_title; ?></title>
<link href="/public/css/font-awesome.min.css" rel="stylesheet">
<!--<link href='//fonts.googleapis.com/css?family=Bitter:400,700|Source+Sans+Pro:300,400,600,700' rel='stylesheet'>-->

<link href="/public/css/app.css" rel="stylesheet">
<link href="/public/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/public/css/animate.min.css" media="all" rel="stylesheet">
<link href="/public/css/bootstrap-social.css" rel="stylesheet">
<link href="/public/css/style.css" rel="stylesheet">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Fonts -->
    <!--<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">MyApp</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>

          <?php if($this->auth_model->guest()) { ?>
          <div class="pull-right header-buttons">
              <button type="button" class="btn btn-danger navbar-btn" style="margin-right:20px;" data-toggle="modal" data-target="#myLogin" href="#"><span class="fa fa-key"></span> Sign in</button>
              <button type="button" class="btn btn-success navbar-btn" data-toggle="modal" data-target="#mySignup" href="#"> <span class="glyphicon glyphicon-user"></span> Create an account</button>
          </div>
          <?php }else{ ?>
            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi, <?= ucfirst($this->auth_model->user()->firstname); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
            </ul>
          <?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container">