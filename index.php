<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstap 5.1v -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<!-- Google icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <!-- Estilos personales -->
    <link rel="stylesheet" type="text/css" href="css/estilos-propios.css">

	<title>SFCEC</title>
</head>
<body>

	<div class="container">
		
		<form method="POST" action="inicio.php" class="form-login">
			<h2 class="text-center">Sistema financiero</h2>
			<br>
			<div class="form-floating mb-3">
			  <input type="number" class="form-control" id="floatingInput" placeholder="102340567" name="loginUsuario">
			  <label for="floatingInput">Codigo de usuario</label>
			</div>
			<div class="form-floating">
			  <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="loginClave">
			  <label for="floatingPassword">Contraseña</label>
			</div>
			<br>
			<div class="d-grid gap-2 d-md-flex justify-content-md-end">
				<input type="submit" name="btnLogin" class="btn btn-primary btn-lg" value="Ingresar">
			</div>
		</form>

	</div>
	

	<script type="text/javascript" src="js/validaForms.js"></script>
	<?php include("footer.html");	?>
</body>
</html>