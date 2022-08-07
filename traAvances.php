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

    
	<title>Avances</title>
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

		<h2 class="text-center titulos">Avances de efectivo</h2>
		
		<form action="procesos/prcAvances.php" method="POST" class="needs-validation row" novalidate>
		<div class="col-sm-12">
			<div class="has-validation form-floating">
				<input type="text" name="fecha_trx" class="form-control visually-hidden" id="fecha_trx" placeholder="2000-01-01" value="<?php print($fechaActual);?>"   required >
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-floating">
				<input type="number" name="num_documento" class="form-control" id="num_documento" placeholder="12345678">
				<label for="num_documento">Numero de documento</label>
			</div>
		</div>
		
		<div class="col-md-8">
			<div class="has-validation form-floating">
				<input type="number" name="id_tarjeta" class="form-control" id="id_tarjeta" placeholder="23534656"  required>
				<label for="id_tarjeta">Numero de tarjeta</label>
				<div class="invalid-feedback">
        			Ingrese una tarjeta
      			</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="has-validation form-floating">
				<input type="text" name="monto" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$1,000,000.00" class="form-control form-meney-control">
				<label for="montoTrx">Monto de la transacción</label>
				<div class="invalid-feedback">
        			Ingrese un monto
      			</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-floating">
				<input type="number" name="id_cliente" class="form-control" id="id_cliente" placeholder="23534656"  required>
				<label for="id_cliente">Identificación del cliente</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-floating">
				<textarea name="detalle_trx" class="form-control" id="detalle_trx" placeholder="Deposito por pago" maxlength="50"></textarea>
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
	
	<script type="text/javascript" src="js/validaForms.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/jQueryMoney.js"></script>
    
	<?php 
		include("footer.html")
	?>
</body>
</html>