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
<link href="/public/css/style.css" rel="stylesheet">
<link href="/public/css/signin.css" rel="stylesheet">
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

    <div class="container">

      <?= form_open('',['class'=>'form-signin']); ?>
      <?= $this->flash->displayFlashMessages(); ?>
        <h2 class="form-signin-heading">Administrator login</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" class="input form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" class="input form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
      <?= form_close(); ?>

    </div> <!-- /container -->
<!-- Scripts -->
    <script src="/public/js/jquery.min.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/public/js/jquery.form.js" type="text/javascript"></script>
    <script src="/public/js/app.js" type="text/javascript"></script>
</body>
</html>