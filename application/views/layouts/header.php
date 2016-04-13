<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width,initial-scale=1" name="viewport">
<meta content="" name="description">
<meta content="" name="keywords">
<meta content="Paradise Ekpereta" name="author">
<title> Empathy Healthcare > <?= $page_title; ?></title>
<link href="/public/css/font-awesome.min.css" rel="stylesheet">
<!--<link href='//fonts.googleapis.com/css?family=Bitter:400,700|Source+Sans+Pro:300,400,600,700' rel='stylesheet'>-->

<link href="/public/css/app.css" rel="stylesheet">
<link href="/public/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/public/css/animate.min.css" media="all" rel="stylesheet">
<link href="/public/css/bootstrap-social.css" rel="stylesheet">
<link href="/public/css/style.css" rel="stylesheet">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<!--<link rel="icon" href="favicon.ico" type="image/x-icon">-->

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
          <a class="navbar-brand" href="/">MyApp</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

          <?php if($this->auth_model->guest()) { ?>
          <div class="pull-right header-buttons">
              <button type="button" class="btn btn-danger navbar-btn" style="margin-right:20px;" data-toggle="modal" data-target="#myLogin" href="#"><span class="fa fa-key"></span> Sign in</button>
          </div>
          <?php }else{ ?>
            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi, <?= ucfirst($this->auth_model->user()->firstname); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">My Profile</a></li>
                <li><a href="#">My Settings</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/auth/logout">Log Out</a></li>
              </ul>
            </li>
            </ul>
          <?php } ?>
          <ul class="nav navbar-nav pull-right">
            <li><a href="#about">Home <i class="fa fa-angle-down"></i></a></li>
            <li><a href="#contact">Pricing <i class="fa fa-angle-down"></i></a></li>
            <li><a href="#contact">Support <i class="fa fa-angle-down"></i></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container">
    <?= $this->flash->displayFlashMessages(); ?>