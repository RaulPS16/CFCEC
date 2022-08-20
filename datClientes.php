<?php
	// se incluyen los archivos utilizados dentro de la programación
	include_once("ConexionDB.php");
	include_once("datBitacoraErrores.php");
	include_once("utilitarios.php");

	/**
	 * 
	 * __METHOD__ es un valor reservado de PHP que trae la clase::metodo en el cual se está trabajando
	 * IMPLODE es un metodo reservado de PHP el cual convierte un array en string
	 * MYSQLI_ASSOC despliega los encabezados del array y no como posiciones del vector
	 * 
	 */
	class datClientes 
	{
		// Se instancian las variables globales para el uso dentro de los metodos
		var $dbm = null;
		var $BitacoraErrores = null;
		var $utilitario = null;
		//Se define el vector para el control de errores
		var $datosBitacora = array('descripcion_error' => '','error_num' => '', 'modulo' => '', 'funcion' => '', 'script_sql' => '', '' => '');
		//metodo constructor inicializa las variables de DB, bitacoraErrores y utilitarios llamanda a sus clases correspondientes
		function __construct()
		{
			try {
				$this->dbm = new ConexionDB();
				$this->BitacoraErrores = new datBitacoraErrores();
				$this->utilitario = new utilitarios();
			} catch (Exception $e) {
				throw new Exception("Error en conexión" . $e->getMessage());
				
			}
			
		}//fin __construct

		/**
		* Inserta un registro en la tabla el cual los valores son pasados por parametros
		*/
		public function insertar($pValores)
		{
			try {
				$sql = "INSERT INTO clientes VALUES (" . $pValores["id_cliente"] . ",'" . $pValores["nombre"] . "','" . $pValores["apellidos"] . "','" . $pValores["fecha_nacimiento"] . "','" . $pValores["tipo_cliente"] . "','" . $pValores["direccion_fisica"] . "','" . $pValores["email"] . "');";
				$this->dbm->ejecutar($sql);
			} catch (Exception $e) {
				// Carga el vector para hacer el reporte del error
				$this->datosBitacora = array('descripcion_error' => $e->getMessage() ,'error_num' => 1, 'modulo' => $pValores["modulo"], 'funcion' => __METHOD__, 'script_sql' => $sql, 'datos_pantalla' => IMPLODE(", ",$pValores));
				$this->utilitario->remueve_caracteres_especiales($this->datosBitacora);
				$this->BitacoraErrores->insertar($this->utilitario->cadena);
				//genera la exepcion
				throw new Exception("Error en metodo en insertar" . $e->getMessage());

			}
		}// fin insertar()

		/**
		* modifica un registro en la tabla el cual los valores son pasados por parametros
		*/
		public function modificar($pValores)
		{
			try {
				$sql = "UPDATE clientes SET nombre = '" . $pValores["nombre"] . "', apellidos = '" . $pValores["apellidos"] . "', fecha_nacimiento = '" . $pValores["fecha_nacimiento"] . "', tipo_cliente = '" . $pValores["tipo_cliente"] . "', direccion_fisica = '" . $pValores["direccion_fisica"] . "', email = '" . $pValores["email"] . "' WHERE id_cliente = " . $pValores["id_cliente"] . ";";
				$this->dbm->ejecutar($sql);
			} catch (Exception $e) {
				// Carga el vector para hacer el reporte del error
				$this->datosBitacora = array('descripcion_error' => $e->getMessage() ,'error_num' => 1, 'modulo' => $pValores["modulo"], 'funcion' => __METHOD__, 'script_sql' => $sql, 'datos_pantalla' => IMPLODE(", ",$pValores));
				$this->utilitario->remueve_caracteres_especiales($this->datosBitacora);
				$this->BitacoraErrores->insertar($this->utilitario->cadena);
				//genera la exepcion
				throw new Exception("Error en metodo en modificar" . $e->getMessage());
				
			}
		}//fin modificar()

		/**
		* elimina un registro en la tabla el cual los valores son pasados por parametros
		*/
		public function eliminar($pValores)
		{
			try {
				$sql = "DELETE FROM clientes WHERE id_cliente = " . $pValores["id_cliente"] . ";";
				$this->dbm->ejecutar($sql);
			} catch (Exception $e) {
				// Carga el vector para hacer el reporte del error
				$this->datosBitacora = array('descripcion_error' => $e->getMessage() ,'error_num' => 1, 'modulo' => $pValores["modulo"], 'funcion' => __METHOD__, 'script_sql' => $sql, 'datos_pantalla' => IMPLODE(", ",$pValores));
				$this->utilitario->remueve_caracteres_especiales($this->datosBitacora);
				$this->BitacoraErrores->insertar($this->utilitario->cadena);
				//genera la exepcion
				throw new Exception("Error en metodo en eliminar" . $e->getMessage());
				
			}
		}//fin modificar

		/**
		* Consulta un registro en la tabla el cual los valores son pasados por parametros
		*/
		public function consultar($pValores)
		{
			try {
				$sql = "SELECT * FROM clientes WHERE id_cliente = " . $pValores["id_cliente"] . ";";
				$this->dbm->Consultar($sql);
				$cantidadFilas = mysqli_num_rows($this->dbm->Consultar($sql));
				if ($cantidadFilas == 0) {
					return $cantidadFilas;
				}
				return mysqli_fetch_array($this->dbm->consultaID,MYSQLI_ASSOC);
			} catch (Exception $e) {
				// Carga el vector para hacer el reporte del error
				$this->datosBitacora = array('descripcion_error' => $e->getMessage() ,'error_num' => 1, 'modulo' => $pValores["modulo"], 'funcion' => __METHOD__, 'script_sql' => $sql, 'datos_pantalla' => IMPLODE(", ",$pValores));
				$this->utilitario->remueve_caracteres_especiales($this->datosBitacora);
				$this->BitacoraErrores->insertar($this->utilitario->cadena);
				//genera la exepcion
				throw new Exception("Error en metodo en consultarCliente" . $e->getMessage());
				
			}
		}// fin consultar

		/**
		* Consulta todos los registros en la tabla
		*/
		public function consultaLista()
		{
			try {
				$sql = "SELECT * FROM clientes;";
				$this->dbm->Consultar($sql);
				return mysqli_fetch_all($this->dbm->consultaID,MYSQLI_ASSOC);
			} catch (Exception $e) {
				// Carga el vector para hacer el reporte del error
				$this->datosBitacora = array('descripcion_error' => $e->getMessage() ,'error_num' => 1, 'modulo' => $pValores["modulo"], 'funcion' => __METHOD__, 'script_sql' => $sql, 'datos_pantalla' => IMPLODE(", ",$pValores));
				$this->utilitario->remueve_caracteres_especiales($this->datosBitacora);
				$this->BitacoraErrores->insertar($this->utilitario->cadena);
				//genera la exepcion
				throw new Exception("Error en metodo en consultaLista" . $e->getMessage());
				
			}
		}

	}

?>