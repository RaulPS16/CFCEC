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
	class datContabilidad 
	{
		// Se instancian las variables globales para el uso dentro de los metodos
		var $dbm = null;
		var $BitacoraErrores = null;
		var $utilitario = null;
		public $error;
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

				$sql = "INSERT INTO contabilidad VALUES (NULL,'" . $pValores["cuenta_contable"] . "','" . $pValores["monto"] . "'," . $pValores["num_documento"] . ",'" . $pValores["cr_db"] . "','" . $pValores["id_usuario"] . "','" . $pValores["id_servicio"] . "', '" . $pValores["fecha_contable"] . "');";

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
		* no aplica modificar contabilidad, si se cometio un error se debe reversar, es decir eliminar el registro y volverlo a hacer
		*/


		/**
		* elimina un registro en la tabla el cual los valores son pasados por parametros
		*/
		public function eliminar($pValores)
		{
			try {
				$sql = "DELETE FROM contabilidad WHERE num_documento = " . $pValores["num_documento"] . " AND fecha like '" . $pValores["fecha_contable"] . "%';";
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
				$sql = "SELECT * FROM contabilidad WHERE num_documento = " . $pValores["num_documento"] . " AND fecha_contable like '" . $pValores["fecha_contable"] . "%';";
				$this->dbm->Consultar($sql);
				return mysqli_fetch_array($this->dbm->consultaID,MYSQLI_ASSOC);
			} catch (Exception $e) {
				// Carga el vector para hacer el reporte del error
				$this->datosBitacora = array('descripcion_error' => $e->getMessage() ,'error_num' => 1, 'modulo' => $pValores["modulo"], 'funcion' => __METHOD__, 'script_sql' => $sql, 'datos_pantalla' => IMPLODE(", ",$pValores));
				$this->utilitario->remueve_caracteres_especiales($this->datosBitacora);
				$this->BitacoraErrores->insertar($this->utilitario->cadena);
				//genera la exepcion
				throw new Exception("Error en metodo en consultar" . $e->getMessage());
				
			}
		}// fin consultar

		/**
		* Consulta todos los registros en la tabla
		*/
		public function consultaLista($pValores)
		{
			try {
				$sql = "SELECT * FROM contabilidad;";
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

		/**
		* Consulta un registro en la tabla por fecha
		*/
		public function consultarFecha($pValores)
		{
			try {
				$sql = "SELECT * FROM contabilidad WHERE fecha_contable = '" . $pValores["fecha_contable"] . "';";
				$this->dbm->Consultar($sql);
				return mysqli_fetch_array($this->dbm->consultaID,MYSQLI_ASSOC);
			} catch (Exception $e) {
				// Carga el vector para hacer el reporte del error
				$this->datosBitacora = array('descripcion_error' => $e->getMessage() ,'error_num' => 1, 'modulo' => $pValores["modulo"], 'funcion' => __METHOD__, 'script_sql' => $sql, 'datos_pantalla' => IMPLODE(", ",$pValores));
				$this->utilitario->remueve_caracteres_especiales($this->datosBitacora);
				$this->BitacoraErrores->insertar($this->utilitario->cadena);
				//genera la exepcion
				throw new Exception("Error en metodo en consultarCliente" . $e->getMessage());
				
			}
		}// fin consultarFecha

		/**
		* Consulta un registro en la tabla por fecha y usuario
		*/
		public function consultarFechaUsuario($pValores, $pIndice = 0, $pResultadoPorPagina = 2)
		{
			try {
				$sql = "SELECT * FROM contabilidad WHERE fecha_contable LIKE '%" . $pValores["fecha_contable"] . "%'";				
				if ($pValores["id_usuario"] <> '') {
					$sql = $sql . " AND id_usuario = " . $pValores["id_usuario"] . "";
				}
				$sql = $sql . " ORDER BY fecha_contable DESC LIMIT " . $pIndice . ", " . $pResultadoPorPagina . "";
				$this->dbm->Consultar($sql);
				//return $sql;
				return mysqli_fetch_all($this->dbm->consultaID,MYSQLI_ASSOC);
			} catch (Exception $e) {
				//$this->error = $e->getMessage();
				$this->error = "NO hay datos";
				return $this->error;
				
			}
		}// fin consultarFechaUsuario

		/**
		* Consulta un registro en la tabla por fecha y usuario
		*/
		public function consultarContador($pValores)
		{
			try {
				$sql = "SELECT COUNT(*) AS total FROM contabilidad WHERE fecha_contable LIKE '%" . $pValores["fecha_contable"] . "%'";				
				if ($pValores["id_usuario"] <> '') {
					$sql = $sql . " AND id_usuario = " . $pValores["id_usuario"] . "";
				}
				$this->dbm->Consultar($sql);
				return mysqli_fetch_all($this->dbm->consultaID,MYSQLI_ASSOC);
			} catch (Exception $e) {
				$error = "NO hay datos";
				return $error;
				
			}
		}// fin consultarContador

	}

?>