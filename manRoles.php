<?php
	// Aca se valida si la sesión está abierta
	session_start();
	//include_once("loginControl.php");
	// No se pasan valores a la funcion loginControl ya que se asume que está logeado
	//$login = new loginControl();

	$retornoDatos = array("id_usuario" => "604320137", 
	"id_rol" => "",
	"descripcion" => "Administracion", 
	"modulo" => "",
	"id_usuario_mod" => "");

	if (isset($_GET['datosRol'])) {
		$retornoDatos = unserialize($_GET['datosRol']);
	}else{
		header("Location: conUsuarios.php");
	}
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
    
	<title>Modificación de roles</title>
</head>
<body>

	<?php
	include_once("menu.php");
	$menu = new menu($_SESSION['sId_rol']);
	include_once("muestraErrores.php");
    $retornoDatos = array("id_rol" => '',
    "modulo" => 'ManRoles',
    "descripcion" => '');
	
	$fechaActual = date("Y-m-d");
	//&& $_GET['error'] <> 0
	if (isset($_GET['error']) ) {
		$muestraErrores = new muestraErrores($_GET['error']);
	}
    if (isset($_GET['datosRol'])) {
        $retornoDatos = unserialize($_GET['datosRol']);
    }
	
	?>
	<div class="container mant">

		<h2 class="text-center titulos">Modificación a roles</h2>
		
		<form action="prcModRoles.php" method="GET" class="needs-validation row" novalidate>
		<div class="col-md-5">
			<div class="mb-3 row">
				<label for="id_rol" class="col-sm-5 col-form-label">Numero de rol: </label>
				<div class="col-sm-4">
					<input type="text" name="id_rol" class="form-control-plaintext" id="id_rol" value="<?php echo($retornoDatos['id_rol']) ?>" >
				</div>
				
			</div>
		</div>
		<div class="col-md-6">
			<div class="mb-3 row">
				<label for="descripcion_Actual" class="col-sm-4 col-form-label">Rol actual: </label>
				<div class="col-sm-5">
					<input type="text" name="descripcion_Actual" class="form-control-plaintext" id="descripcion_Actual" value="<?php echo($retornoDatos['descripcion']) ?>" >
				</div>
				
			</div>
		</div>
		<div class="col-md-10">
				<div class="has-validation form-floating">
                    <input type="text" name="descripcion" class="form-control" id="descripcion" maxlength="50" required>
					<label for="id_rol">Nueva descripción</label>
					<div class="invalid-feedback">
						Ingrese una descripción
					</div>
				</div>
			</div>
		
		<div class="col-md-12">
			<br>
		</div>
		<div class="d-grid gap-2 d-md-flex justify-content-md-end">
			<input type="submit" name="btnModificar" class="btn btn-warning btn-lg" value="Modificar">
		</div>
		
	</form>

	</div>
	
	
	<script type="text/javascript" src="js/validaForms.js"></script>

	<?php 
		include("footer.html")
	?>
</body>
</html>