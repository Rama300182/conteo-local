<?php
session_start();

if(isset($_SESSION['username'])){
		session_destroy();
}
?>

<!doctype html>
<html lang="en-US">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--<link rel="stylesheet" type="text/css" href="css/css.css">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="styles/login.css">
	<meta charset="utf-8">

	<title>Conteo Stock</title>
	<link rel="shortcut icon" href="images/caja.png"/>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>


<body>

    <div class="container">

		<aside id="logo" align="center">
			<img src="images/Logo conteo.png" style="height: 230px; width: 300px">
		</aside>

        <fieldset>

            <form action="validar.php" method="post">

			<div class="container login-form">
					<h2 class="login-title">- Please Login -</h2>
					<div class="panel panel-default">
						<div class="panel-body">
							<form>
								<div class="input-group login-userinput">
									<span class="input-group-addon"><span class="fa fa-user mr-3" id="userIcon"></span></span>
									<input class="form-control" type="text" id="usuarioRegistrado" name="user" placeholder="Usuario" required autofocus>
								</div>
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-lock mr-3" id="userIcon"></span></span>
									<input class="form-control" type="password" value="hunter2" id="example-password-input" placeholder="Contraseña" name="pass" required>
									<span id="showPassword" class="input-group-btn">
							<button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
						</span>  
								</div>
								<button class="btn btn-primary btn-block login-button" type="submit"><i class="fa fa-sign-in"></i> Ingresar</button>		
							</form>			
						</div>
					</div>
				</div>

            </form>

        </fieldset>

    </div> <!-- end login-form -->

</body>
</html>