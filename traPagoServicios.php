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

    
	<title>Pago de servicios</title>
</head>
<body>

	<?php
	include("menu.php");

		$fechaActual = date("Y-m-d");
		if (isset($_GET['error']) && $_GET['error'] <> 0) {
			echo "Se a producido un error";
		}

	include_once("datServicios.php");
	$datServicios = new datServicios();
	$listaServicios = $datServicios->consultaLista();
	?>
	<div class="container mant">

		<h2 class="text-center titulos">Pago de servicios</h2>
		
		<form action="#" method="POST" class="needs-validation row" novalidate>
		<div class="col-md-3">
			<div class="form-floating">
				<input type="number" name="numDocumento" class="form-control" id="numDocumento" placeholder="12345678">
				<label for="numDocumento">Numero de documento</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="has-validation form-floating">
				<select class="form-select" name="idServicio" id="idServicio" required>
					<?php
						foreach ($listaServicios as  $fila) {
							print_r ("<option value='" . $fila['id_servicio'] . "'>" . $fila['nombre_servicio'] . "</option>");
							
						}
					?>
					
				</select>
				<label for="idServicio">Servicio a pagar</label>
				<div class="invalid-feedback">
        			Ingrese un servicio
      			</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="has-validation form-floating">
				<input type="text" name="fechaActual" class="form-control" id="fechaActual" placeholder="2000-01-01" value="<?php print($fechaActual);?>" aria-label="Disabled input example"  required disabled>
			</div>
		</div>
		<div class="col-md-6">
			<div class="has-validation form-floating">
				<input type="number" name="idCuentaTarjeta" class="form-control" id="idCuentaTarjeta" placeholder="23534656"  required>
				<label for="idCuentaTarjeta">Cuenta o tarjeta</label>
				<div class="invalid-feedback">
        			Ingrese una cuenta o tarjeta
      			</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<br>
		</div>
		<div class="d-grid gap-2 d-md-flex justify-content-md-end">
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/jQueryMoney.js"></script>
    
	<?php 
		include("footer.html")
	?>
</body>
</html>