<?php
	// Aca se valida si la sesión está abierta
	session_start();
	include_once("loginControl.php");
	// No se pasan valores a la funcion loginControl ya que se asume que está logeado
	$login = new loginControl();
?>
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
	class datServicios 
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
				$sql = "INSERT INTO servicios VALUES (" . $pValores["id_servicio"] . " ,'" . $pValores["nombre_servicio"] . "','" . $pValores["descripcion"] . "');";
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
				$sql = "UPDATE servicios SET nombre_servicio = '" . $pValores["nombre_servicio"] . "', descripcion = '" . $pValores["descripcion"] . "' WHERE id_servicio = " . $pValores["id_servicio"] . ";";
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
				$sql = "DELETE FROM servicios WHERE id_servicio = " . $pValores["id_servicio"] . ";";
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
				$sql = "SELECT * FROM servicios WHERE id_servicio = " . $pValores["id_servicio"] . ";";
				$this->dbm->Consultar($sql);
				$cantidadFilas = mysqli_num_rows($this->dbm->Consultar($sql));
				if ($cantidadFilas == 0) {
					throw new Exception("Registro no existe");
				}
				return mysqli_fetch_array($this->dbm->consultaID,MYSQLI_ASSOC);
			} catch (Exception $e) {
				// Carga el vector para hacer el reporte del error
				$this->datosBitacora = array('descripcion_error' => $e->getMessage() ,'error_num' => 1, 'modulo' => $pValores["modulo"], 'funcion' => __METHOD__, 'script_sql' => $sql, 'datos_pantalla' => IMPLODE(", ",$pValores));
				$this->utilitario->remueve_caracteres_especiales($this->datosBitacora);
				$this->BitacoraErrores->insertar($this->utilitario->cadena);
				//genera la exepcion
				// se comenta para no generar una exepción en los procesos
				//throw new Exception("Error en metodo en consultarCliente" . $e->getMessage());
				
			}
		}// fin consultar
		

		/**
		* Consulta todos los registros en la tabla
		*/
		public function consultaLista()
		{
			try {
				$sql = "SELECT * FROM servicios;";
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
		}// fin consultaLista

		public function consultaListaOrder($pValores)
		{
			try {
				$sql = "SELECT *, IF(id_servicio = " . $pValores["id_servicio"] . ",1,3) AS 'orden' from servicios ORDER BY orden, id_servicio ASC;";
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
		}// fin consultaLista

	}

?>