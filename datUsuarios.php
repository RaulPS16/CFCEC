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
	class datUsuarios
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
				$sql = "INSERT INTO usuarios VALUES (" . $pValores["id_usuario"] . ",'" . $pValores["clave"] . "'," . $pValores["id_rol"] . ", CURRENT_TIMESTAMP, 1);";
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
		*  funcion para modificar la clave
		*/
		public function modificaCalves($pValores)
		{
			try {
				$sql = "UPDATE usuarios SET clave = '" . $pValores['clave'] . "' WHERE id_usuario = " . $pValores["id_usuario"] . ";";
				$this->dbm->ejecutar($sql);
			} catch (Exception $e) {
				// Carga el vector para hacer el reporte del error
				$this->datosBitacora = array('descripcion_error' => $e->getMessage() ,'error_num' => 1, 'modulo' => $pValores["modulo"], 'funcion' => __METHOD__, 'script_sql' => $sql, 'datos_pantalla' => IMPLODE(", ",$pValores));
				$this->utilitario->remueve_caracteres_especiales($this->datosBitacora);
				$this->BitacoraErrores->insertar($this->utilitario->cadena);
				//genera la exepcion
				throw new Exception("Error en metodo en modificar" . $e->getMessage());
				
			}
		}//fin modificaCalves()

        /**
		* modifica el rol de un usuario
		*/
		public function modificaRol($pValores)
		{
			try {
				$sql = "UPDATE usuarios SET id_rol = '" . $pValores["id_rol"] . "' WHERE id_usuario = " . $pValores["id_usuario"] . ";";
				$this->dbm->ejecutar($sql);
			} catch (Exception $e) {
				// Carga el vector para hacer el reporte del error
				$this->datosBitacora = array('descripcion_error' => $e->getMessage() ,'error_num' => 1, 'modulo' => $pValores["modulo"], 'funcion' => __METHOD__, 'script_sql' => $sql, 'datos_pantalla' => IMPLODE(", ",$pValores));
				$this->utilitario->remueve_caracteres_especiales($this->datosBitacora);
				$this->BitacoraErrores->insertar($this->utilitario->cadena);
				//genera la exepcion
				throw new Exception("Error en metodo en modificar" . $e->getMessage());
				
			}
		}//fin modificaRol()

		public function modificaEstado($pValores)
		{
			try {
				$sql = "UPDATE usuarios SET estado = '" . $pValores["estado"] . "' WHERE id_usuario = " . $pValores["id_usuario"] . ";";
				$this->dbm->ejecutar($sql);
			} catch (Exception $e) {
				// Carga el vector para hacer el reporte del error
				$this->datosBitacora = array('descripcion_error' => $e->getMessage() ,'error_num' => 1, 'modulo' => $pValores["modulo"], 'funcion' => __METHOD__, 'script_sql' => $sql, 'datos_pantalla' => IMPLODE(", ",$pValores));
				$this->utilitario->remueve_caracteres_especiales($this->datosBitacora);
				$this->BitacoraErrores->insertar($this->utilitario->cadena);
				//genera la exepcion
				throw new Exception("Error en metodo en modificar" . $e->getMessage());
				
			}
		}//fin modificaRol()
        
        public function actualizaFechaAcceso($pValores)
		{
			try {
				$sql = "UPDATE usuarios SET fecha_ulti_ingreso = CURRENT_TIMESTAMP WHERE id_usuario = " . $pValores["id_usuario"] . ";";
				$this->dbm->ejecutar($sql);
			} catch (Exception $e) {
				// Carga el vector para hacer el reporte del error
				$this->datosBitacora = array('descripcion_error' => $e->getMessage() ,'error_num' => 1, 'modulo' => $pValores["modulo"], 'funcion' => __METHOD__, 'script_sql' => $sql, 'datos_pantalla' => IMPLODE(", ",$pValores));
				$this->utilitario->remueve_caracteres_especiales($this->datosBitacora);
				$this->BitacoraErrores->insertar($this->utilitario->cadena);
				//genera la exepcion
				throw new Exception("Error en metodo en modificar" . $e->getMessage());
				
			}
		}//fin modificaRol()

		/**
		* elimina un registro en la tabla el cual los valores son pasados por parametros
		*/
		public function eliminar($pValores)
		{
			try {
				$sql = "DELETE FROM usuarios WHERE id_usuario = " . $pValores["id_usuario"] . ";";
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
				$sql = "SELECT id_usuario, id_rol, COUNT(*) AS contador FROM usuarios WHERE id_usuario = " . $pValores["id_usuario"] . " AND clave = " . $pValores["clave"] . ";";
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
		}// fin consultar

		/**
		* Consulta todos los registros en la tabla
		*/
		public function consultaLista($pIndice = 0, $pResultadoPorPagina)
		{
			try {
				$sql = "SELECT usuarios.id_usuario, concat(clientes.nombre, ' ', clientes.apellidos) AS 'nombre', usuarios.id_rol, roles.descripcion, usuarios.fecha_ulti_ingreso, usuarios.estado
				FROM `usuarios`  
				INNER JOIN roles
				INNER JOIN clientes
				on usuarios.id_rol = roles.id_rol
				and usuarios.id_usuario = clientes.id_cliente
				ORDER BY usuarios.estado
				LIMIT " . $pIndice . ", " . $pResultadoPorPagina . ";";
				$this->dbm->Consultar($sql);
				return mysqli_fetch_all($this->dbm->consultaID,MYSQLI_ASSOC);
			} catch (Exception $e) {
				return 0;
				
			}
		}

		public function consultarContador()
		{
			try {
				$sql = "SELECT count(*) AS total FROM usuarios;";
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
		}// fin consultar

		public function consultaUsuario($pValores)
		{
			try {
				$sql = "SELECT * FROM usuarios WHERE id_usuario = ". $pValores['id_usuario'] . ";";
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
		}// fin consultar

	}

?>