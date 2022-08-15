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
    
	<title>Mantenimiento de tarjetas</title>
</head>
<body>

	<?php
	include_once("menu.php");
	$menu = new menu($_SESSION['sId_rol']);

		$fechaActual = date("Y-m-d");
		include_once("muestraErrores.php");
		$retornoDatos = array("id_tarjeta" => "", "id_cuenta" => "", "estado" => "");
		$fechaActual = date("Y-m-d");
		//&& $_GET['error'] <> 0
		if (isset($_GET['error']) ) {
			$muestraErrores = new muestraErrores($_GET['error']);
		}

		if (isset($_GET['datosSQL'])) {
			$retornoDatos = unserialize($_GET['datosSQL']);
		}

	?>
	<div class="container mant">

		<h2 class="text-center titulos">Mantenimiento de tarjetas</h2>
		
		<form action="prcTarjetas.php" method="POST" class="needs-validation row" novalidate>
		<div class="col-md-12">
			<div class="has-validation form-floating">
				<input type="number" name="id_tarjeta_original" class="visually-hidden" id="id_tarjeta_original"value="<?php echo($retornoDatos['id_tarjeta']); ?>">
				<input type="number" name="id_tarjeta" class="form-control" id="id_tarjeta" placeholder="1231435474856" value="<?php echo($retornoDatos['id_tarjeta']); ?>">
				<label for="id_tarjeta">Numero de tarjeta</label>
				<div class="invalid-feedback">
        			Ingrese un numero de tarjeta
      			</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class=" form-floating">
				<input type="number" name="id_cuenta" class="form-control" id="id_cuenta" placeholder="7456872532" value="<?php echo($retornoDatos['id_cuenta']); ?>"  >
				<label for="id_cuenta">Numero de cuenta</label>
				<div class="invalid-feedback">
        			Ingrese un numero de cuenta correcto
      			</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="has-validation form-floating">
				<select class="form-select" name="estado" id="estado" required>
					<?php
					if ($retornoDatos['estado'] <> '') {
						if ($retornoDatos['estado'] == 1) {
							echo "<option value='1'>Activo</option>";
							echo "<option value='2'>Inactivo</option>";
						}else{
							echo "<option value='2'>Inactivo</option>";
							echo "<option value='1'>Activo</option>";
							
						}
						
					}else{
						echo "<option value='1'>Activo</option>";
						echo "<option value='2'>Inactivo</option>";
					}
						
					?>
					}
				</select>
				<label for="estado">Estado de la tarjeta</label>
				<div class="invalid-feedback">
        			Ingrese un estado
      			</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<br>
		</div>
		<div class="d-grid gap-2 d-md-flex justify-content-md-end">
			<input type="submit" name="btnTarjetas" class="btn btn-light btn-lg" value="Eliminar">
			<input type="submit" name="btnTarjetas" class="btn btn-warning btn-lg" value="Modificar">
			<input type="submit" name="btnTarjetas" class="btn btn-secondary btn-lg" value="Insertar">
			<input type="submit" name="btnTarjetas" class="btn btn-primary btn-lg" value="Consultar">
		</div>
		
	</form>

	</div>
	<script type="text/javascript" src="js/validaForms.js"></script>

	<?php 
		include("footer.html")
	?>
</body>
</html>