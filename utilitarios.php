<?php
	/**
	 * 
	 */
	class utilitarios{
		
		var $cadena = '';
		
		function __construct()
		{
			// code...
		}


		public function remueve_caracteres_especiales($strComprobar)
		{
			$resultado = str_replace(array("'",";","ñ","Ñ"), '', $strComprobar);
			$this->cadena = $resultado;

		}

		public function remueve_signo_trx($strComprobar){
			$valoresRemover = array("$",",");
			$resultad = str_replace($valoresRemover,"",$strComprobar);
			return $resultad;
		}

	}


?>