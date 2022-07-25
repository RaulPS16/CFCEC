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

    
	<title>Consulta contable</title>
</head>
<body>

	<?php
	include("menu.php");

		$fechaActual = date("Y-m-d");
		if (isset($_GET['error']) && $_GET['error'] <> 0) {
			echo "Se a producido un error";
		}

	?>
	<div class="container mant">

		<h2 class="text-center titulos">Consulta contable</h2>

		<form method="POST" action="#" class="row">

			<div class="col-md-6">
				<div class="has-validation form-floating">
					<input type="date" name="fechaContable" class="form-control" id="fechaContable" max=<?php print($fechaActual);?> required>
					<label for="fechaContable">Ingrese una fehca valida</label>
					<div class="invalid-feedback">
	        			Ingrese una fehca valida
	      			</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-floating">
					<input type="number" name="idUsuario" class="form-control" id="idUsuario" placeholder="12345678">
					<label for="idUsuario">Usuario</label>
				</div>
			</div>
			<div class="col-md-12">
				<br>
			</div>
			<div class="d-grid gap-2 d-md-flex justify-content-md-end">
				<input type="submit" name="btnClientes" class="btn btn-primary btn-lg" value="Consultar">
			</div>
			<div class="col-md-12">
				<br>
			</div>
		</form>
	
		<table class="table table-striped">
		  <thead  class="text-center">
		    <tr>
		      <th scope="col">Cuenta contable</th>
		      <th scope="col">CR / DB</th>
		      <th scope="col">Usuario</th>
		      <th scope="col">Fehca</th>
		      <th scope="col">Num Documento</th>
		      <th scope="col">Monto</th>
		    </tr>
		  </thead>
		  <tbody  class="text-center">
		    <tr>
		      <th scope="row">1574332</th>
		      <td>CR</td>
		      <td>102340567</td>
		      <td>2022-01-01</td>
		      <td>2950</td>
		      <td>28859.10</td>
		    </tr>
		    <tr>
		      <th scope="row">246993</th>
		      <td>DB</td>
		      <td>102340567</td>
		      <td>2022-01-01</td>
		      <td>2950</td>
		      <td>28859.10</td>
		    </tr>
		  </tbody>
		  <tfoot class="text-center">
		  	<td colspan="2" scope="row">CR: 28859.10</td>
		  	<td colspan="2" scope="row">DB: 28859.10</td>
		  	<td colspan="2" scope="row">Dif CR - DB: 0.00</td>
		  </tfoot>
		</table>

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