<?php

	try {
		
		/**
		 * 
		 * Se incluyen todos los dat necesarios para el menejo de las
		 * transacciones y las reglas de negocio
		 * 
		 */
		include_once("../dat/datTransacciones.php");
		include_once("../dat/datParam_contable.php");
		include_once("../dat/datcontabilidad.php");
		include_once("../dat/datServicios.php");
		include_once("../dat/datCuentas.php");
		include_once("../dat/datTarjetas.php");
		include_once("../dat/datClientes.php");
		include_once("../utilitarios.php");
		/**
		 * 
		 * Se instancian las clases de los dat
		 * 
		 */

		$datTransacciones = new datTransacciones();
		$datParam_contable = new datParam_contable();
		$datcontabilidad = new datcontabilidad();
		$datServicios = new datServicios();
		$datCuentas = new datCuentas();
		$datTarjetas = new datTarjetas();
		$datClientes = new datClientes();
		$utilitario = new utilitarios();

		/**
		 * 
		 * Se declara el array $datosPantalla el cual obtiene del 
		 * metodo $_POST todos los campos en pantalla definidos en 
		 * la transaccion
		 *
		 */
		$datosPantalla = array("num_documento" => $_POST['num_documento'], 
			"fecha_trx" => $_POST['fecha_trx'], 
			"id_cuenta" => $_POST['id_cuenta'], 
			"monto" => $_POST['monto'], 
			"detalle_trx" => $_POST['detalle_trx'], 
			"id_tarjeta" => "0",
			"id_servicio" => "1", 
			"id_usuario" => "604320137",
			"modulo" => "traDepositos");

		/*$datosPantalla = array("num_documento" => 2, 
			"fecha_trx" => "2022-07-30", 
			"id_cuenta" => 1, 
			"monto" => 1, 
			"detalle_trx" => "", 
			"id_servicio" => "1", 
			"id_usuario" => "",
			"modulo" => "traDepositos");*/
		print_r($datosPantalla);
		/**
		 *  Valida que los campos obligatorios no estén en blanco
		 */
		/*if ($datosPantalla['num_documento'] == '' ||
			$datosPantalla['fecha_trx'] == '' ||
			$datosPantalla['id_cuenta'] == '' ||
			$datosPantalla['monto'] == '') {
			header("Location: ../traDeposito.php?error=4");
		}*/

		/**
		 * Validaciones generales
		 */

		/**
		 * Valida que el servicio exista
		 */
			$validaDatos = $datServicios->Consultar($datosPantalla);
			if ($validaDatos == '') {
				header("Location: ../traDeposito.php?error=8");
			}
		/**
		 * Valida que la cuenta exista si viaja en datosPantalla
		 */
			try {
				$validaDatos = $datCuentas->consultar($datosPantalla);
				if ($validaDatos == '') {
					header("Location: ../traDeposito.php?error=9");
				}
			} catch (Exception $th) {
				header("Location: ../traDeposito.php?error=9");
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
					header("Location: ../traDeposito.php?error=10");
				}
			}catch (Exception $th) {
				// la idea es que si genera error es porque no encuentra el registro por lo que no se crea una excepción
				
			}
		/**
		 * Busca la contabilidad para la transacción
		 */
			try {
				$datosContables = $datParam_contable->consultarXServicio($datosPantalla);
			} catch (\Throwable $th) {
				//Si no existen parametros devuelve error
				header("Location: ../traDeposito.php?error=11");
			}
		/**
		 * Quita caracteres de $
		 */

			$datosPantalla["monto"] = $utilitario->remueve_signo_trx($datosPantalla["monto"]);
			echo "<br>";
			print_r($datosPantalla["monto"]);

		/**
		 * Realiza la transacción
		 */
			try {
				$transacción = $datTransacciones->insertar($datosPantalla);
			}catch (Exception $th) {
				//throw $th;
			}
		/**
		 * Realiza la contabilidad
		 */

	} catch (Exception $e) {
		header("Location: ../traDeposito.php?error=3");
	}

?>