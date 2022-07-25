<?php

	include_once("/../db/ConexionDB.php");

	/**
	 * 
	 */
	class datBitacoraErrores 
	{
		var $dbm = null;
		
		function __construct()
		{
			try {
				$this->dbm = new ConexionDB();
			} catch (Exception $e) {
				throw new Exception("Error en conexión" . $e->getMessage());
				
			}
			
		}//fin __construct

		public function insertar($pValores)
		{
			try {
				
				$sql = "INSERT INTO bitacora_errores VALUES (null, '" . $pValores["descripcion_error"] . "'," . $pValores["error_num"] . ", CURRENT_TIMESTAMP, '" . $pValores["modulo"] . "', '" . $pValores["funcion"] . "', '" . $pValores["script_sql"] . "', '" . $pValores["datos_pantalla"] . "')";
				
				$this->dbm->ejecutar($sql);
			} catch (Exception $e) {
				throw new Exception("Error en metodo en insertar: " . $e->getMessage());
				
			}
		}// fin insertar()

		/*
		*
		*No se crea la funcion de modificar ya que no por ser una bitacora
		* de errores esta debe mantenerse integra
		*
		*/

		public function eliminar($pValores)
		{
			try {
				$sql = "DELETE FROM bitacora_errores WHERE id = " . $pValores["id"] . ";";
				$this->dbm->ejecutar($sql);
			} catch (Exception $e) {
				throw new Exception("Error en metodo en eliminar" . $e->getMessage());
				
			}
		}//fin modificar

		public function consultar($pValores)
		{
			try {
				$sql = "SELECT * FROM bitacora_errores WHERE id = " . $pValores["id"] . ";";
				$this->dbm->Consultar($sql);
				return mysqli_fetch_array($this->dbm->consultaID,MYSQLI_ASSOC);
			} catch (Exception $e) {
				throw new Exception("Error en metodo en consultarCliente" . $e->getMessage());
				
			}
		}// fin consultar

		public function consultaLista()
		{
			try {
				$sql = "SELECT * FROM bitacora_errores;";
				$this->dbm->Consultar($sql);
				return mysqli_fetch_all($this->dbm->consultaID,MYSQLI_ASSOC);
			} catch (Exception $e) {
				throw new Exception("Error en metodo en consultaLista" . $e->getMessage());
				
			}
		}

		

	}

?>