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

	}

?>