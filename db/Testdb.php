<?php

	/*include_once("ConexionDB.php");

	$db = new ConexionDB();

	$consultaSQL = 'SELECT * FROM clientes';
	$ConsultaID = $db->Consultar($consultaSQL);

	$fila = mysqli_fetch_array($ConsultaID,MYSQLI_ASSOC);

	print_r($fila);*/
	echo "<br><br>";

	/**
	 * 
	 */
	class pruebaErrores
	{
		//var $arrayName = array('descripcion_error' => '','error_num' => '', 'mudulo' => '', 'funcion' => '', 'script_sql' => '', '' => '');
		
		function __construct()
		{
			// code...
		}

		public function insertaValores()
		{
			//$this->arrayName = array('descripcion_error' => 'errordescripcion larga','error_num' => 1, 'mudulo' => 'pruebaErrores', 'funcion' => 'insetarValores', 'script_sql' => 'SELECT * FROM clientes', 'datos_pantalla' => '');
			//print_r($this->arrayName) ;
			$error = 3;
			return($error);
		}
	}

	//$prueba = new pruebaErrores();
	//print_r ($prueba->insertaValores());

	/*echo "<br><br>";
	include_once("datClientes.php");
	$valores = array('id_cliente' => '123', 'nombre' => 'Juan', 'apellidos' => 'Perez Acuna', 'fecha_nacimiento' => '1995-05-05','tipo_cliente' => 'comun', 'direccion_fisica' => 'san jose', 'email' => 'juanperez@correo.com', 'modulo' => 'pruebas');
	$cliente = new datClientes();
	$cliente->insertar($valores);*/

	//echo date('Y-m-d',strtotime(date('Y-m-d')."+ 1500 days"));
	include_once("../dat/datcontabilidad.php");
	include_once("../dat/datParam_contable.php");
	$datParam_contable = new datParam_contable();
	$datContabilidad = new datcontabilidad();

	$datosPantalla = array("num_documento" => 12, 
	"fecha_trx" => date("Y-m-d H:i:s"), 
	"id_cuenta" => 1, 
	"monto" => "1098.00", 
	"detalle_trx" => "prueba manual conta", 
	"id_tarjeta" => "0",
	"id_servicio" => "1", 
	"id_usuario" => "604320137",
	"modulo" => "traDepositos",
	"cr_db" => "",
	"cuenta_contable" => "");

	$datosContables = $datParam_contable->consultarXServicio($datosPantalla);

	print_r($datosContables);
	echo "<br>";
	foreach ($datosContables as $key => $value) {
		$datosPantalla["cr_db"] = $value["cr_db"];
		$datosPantalla["cuenta_contable"] = $value["cuenta_contable"];
		$aplicaConta = $datContabilidad->insertar($datosPantalla);
	}

	//$aplicaConta = $datContabilidad->insertar($datosPantalla);
	

?>