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

    
	<title>Reversiones</title>
</head>
<body>

	<?php
	include("menu.php");
	include_once("muestraErrores.php");
	include_once("paginacionTransacciones.php");

	$fechaActual = date("Y-m-d");
	$valores = array(
		"fecha_trx" => $fechaActual,
		"id_usuario" => "604320137");

	$paginas = new paginacionTransacciones(2, $valores);
	

	if (isset($_GET['error']) ) {
		$muestraErrores = new muestraErrores($_GET['error']);
	}

	if (isset($_GET['datosSQL'])) {
		$retornoDatos = unserialize($_GET['datosSQL']);
	}
	?>
	<div class="container">

		<h2 class="text-center titulos">Reversión de movimientos</h2>

		<form method="POST">

			<table class="table table-striped">
			  <thead  class="text-center">
			    <tr>
			      <th scope="col">Fecha y hora</th>
			      <th scope="col">Num tarjeta</th>
			      <th scope="col">Num cuenta</th>
				  <th scope="col">Servicio</th>
				  <th scope="col">Documento</th>
				  <th scope="col">Detalle</th>
				  <th scope="col">monto</th>
			      <th scope="col">Reversar</th>
			    </tr>
			  </thead>
			  <tbody  class="text-center">
			  <nav aria-label="Page navigation example">
                <?Php
					$paginas->mostrar();
                ?>
				</nav>
			  </tbody>
			</table>
			<?Php
				$paginas->mostrarPaginas();
            ?>
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