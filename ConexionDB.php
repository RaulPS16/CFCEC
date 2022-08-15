<?php
	// Aca se valida si la sesión está abierta
	session_start();
	include_once("loginControl.php");
	// No se pasan valores a la funcion loginControl ya que se asume que está logeado
	$login = new loginControl();
?>
<?php

	/**
	 * 
	 */
	class ConexionDB{
		
		var $host 		= "";
		var $db 		= "";
		var $user 		= "";
		var $pass 		= "";
		var $conexionID = 0;
		var $ejecutaID 	= 0;
		var $consultaID = 0;

		function __construct(){
			try {
				
				$this->host 	= "localhost";
				$this->db 		= "elcorraldb";
				$this->user 	= "root";
				$this->pass 	= "";
				$this->Conectar();

			} catch (Exception $e) {
				throw new Exception("Error en establecer parametros " . $e->getMessage());
			}
		}//fin __construct()

		function Conectar (){

			try {
				if (!empty($this->host) && !empty($this->db)){
					$this->conexionID = mysqli_connect($this->host,$this->user,$this->pass,$this->db);
					if (mysqli_connect_errno() != 0) {
						throw new Exception("Error al establecer conexión");
					}
				}else{
					throw new Exception("Algos datos viajan en blanco");
				}
			} catch (Exception $e) {
				throw new Exception("Error en conectar " . $e->getMessage());
			}
		} //fin Conectar()

		function Ejecutar($pDml=""){
			try {
				if (empty($pDml)) {
					throw new Exception("Script SQL no destá definido");
				}else{
					$this->ejecutaID = mysqli_query($this->conexionID,$pDml);

					if (mysqli_errno($this->conexionID) != 0) {
						throw new Exception("Error al ejecutar el Script: " . mysqli_errno($this->conexionID) . " - " . mysqli_error($this->conexionID));
						return 0;
					}
					return $this->ejecutaID;
				}
			} catch (Exception $e) {
				throw new Exception("Error en ejecutar " . $e->getMessage());
			}
		}//Fin Ejecutar()

		function Consultar($pSql=""){
			try {
				if (empty($pSql)) {
					throw new Exception("Script SQL de consulta no destá definido");
				}else{
					$this->consultaID = mysqli_query($this->conexionID,$pSql);

					if (mysqli_errno($this->conexionID) != 0) {
						throw new Exception("Error al ejecutare el Script de consulta: " . mysqli_errno($this->conexionID) . " - " . mysqli_error($this->conexionID));
						return 0;
					}
					return $this->consultaID;
				}
			} catch (Exception $e) {
				throw new Exception("Error en consultar " . $e->getMessage());
			}
		}

	}

?>