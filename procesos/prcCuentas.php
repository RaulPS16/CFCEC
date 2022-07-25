<?php

	try {
		
		include_once("/../dat/datCuentas.php");

		$datCuentas = new datCuentas();

		$datosPantalla = array("id_cliente" => $_POST['id_cliente'], "id_cuenta" => $_POST['id_cuenta'], "moneda" => $_POST['moneda'], "modulo" => "manCuentas", "id_cuenta_original" => $_POST['id_cuenta_original']);

		//print_r($datosPantalla);
		switch ($_POST['btnCuentas']) {
			case 'Consultar':
				if (!isset($datosPantalla['id_cuenta'])) {
					header("Location: ../manCuentas.php?error=4");
					break;
				}
				$datosSQL = $datCuentas->Consultar($datosPantalla);
				$datosSQL = serialize($datosSQL);
				$datosSQL = urlencode($datosSQL);

				//print_r("1: " . $datosSQL) ;
				header("Location: ../manCuentas.php?datosSQL=". $datosSQL);
				break;
			case 'Insertar':
				if (!isset($datosPantalla['id_cuenta']) ||
					!isset($datosPantalla['id_cliente']) ||
					!isset($datosPantalla['moneda'])) {
					header("Location: ../manCuentas.php?error=4");
					break;
				}
				// Inserta los datos
				$datosSQL = $datCuentas->insertar($datosPantalla);
				header("Location: ../manCuentas.php?error=0");
				break;
			case 'Eliminar':
				header("Location: ../manCuentas.php?error=7");
				break;
			case 'Modificar':
				header("Location: ../manCuentas.php?error=7");
				break;
			default:
				header("Location: ../manCuentas.php?error=4");
				break;
		}

	} catch (Exception $e) {
		header("Location: ../manCuentas.php?error=3");
	}

?>