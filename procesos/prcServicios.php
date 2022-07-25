<?php

	try {
		
		include_once("/../dat/datServicios.php");

		$datServicios = new datServicios();

		$datosPantalla = array("id_servicio" => $_POST['id_servicio'], "nombre_servicio" => $_POST['nombre_servicio'], "descripcion" => $_POST['descripcion'], "modulo" => "manServicios");
		//print_r($datosPantalla);
		switch ($_POST['btnServicios']) {
			case 'Consultar':
				if (!isset($datosPantalla['id_servicio'])) {
					header("Location: ../manServicios.php?error=4");
					break;
				}
				$datosSQL = $datServicios->Consultar($datosPantalla);
				$datosSQL = serialize($datosSQL);
				$datosSQL = urlencode($datosSQL);

				//print_r("1: " . $datosSQL) ;
				header("Location: ../manServicios.php?datosSQL=". $datosSQL);
				break;
			case 'Insertar':
				if (!isset($datosPantalla['id_servicio']) ||
					!isset($datosPantalla['nombre_servicio']) ||
					!isset($datosPantalla['descripcion'])) {
					header("Location: ../manServicios.php?error=4");
					break;
				}

				// Valida que el numero de registro no esté insertado
				$datosSQL = $datServicios->Consultar($datosPantalla);
				if ($datosSQL["id_servicio"] == $datosPantalla['id_servicio']) {
					header("Location: ../manServicios.php?error=5");
					break;
				}
				// Inserta los datos
				$datosSQL = $datServicios->insertar($datosPantalla);
				header("Location: ../manServicios.php?error=0");
				break;
			case 'Eliminar':
				if ($datosPantalla['id_servicio'] <> ''){
					if($datosPantalla['nombre_servicio'] == '' ||
						$datosPantalla['descripcion'] == ''){
						header("Location: ../manServicios.php?error=6");
						break;
					}
				}

				$datosSQL = $datServicios->eliminar($datosPantalla);
				header("Location: ../manServicios.php?error=2");

				break;
			case 'Modificar':
				if ($datosPantalla['id_servicio'] <> ''){
					if($datosPantalla['nombre_servicio'] == '' ||
						$datosPantalla['descripcion'] == ''){
						header("Location: ../manServicios.php?error=6");
						break;
					}
				}

				$datosSQL = $datServicios->modificar($datosPantalla);
				header("Location: ../manServicios.php?error=1");

				break;
			default:
				header("Location: ../manServicios.php?error=4");
				break;
		}

	} catch (Exception $e) {
		header("Location: ../manServicios.php?error=3");
	}

?>