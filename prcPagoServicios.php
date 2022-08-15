<?php
	// Aca se valida si la sesión está abierta
	session_start();
	include_once("loginControl.php");
	// No se pasan valores a la funcion loginControl ya que se asume que está logeado
	$login = new loginControl();
?>
<?php

	try {
		
		/**
		 * 
		 * Se incluyen todos los dat necesarios para el menejo de las
		 * transacciones y las reglas de negocio
		 * 
		 */
		include_once("datTransacciones.php");
		include_once("datParam_contable.php");
		include_once("datcontabilidad.php");
		include_once("datServicios.php");
		include_once("datCuentas.php");
		include_once("datTarjetas.php");
		include_once("datClientes.php");
		include_once("utilitarios.php");
		/**
		 * 
		 * Se instancian las clases de los dat
		 * 
		 */

		$datTransacciones = new datTransacciones();
		$datParam_contable = new datParam_contable();
		$datContabilidad = new datcontabilidad();
		$datServicios = new datServicios();
		$datCuentas = new datCuentas();
		$datTarjetas = new datTarjetas();
		$datClientes = new datClientes();
		$utilitario = new utilitarios();
		$errorInterno = 0;
		/**
		 * 
		 * Se declara el array $datosPantalla el cual obtiene del 
		 * metodo $_POST todos los campos en pantalla definidos en 
		 * la transaccion
		 *
		 */
		$datosPantalla = array("num_documento" => $_POST['num_documento'], 
			"fecha_trx" => date("Y-m-d H:i:s"), 
			"id_cuenta" => "0", 
			"monto" => $_POST['monto'], 
			"detalle_trx" => "Pago de servicio ", 
			"id_tarjeta" => $_POST['id_tarjeta'],
			"id_servicio" => $_POST['id_servicio'], 
			"id_usuario" => "604320137",
			"modulo" => "traPagoServicios",
			"cr_db" => "",
			"cuenta_contable" => "");
		//print_r($datosPantalla);
		
		/**
		 *  Valida que los campos obligatorios no estén en blanco
		 */
		if ($datosPantalla['num_documento'] == '' ||
			$datosPantalla['id_tarjeta'] == '' ||
			$datosPantalla['monto'] == '') {
			header("Location: traPagoServicios.php?error=4");
		}

		/**
		 * Valida que el servicio exista
		 */
			$validaDatos = $datServicios->Consultar($datosPantalla);
			if ($validaDatos == '') {
				header("Location: traPagoServicios.php?error=8");
			}
		/**
		 * Valida que la tarjeta exista si viaja en datosPantalla
		 */
        try {
            $validaDatos = $datTarjetas->consultar($datosPantalla);
            if ($validaDatos == '') {
                header("Location: traAvances.php?error=15");
            }
        } catch (Exception $th) {
            header("Location: traAvances.php?error=15");
        }

		/**
		 * Valida si la tarjeta exita si viaja en datosPantalla
		 */

		/**
		 * Valida que el numero de documento no exista para el día
		 */
			try {
				$validaDatos = $datTransacciones->consultarNumDoc($datosPantalla);
				if ($validaDatos <> '') {
					header("Location: traPagoServicios.php?error=10");
				}
			}catch (Exception $th) {
				// la idea es que si genera error es porque no encuentra el registro por lo que no se crea una excepción
				
			}
		/**
		 * Busca la contabilidad para la transacción
		 */
			try {
				$datosContables = $datParam_contable->consultarXServicio($datosPantalla);
				if (empty($datosContables)) {
					header("Location: traPagoServicios.php?error=11");
				}
			} catch (Exception $e) {
				//Si no existen parametros devuelve error
				header("Location: traPagoServicios.php?error=11");
			}
		/**
		 * Quita caracteres de $
		 */

			$datosPantalla["monto"] = $utilitario->remueve_signo_trx($datosPantalla["monto"]);

		/**
		 * Realiza la transacción
		 */
			try {
				$transacción = $datTransacciones->insertar($datosPantalla);
			}catch (Exception $th) {
				$errorInterno = 1;
			}
		/**
		 * Realiza la contabilidad
		 */
			try {
				if ($errorInterno == 0) {
					/**
					 * Lee la tabla generada en $datosContables
					 * Por cada registro crea un registro contable, esto se hace para generar un asiento completo
					 */
					foreach ($datosContables as $key => $value) {
						$datosPantalla["cr_db"] = $value["cr_db"];
						$datosPantalla["cuenta_contable"] = $value["cuenta_contable"];
						$aplicaConta = $datContabilidad->insertar($datosPantalla);
					}
				}
				header("Location: traPagoServicios.php?error=13");

			} catch (Exception $th) {
				header("Location: traPagoServicios.php?error=12");
			}

	} catch (Exception $e) {
		header("Location: traPagoServicios.php?error=3");
	}

?>