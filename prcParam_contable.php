<?php

	try {
		
		include_once("datParam_contable.php");

		$datParamConta = new datParam_contable();

		$datosPantalla = array("cuenta_contable" => $_POST['cuenta_contable'],
        "id_servicio" => $_POST['id_servicio'], 
        "estado" => $_POST['estado'], 
        "cr_db" => $_POST['cr_db'],
        "descripcion" => $_POST['descripcion'],
        "id" => $_POST['id'],
        "modulo" => "manParamContable");

		//print_r($datosPantalla);
		switch ($_POST['btnParamContable']) {
			case 'Consultar':
				if (!isset($datosPantalla['cuenta_contable']) &&
                    !isset($datosPantalla['id_servicio'])) {
					header("Location: manParamContable.php?error=4");
					break;
				}
				$datosSQL = $datParamConta->Consultar($datosPantalla);
				$datosSQL = serialize($datosSQL);
				$datosSQL = urlencode($datosSQL);

                //echo "<br>";
				//print_r( $datosSQL) ;
				header("Location: manParamContable.php?datosSQL=". $datosSQL);
				break;
			case 'Insertar':
				if (!isset($datosPantalla['cuenta_contable']) ||
					!isset($datosPantalla['id_servicio']) ||
					!isset($datosPantalla['estado']) || 
                    !isset($datosPantalla['cr_db'])) {
					header("Location: manParamContable.php?error=4");
					break;
				}
				// Inserta los datos
				$datosSQL = $datParamConta->insertar($datosPantalla);
				header("Location: manParamContable.php?error=0");
				break;
			case 'Eliminar':
                if ($datosPantalla['cuenta_contable'] <> ''){
					if($datosPantalla['id_servicio'] == '' ||
					$datosPantalla['estado'] == '' ||
					$datosPantalla['cr_db'] == '' ){
						header("Location: manParamContable.php?error=6");
						break;
					}
				}

				$datosSQL = $datParamConta->eliminar($datosPantalla);
				header("Location: manParamContable.php?error=2");
				
				break;
			case 'Modificar':
                if ($datosPantalla['cuenta_contable'] <> ''){
					if($datosPantalla['id_servicio'] == '' ||
					$datosPantalla['estado'] == '' ||
					$datosPantalla['cr_db'] == '' ){
						header("Location: manParamContable.php?error=6");
						break;
					}
				}
				$datosSQL = $datParamConta->modificar($datosPantalla);
				header("Location: manParamContable.php?error=1");
				break;
			default:
				header("Location: manParamContable.php?error=4");
				break;
		}

	} catch (Exception $e) {
		header("Location: manParamContable.php?error=3");
	}

?>