<?php
	// Aca se valida si la sesión está abierta
	session_start();
	include_once("loginControl.php");
	include_once("menu.php");
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

	<title>Inicio</title>
</head>
<body>
	<?php 
		$menu = new menu($_SESSION['sId_rol']);
	?>
	<div class="container">
		<br>
		<h2 class="text-center">Bienvenido <?php print_r($_SESSION['sNombre']);?></h2>
		<br>

		

	</div>
	<br><br><br>
	<script type="text/javascript" src="js/validaForms.js"></script>
	<?php include("footer.html");	?>
</body>

</html>