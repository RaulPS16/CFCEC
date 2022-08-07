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
    
	<title>Mantenimiento de clientes</title>
</head>
<body>

	<?php
	include("menu.php");
	include_once("muestraErrores.php");
	$retornoDatos = array("id_cliente" => "", 
		"nombre" => "", 
		"apellidos" => "", 
		"fecha_nacimiento" => "", 
		"tipo_cliente" => "", 
		"direccion_fisica" => "", 
		"email" => "", 
		"modulo" => "");
	$fechaActual = date("Y-m-d");
	//&& $_GET['error'] <> 0
	if (isset($_GET['error']) ) {
		$muestraErrores = new muestraErrores($_GET['error']);
	}

	if (isset($_GET['datosSQL'])) {
		$retornoDatos = unserialize($_GET['datosSQL']);
	}

	$fechaActual = date("Y-m-d");

	?>
	<div class="container mant">

		<h2 class="text-center titulos">Mantenimiento de clientes</h2>
		
		<form action="procesos/prcClientes.php" method="POST" class="needs-validation row" novalidate>
		<div class="col-md-12">
			<div class="has-validation form-floating">
				<input type="text" name="id_cliente" class="form-control" id="id_cliente" placeholder="102340567"value="<?php echo($retornoDatos['id_cliente']) ?>"  required>
				<label for="id_cliente">Identificación del cliente</label>
				<div class="invalid-feedback">
        			Ingrese una idenficación correcta
      			</div>
			</div>
		</div>
		<div class="input-group">
			<div class="col-md-6">
				<div class="form-floating">
					<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Juan" value="<?php echo($retornoDatos['nombre']) ?>"  >
					<label for="nombre">Nombre del cliente</label>
				</div>
			</div>
			<div class="col-md-6">
				<div class=" form-floating">
					<input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Juan" value="<?php echo($retornoDatos['apellidos']) ?>" >
					<label for="apellidos">Apellidos del cliente</label>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-4">
			<div class=" form-floating">
				<input type="date" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento" value="<?php echo($retornoDatos['fecha_nacimiento']) ?>" max=<?php print($fechaActual);?>>
				<label for="fecha_nacimiento">Ingrese una fehca valida</label>
			</div>
		</div>

		<div class="col-md-4">
			<div class=" form-floating">
				<select class="form-select" name="tipo_cliente" id="tipo_cliente" >
					<option value="<?php echo($retornoDatos['tipo_cliente']) ?>"><?php echo($retornoDatos['tipo_cliente']) ?></option>
					<option value="Comun">Comun</option>
					<option value="Empleado">Empleado</option>
					<option value="Fraude">Fraude</option>
				</select>
				<label for="tipo_cliente">Tipo de cliente</label>
			</div>
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-12">
			<div class="form-floating">
				<textarea type="text" name="direccion_fisica" class="form-control" id="direccion_fisica" maxlength="100" rows="3"  ><?php echo($retornoDatos['direccion_fisica'])?></textarea> 
				<label for="direccion_fisica">Dirección de recidencia</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-floating">
				<input type="email" name="email" class="form-control" id="email" value="<?php echo($retornoDatos['email']) ?>">
				<label for="email">Correo electronico del cliente</label>
			</div>
		</div>
		<div class="col-md-12">
			<br>
		</div>
		<div class="d-grid gap-2 d-md-flex justify-content-md-end">
			<input type="submit" name="btnClientes" class="btn btn-light btn-lg" value="Eliminar">
			<input type="submit" name="btnClientes" class="btn btn-warning btn-lg" value="Modificar">
			<input type="submit" name="btnClientes" class="btn btn-secondary btn-lg" value="Insertar">
			<input type="submit" name="btnClientes" class="btn btn-primary btn-lg" value="Consultar">
		</div>
		
	</form>

	</div>

	<script type="text/javascript" src="js/validaForms.js"></script>

	<?php 
		include("footer.html")
	?>
</body>
</html>