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
    
	<title>Mantenimiento de Servicios</title>
</head>
<body>

	<?php
	include("menu.php");
	include_once("muestraErrores.php");
		$retornoDatos = array("id_servicio" => "", "nombre_servicio" => "", "descripcion" => "");
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

		<h2 class="text-center titulos">Mantenimiento de Servicios</h2>
		
		<form action="prcServicios.php" method="POST" class="needs-validation row" novalidate>
		<div class="col-md-3">
			<div class="has-validation form-floating">
				<input type="number" name="id_servicio" class="form-control" id="id_servicio" placeholder="1234" value="<?php echo($retornoDatos['id_servicio']) ?>"  required>
				<label for="id_servicio">Numero de servicio</label>
				<div class="invalid-feedback">
        			Ingrese un numero de servicio
      			</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class=" form-floating">
				<input type="text" name="nombre_servicio" class="form-control" id="nombre_servicio" placeholder="Pagos automaticos" value="<?php echo($retornoDatos['nombre_servicio']) ?>" >
				<label for="nombre_servicio">Nombre del Servicio</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class=" form-floating">
				<textarea type="text" name="descripcion" class="form-control" id="descripcion" maxlength="100" rows="3" placeholder="Ejemplo de que hace el servicio"><?php echo($retornoDatos['descripcion'])?></textarea> 
				<label for="descripcion">Descripcion del servicio</label>
			</div>
		</div>
		
		<div class="col-md-12">
			<br>
		</div>
		<div class="d-grid gap-2 d-md-flex justify-content-md-end">
			<input type="submit" name="btnServicios" class="btn btn-light btn-lg" value="Eliminar">
			<input type="submit" name="btnServicios" class="btn btn-warning btn-lg" value="Modificar">
			<input type="submit" name="btnServicios" class="btn btn-secondary btn-lg" value="Insertar">
			<input type="submit" name="btnServicios" class="btn btn-primary btn-lg" value="Consultar">
		</div>
		
	</form>

	</div>
	
	
	<script type="text/javascript" src="js/validaForms.js"></script>

	<?php 
		include("footer.html")
	?>
</body>
</html>