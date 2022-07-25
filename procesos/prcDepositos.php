<?php

	try {
		
		/**
		 * 
		 * Se incluyen todos los dat necesarios para el menejo de las
		 * transacciones y las reglas de negocio
		 * 
		 */
		include_once("/../dat/datTransacciones.php");
		include_once("/../dat/datParam_contable.php");
		include_once("/../dat/datcontabilidad.php");
		include_once("/../dat/datServicios.php");
		include_once("/../dat/datCuentas.php");
		include_once("/../dat/datTarjetas.php");
		include_once("/../dat/datClientes.php");

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
			"id_servicio" => "20", 
			"id_usuario" => "",
			"modulo" => "traDepositos");
		
		/**
		 *  Valida que los campos obligatorios no estén en blanco
		 */
		if ($datosPantalla['num_documento'] == '' ||
			$datosPantalla['fecha_trx'] == '' ||
			$datosPantalla['id_cuenta'] == '' ||
			$datosPantalla['monto'] == '') {
			header("Location: ../manClientes.php?error=4");
			
		}

		/**
		 * Validaciones generales
		 */

		/**
		 * Valida que el servicio exista
		 */
			$validaDatos = $datServicios->Consultar($datosPantalla);
		/**
		 * Valida que la cuenta exista si viaja en datosPantalla
		 */

		/**
		 * Valida si la tarjeta exita si viaja en datosPantalla
		 */

		/**
		 * Valida que el numero de documento no exista para el día
		 */

		/**
		 * Busca la contabilidad para la transacción
		 */

		/**
		 * Realiza la transacción
		 */

		/**
		 * Realiza la contabilidad
		 */

	} catch (Exception $e) {
		header("Location: ../manClientes.php?error=3");
	}

?>