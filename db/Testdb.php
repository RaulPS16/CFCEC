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

	$prueba = new pruebaErrores();
	print_r ($prueba->insertaValores());

	/*echo "<br><br>";
	include_once("datClientes.php");
	$valores = array('id_cliente' => '123', 'nombre' => 'Juan', 'apellidos' => 'Perez Acuna', 'fecha_nacimiento' => '1995-05-05','tipo_cliente' => 'comun', 'direccion_fisica' => 'san jose', 'email' => 'juanperez@correo.com', 'modulo' => 'pruebas');
	$cliente = new datClientes();
	$cliente->insertar($valores);*/

	//echo date('Y-m-d',strtotime(date('Y-m-d')."+ 1500 days"));

	

?>