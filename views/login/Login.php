<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>BioVet</title>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
	<link rel="stylesheet" href="/public/build/assets/css/style.css">
	<link href="/public/build/assets/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
	<a href="/" style="text-decoration: none;" class="button login__submit2" id="login">
		<i class="button__icon2 fas fa-chevron-left"></i>
		<span class="button__text">Atrás</span>
	</a>
	<div class="container">
		<?php foreach ($errores as $error) : ?>
			<div class="alert alert-warning d-flex align-items-center justify-content-center p-1" role="alert">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
					<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
				</svg>
				<div>
					<?php echo $error ?>
				</div>
			</div>
		<?php endforeach; ?>
		<div class="screen">

			<div class="screen__content">
				<h1 id="Welcome">Bienvenido</h1>
				<form class="login" method="POST" action="/login" id="form1">
					<div class="login__field">
						<i class="login__icon fas fa-user"></i>
						<input required type="email" name="Email" class="login__input" placeholder="Correo">
					</div>
					<div class="login__field">
						<i class="login__icon fas fa-lock"></i>
						<input required type="password" name="Contrasena" class="login__input" placeholder="Contraseña">
					</div>
					<button type="submit" class="button login__submit" id="login">
						<span class="button__text">Iniciar sesión</span>
						<i class="button__icon fas fa-chevron-right"></i>
					</button>
				</form>
			</div>
			<div class="screen__background">
				<span class="screen__background__shape screen__background__shape4"></span>
				<span class="screen__background__shape screen__background__shape3"></span>
				<span class="screen__background__shape screen__background__shape2"></span>
				<span class="screen__background__shape screen__background__shape1"></span>
			</div>
		</div>
	</div>

</body>

</html>