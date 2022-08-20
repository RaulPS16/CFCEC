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

    
	<title>Roles</title>
</head>
<body>

	<?php
	include_once("menu.php");
	$menu = new menu($_SESSION['sId_rol']);
	include_once("muestraErrores.php");
	include_once("paginacionRoles.php");

	$fechaActual = date("Y-m-d");

	$paginas = new paginacionRoles(3);
	

	if (isset($_GET['error']) ) {
		$muestraErrores = new muestraErrores($_GET['error']);
	}

	if (isset($_GET['datosSQL'])) {
		$retornoDatos = unserialize($_GET['datosSQL']);
	}
	?>
	<div class="container">

		<h2 class="text-center titulos">Usuarios de sistema</h2>

		<form method="GET" action="prcModRolUsuario.php">

			<table class="table table-striped">
			  <thead  class="text-center">
			    <tr>
			      <th scope="col">Rol</th>
			      <th scope="col">Estado</th>
			      <th scope="col">Inactivar</th>
                  <th scope="col">Modificar</th>
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
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Crear rol</button>
		    </div>

		</form>
		
	</div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="prcModRoles.php" method="POST">
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion del rol</label>
                        <input type="text" maxlength="50" class="form-control" id="descripcion" name="descripcion" placeholder="Administracion">
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary" name="btnCrear" value="Aceptar">
            </div>
            </form>
            </div>
        </div>
    </div>

	<script type="text/javascript" src="js/validaForms.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/jQueryMoney.js"></script>
    
	<?php 
		include("footer.html")
	?>
</body>
</html>