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

    
	<title>Depositos</title>
</head>
<body>

	<?php
	include("menu.php");

		$fechaActual = date("Y-m-d H:i:s");
		include_once("procesos/muestraErrores.php");
		$retornoDatos = array("num_documento" => "", 
			"fecha_trx" => "", 
			"id_cuenta" => "", 
			"monto" => "", 
			"detalle_trx" => "");
		//&& $_GET['error'] <> 0
		if (isset($_GET['error']) ) {
			$muestraErrores = new muestraErrores($_GET['error']);
		}

		if (isset($_GET['datosSQL'])) {
			$retornoDatos = unserialize($_GET['datosSQL']);
		}

	?>
	<div class="container mant">

		<h2 class="text-center titulos">Depositos a cuentas</h2>
		
		<form action="procesos/prcTransacciones.php" method="POST" class="needs-validation row" novalidate>
		<div class="col-md-3">
			<div class="form-floating">
				<input type="number" name="num_documento" class="form-control" id="num_documento" placeholder="12345678">
				<label for="num_documento">Numero de documento</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="has-validation form-floating">
				<input type="text" name="fecha_trx" class="form-control" id="fecha_trx" placeholder="2000-01-01" value="<?php print($fechaActual);?>" aria-label="Disabled input example"  required disabled>
			</div>
		</div>
		<div class="col-md-6">
			<div class="has-validation form-floating">
				<input type="number" name="id_cuenta" class="form-control" id="id_cuenta" placeholder="Juan"  required>
				<label for="id_cuenta">Cuenta</label>
				<div class="invalid-feedback">
        			Ingrese una cuenta
      			</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="has-validation form-floating">
				<input type="text" name="monto" id="monto" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$1,000,000.00" class="form-control form-meney-control"required>
				<label for="monto">Monto de la transacción</label>
				<div class="invalid-feedback">
        			Ingrese un monto
      			</div>
			</div>
		</div>
		<div class="col-md-8"></div>
		<div class="col-md-12">
			<div class="form-floating">
				<textarea name="detalle_trx" class="form-control" id="detalle_trx" placeholder="Deposito por pago"></textarea>
				<label for="detalle_trx">Descripción del movimiento</label>
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