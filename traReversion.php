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

    
	<title>Reversiones</title>
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

		<h2 class="text-center titulos">Reversión de movimientos</h2>

		<form method="POST">

			<table class="table table-striped">
			  <thead  class="text-center">
			    <tr>
			      <th scope="col">Documento</th>
			      <th scope="col">CR / DB</th>
			      <th scope="col">Usuario</th>
			      <th scope="col">Reversar</th>
			    </tr>
			  </thead>
			  <tbody  class="text-center">
			    <tr>
			      <th scope="row">1</th>
			      <td>CR</td>
			      <td>102340567</td>
			      <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Reversar</button></td>
			      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Confirmar reversión</h5>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body">
					        ¿Quiere hacer la resersión?
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					        <input type="submit" name="btnReversar" class="btn btn-link" value="Reversar">
					      </div>
					    </div>
					  </div>
					</div>
			    </tr>
			  </tbody>
			</table>

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