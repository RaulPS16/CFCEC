<?php
	// Aca se valida si la sesión está abierta
	session_start();
	include_once("loginControl.php");
	// No se pasan valores a la funcion loginControl ya que se asume que está logeado
	$login = new loginControl();
?>
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
    
	<title>Cambio de clave</title>
</head>
<body>

	<?php
	include_once("menu.php");
	$menu = new menu($_SESSION['sId_rol']);

		$fechaActual = date("Y-m-d");
		if (isset($_GET['error']) && $_GET['error'] <> 0) {
			echo "Se a producido un error";
		}

	?>
	<div class="container mant">

		<h2 class="text-center titulos">Cambio de clave</h2>
		
		<form action="#" method="POST" class="needs-validation row" novalidate>
		<div class="col-md-12">
			<div class="has-validation form-floating">
				<input type="password" name="claveAntigua" class="form-control" id="claveAntigua" placeholder="1231435474856"  required>
				<label for="claveAntigua">Clave anterior</label>
				<div class="invalid-feedback">
        			Ingrese una clave
      			</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="has-validation form-floating">
				<input type="password" name="claveNueva1" class="form-control" id="claveNueva1" placeholder="1231435474856"  required>
				<label for="claveNueva1">Clave nueva</label>
				<div class="invalid-feedback">
        			Ingrese una clave
      			</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="has-validation form-floating">
				<input type="password" name="claveNueva2" class="form-control" id="claveNueva2" placeholder="1231435474856"  required>
				<label for="claveNueva2">Confirme clave nueva</label>
				<div class="invalid-feedback">
        			Ingrese una clave
      			</div>
			</div>
		</div>
				
		<div class="col-md-12">
			<br>
		</div>
		<div class="d-grid gap-2 d-md-flex justify-content-md-end">
			<input type="submit" name="btnClientes" class="btn btn-light btn-lg" value="Limpiar">
			<input type="submit" name="btnClientes" class="btn btn-primary btn-lg" value="Aceptar">
		</div>
		
	</form>

	</div>
	
	<?php
		
		if (isset($_GET['datosSQL'])) {
			$datos = unserialize($_GET['datosSQL']);
			print_r( $datos );
			print_r("nombre: ". $datos['nombre']);
		}


	?>
	<script type="text/javascript" src="js/validaForms.js"></script>

	<?php 
		include("footer.html")
	?>
</body>
</html>