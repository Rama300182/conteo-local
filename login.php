<?php
session_start();

if(isset($_SESSION['username'])){
		session_destroy();
}
?>

<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inventario Sucursal</title>
    <link rel="shortcut icon" href="images/caja.png"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/login.css">
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="text-center mb-4">
                    <img src="images/Logo conteo.png" alt="Logo" class="img-fluid" style="max-height: 200px;">
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="validar.php" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="usuarioRegistrado" name="user" placeholder="Usuario" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="example-password-input" name="pass" placeholder="Contraseña" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="showPassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">
                                <i class="fas fa-sign-in-alt"></i> Ingresar
                            </button>
							<?php
								if (isset($_SESSION['login_error'])) {
									echo '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
											' . htmlspecialchars($_SESSION['login_error']) . '
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>';
									unset($_SESSION['login_error']);
								}
							?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<script>

		document.getElementById('showPassword').addEventListener('click', function (e) {
			var passwordInput = document.getElementById('example-password-input');
			var icon = this.querySelector('i');
			if (passwordInput.type === 'password') {
				passwordInput.type = 'text';
				icon.classList.remove('fa-eye');
				icon.classList.add('fa-eye-slash');
			} else {
				passwordInput.type = 'password';
				icon.classList.remove('fa-eye-slash');
				icon.classList.add('fa-eye');
			}
		});
		
</script>
</body>
</html>