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
	include_once("paginacion.php");
	
	// Valida si en la URL está en la fecha_contable para mostrar la tablas
	$mostrartabla = FALSE;
	if (!empty($_GET["fecha_contable"])) {
		$valores = array(
			"fecha_contable" => $_GET["fecha_contable"],
	 		"id_usuario" => $_GET["id_usuario"],
			"totalCR" => $_GET["totalCR"],
			"totalDB" => $_GET["totalDB"]);

		$paginas = new paginacion(3, $valores);
		$mostrartabla = TRUE;
	}
	

	$fechaActual = date("Y-m-d");
	if (isset($_GET['error']) && $_GET['error'] <> 0) {
		echo "Se a producido un error";
	}
	/*$totalCR = 0;
	$totalDB = 0;
	$difConta = 0;*/
	?>
	<div class="container">

		<h2 class="text-center titulos">Consulta contable</h2>

		<form method="GET" action="#" class="row">

			<div class="col-md-6">
				<div class="has-validation form-floating">
					<input type="date" name="fecha_contable" class="form-control" id="fecha_contable" max=<?php print($fechaActual);?> value="<?php print_r($_GET['fecha_contable']); ?>" >
					<label for="fecha_contable">Ingrese una fehca valida</label>
					<div class="invalid-feedback">
	        			Ingrese una fehca valida
	      			</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-floating">
					<input type="number" name="id_usuario" class="form-control" id="id_usuario" placeholder="12345678">
					<label for="id_usuario">Usuario</label>
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
			<div>
				<input type="hidden" name="totalCR">
				<input type="hidden" name="totalDB">
			</div>
		</form>
		<?php if ($mostrartabla) { ?>
		
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
			<nav aria-label="Page navigation example">
                <?Php
					$paginas->mostrar();
                ?>
				</nav>
            </tbody>

        </table>
		<?php
		if (empty($_GET["totalCR"])) {
			$paginas->mostrarPaginas();
		}
		
		} // if $mostrartabla
		?>
	</div>
	
	<?php


	?>
	<script type="text/javascript" src="js/validaForms.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/jQueryMoney.js"></script>
    
	<?php 
		include("footer.html")
	?>
</body>
</html>