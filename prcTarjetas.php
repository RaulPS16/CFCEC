<?php

	try {
		
		include_once("datTarjetas.php");

		$datTarjetas = new datTarjetas();

		$datosPantalla = array("id_tarjeta" => $_POST['id_tarjeta'], "id_cuenta" => $_POST['id_cuenta'], "estado" => $_POST['estado'], "modulo" => "manTarjetas", "id_tarjeta_original" => $_POST['id_tarjeta_original']);

		//print_r($datosPantalla);
		switch ($_POST['btnTarjetas']) {
			case 'Consultar':
				if (!isset($datosPantalla['id_tarjeta'])) {
					header("Location: manTarjetas.php?error=4");
					break;
				}
				$datosSQL = $datTarjetas->Consultar($datosPantalla);
				$datosSQL = serialize($datosSQL);
				$datosSQL = urlencode($datosSQL);

				//print_r("1: " . $datosSQL) ;
				header("Location: manTarjetas.php?datosSQL=". $datosSQL);
				break;
			case 'Insertar':
				if (!isset($datosPantalla['id_cuenta']) ||
					!isset($datosPantalla['estado'])) {
					header("Location: manTarjetas.php?error=4");
					break;
				}
				// Inserta los datos
				$datosSQL = $datTarjetas->insertar($datosPantalla);
				header("Location: manTarjetas.php?error=0");
				break;
			case 'Eliminar':
				if ($datosPantalla['id_tarjeta'] <> ''){
					if($datosPantalla['id_cuenta'] == '' ||
						$datosPantalla['estado'] == ''){
						header("Location: manTarjetas.php?error=6");
						break;
					}
				}

				$datosSQL = $datTarjetas->eliminar($datosPantalla);
				header("Location: manTarjetas.php?error=2");

				break;
			case 'Modificar':
				if ($datosPantalla['id_tarjeta'] <> ''){
					if($datosPantalla['id_cuenta'] == '' ||
						$datosPantalla['estado'] == ''){
						header("Location: manTarjetas.php?error=6");
						break;
					}
				}
				// valida que el # tarjeta no cambie
				if ($datosPantalla['id_tarjeta_original'] <> $datosPantalla['id_tarjeta']) {
					header("Location: manTarjetas.php?error=7");
					break;
				}

				$datosSQL = $datTarjetas->modificar($datosPantalla);
				header("Location: manTarjetas.php?error=1");

				break;
			default:
				header("Location: manTarjetas.php?error=4");
				break;
		}

	} catch (Exception $e) {
		header("Location: manTarjetas.php?error=3");
	}

?>