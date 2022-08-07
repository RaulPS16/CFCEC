<?php

	try {
		
		include_once("datClientes.php");

		$datClientes = new datClientes();

		$datosPantalla = array("id_cliente" => $_POST['id_cliente'], 
			"nombre" => $_POST['nombre'], 
			"apellidos" => $_POST['apellidos'], 
			"fecha_nacimiento" => $_POST['fecha_nacimiento'], 
			"tipo_cliente" => $_POST['tipo_cliente'], 
			"direccion_fisica" => $_POST['direccion_fisica'], 
			"email" => $_POST['email'], 
			"modulo" => "manClientes");
		//print_r($datosPantalla);
		switch ($_POST['btnClientes']) {
			case 'Consultar':
				if (!isset($datosPantalla['id_cliente'])) {
					header("Location: manClientes.php?error=4");
					break;
				}
				$datosSQL = $datClientes->Consultar($datosPantalla);
				//si no devuelve datos muestra error
				if ($datosSQL == '') {
					header("Location: manClientes.php?error=3");
					break;
				}
				
				$datosSQL = serialize($datosSQL);
				$datosSQL = urlencode($datosSQL);
				header("Location: manClientes.php?datosSQL=". $datosSQL);
				break;
			case 'Insertar':
				if ($datosPantalla['id_cliente'] == '' ||
					$datosPantalla['nombre'] == '' ||
					$datosPantalla['fecha_nacimiento'] == '' ||
					$datosPantalla['tipo_cliente'] == '' ||
					$datosPantalla['apellidos'] == '' ||
					$datosPantalla['direccion_fisica'] == '') {
					header("Location: manClientes.php?error=4");
					break;
				}

				// Valida que el numero de registro no esté insertado
				$datosSQL = $datClientes->Consultar($datosPantalla);
				if ($datosSQL["id_cliente"] == $datosPantalla['id_cliente']) {
					header("Location: manClientes.php?error=5");
					break;
				}
				// Inserta los datos
				$datosSQL = $datClientes->insertar($datosPantalla);
				header("Location: manClientes.php?error=0");
				break;
			case 'Eliminar':
				if ($datosPantalla['id_cliente'] <> ''){
					if($datosPantalla['nombre'] == '' ||
					$datosPantalla['fecha_nacimiento'] == '' ||
					$datosPantalla['tipo_cliente'] == '' ||
					$datosPantalla['apellidos'] == '' ||
					$datosPantalla['direccion_fisica'] == ''){
						header("Location: manClientes.php?error=6");
						break;
					}
				}

				$datosSQL = $datClientes->eliminar($datosPantalla);
				header("Location: manClientes.php?error=2");

				break;
			case 'Modificar':
				if ($datosPantalla['id_cliente'] <> ''){
					if($datosPantalla['nombre'] == '' ||
					$datosPantalla['fecha_nacimiento'] == '' ||
					$datosPantalla['tipo_cliente'] == '' ||
					$datosPantalla['apellidos'] == '' ||
					$datosPantalla['direccion_fisica'] == ''){
						header("Location: manClientes.php?error=6");
						break;
					}
				}

				$datosSQL = $datClientes->modificar($datosPantalla);
				header("Location: manClientes.php?error=1");

				break;
			default:
				header("Location: manClientes.php?error=4");
				break;
		}

	} catch (Exception $e) {
		header("Location: manClientes.php?error=3");
	}

?>