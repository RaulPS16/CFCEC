<?php
	// Aca se valida si la sesión está abierta
	session_start();
	include_once("datMonedas.php");
	include_once("loginControl.php");
	include_once("menu.php");
	include_once("muestraErrores.php");
	include_once("utilitarios.php");
	
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
    
	<title>Mantenimiento de Cuentas</title>
</head>
<body>

	<?php
		
		//include_once("muestraMonedas.php");
		$menu = new menu($_SESSION['sId_rol']);
		$util = new utilitarios();
		
		$retornoDatos = array("id_cuenta" => "", "id_cliente" => "", "id_moneda" => "");
		$fechaActual = date("Y-m-d");
		//&& $_GET['error'] <> 0
		if (isset($_GET['error']) ) {
			$muestraErrores = new muestraErrores($_GET['error']);
		}

		if (isset($_GET['datosSQL'])) {
			$retornoDatos = unserialize($_GET['datosSQL']);
		}

		$datMonedas = new datMonedas();
		$modulo = array("modulo" => "ManCuentas");
		$listaMonedas = $datMonedas->consultaLista($modulo);
		
	
	?>
	<div class="container mant">

		<h2 class="text-center titulos">Mantenimiento de Cuentas</h2>
		
		<form action="prcCuentas.php" method="POST" class="needs-validation row" novalidate>
		<div class="col-md-12">
			<div class="has-validation form-floating">
				<input type="number" name="id_cuenta_original" class="visually-hidden" id="id_cuenta_original" value="<?php echo($retornoDatos['id_cuenta']); ?>">
				<input type="number" name="id_cuenta" class="form-control" id="id_cuenta" placeholder="3468568435"  value="<?php echo($retornoDatos['id_cuenta']); ?>" >
				<label for="id_cuenta">Numero de cuenta</label>
				<div class="invalid-feedback">
        			Ingrese un numero de cuenta
      			</div>
			</div>
		</div>
			<div class="col-md-6">
				<div class="has-validation form-floating">
					<input type="number" name="id_cliente" class="form-control" id="id_cliente" placeholder="102340567" value="<?php echo($retornoDatos['id_cliente']); ?>" >
					<label for="id_cliente">Identificación del cliente</label>
					<div class="invalid-feedback">
	        			Ingrese una indentificación
	      			</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="has-validation form-floating">
					<select class="form-select" name="moneda" id="moneda" >
						<?php
							if ($retornoDatos['id_moneda'] == '') {
								foreach ($listaMonedas as  $fila) {
									print_r ("<option value='" . $fila['id_moneda'] . "'>" . $fila['nombre_moneda'] . "</option>");
								}
							}else{
								$monedaRetorno = $datMonedas->consultar($retornoDatos['id_moneda']); // consulta la descripión de la moneda de la cuenta
								$monedasDif = $datMonedas->consultaListaDif($retornoDatos['id_moneda']); // consulta las moendas diferentes de la moneda de la cuenta
								echo "<option value='" . $retornoDatos['id_moneda'] . "'>" . $monedaRetorno['nombre_moneda'] . "</option>";
								foreach ($monedasDif as  $fila) {
									print_r ("<option value='" . $fila['id_moneda'] . "'>" . $fila['nombre_moneda'] . "</option>");
								}
							}

					?>
					</select>
					<label for="moneda">Moneda</label>
					<div class="invalid-feedback">
	        			Ingrese una moneda
	      			</div>
				</div>
			</div>
			
		<div class="col-md-12">
			<br>
		</div>
		<div class="d-grid gap-2 d-md-flex justify-content-md-end">
			<input type="submit" name="btnCuentas" class="btn btn-secondary btn-lg" value="Insertar">
			<input type="submit" name="btnCuentas" class="btn btn-primary btn-lg" value="Consultar">
		</div>
		
	</form>

	</div>
	<script type="text/javascript" src="js/validaForms.js"></script>

	<?php 
		include("footer.html")
	?>
</body>
</html>