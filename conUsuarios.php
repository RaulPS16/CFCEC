<?php
	// Aca se valida si la sesión está abierta
	session_start();
	//include_once("loginControl.php");
	// No se pasan valores a la funcion loginControl ya que se asume que está logeado
	//$login = new loginControl();
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

    
	<title>Usuarios</title>
</head>
<body>

	<?php
	include_once("menu.php");
	$menu = new menu($_SESSION['sId_rol']);
	include_once("muestraErrores.php");
	include_once("paginacionUsuarios.php");
	include_once("datRoles.php");

	$fechaActual = date("Y-m-d");

	$paginas = new paginacionTransacciones(4);
	$roles = new datRoles();
	$listaRoles = $roles->consultaLista();

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
			      <th scope="col">Identificación</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Rol</th>
				  <th scope="col">Fecha ultima de ingreso</th>
				  <th scope="col">Estado</th>
				  <th scope="col">Cambiar rol</th>
				  <th scope="col">Inactivar</th>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Crear usuario</button>
		    </div>
		</form>
		
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="prcModUsuario.php" class="needs-validation" method="POST" novalidate>
                    <div class="has-validation form-floating mb-3">
                        <input type="number" maxlength="50" class="form-control" id="id_usuario" name="id_usuario" placeholder="102340567" required value="604320137">
						<label for="id_usuario" class="form-label">Identificación</label>
						<div class="invalid-feedback">
							Ingrese un usuario
						</div>
                    </div>
					<div class="col-md-10">
					<div class="has-validation form-floating mb-3">
						<select class="form-select" name="id_rol" id="id_rol" required>
							<?php
								foreach ($listaRoles as  $fila) {
									print_r ("<option value='" . $fila['id_rol'] . "'>" . $fila['descripcion'] . "</option>");
								}
							?>
							
						</select>
						<label for="id_rol">Rol nuevo</label>
						<div class="invalid-feedback">
							Ingrese un rol
						</div>
					</div>
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