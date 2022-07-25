<?php

	/**
	 * 
	 */
	class muestraErrores
	{
		
		function __construct($error)
		{
			switch ($error) {
				case '0':
					?>
						<div class="alert alert-success" role="alert">
						  Datos insertados con exito
						</div>
					<?php
					break;
				case '1':
					?>
						<div class="alert alert-success" role="alert">
						  Datos modificados con exito
						</div>
					<?php
					break;
				case '2':
					?>
						<div class="alert alert-success" role="alert">
						  Datos eliminados con exito
						</div>
					<?php
					break;
				case '3':
					?>
						<div class="alert alert-warning" role="alert">
						  Registro no existe
						</div>
					<?php
					break;
				case '4':
					?>
						<div class="alert alert-warning" role="alert">
						  Datos incompletos
						</div>
					<?php
					break;
				case '5':
					?>
						<div class="alert alert-warning" role="alert">
						  Registro ya existe
						</div>
					<?php
					break;
				case '6':
					?>
						<div class="alert alert-warning" role="alert">
						  Antes de eliminar o modificar se debe consultar el registro existente
						</div>
					<?php
					break;
				case '7':
					?>
						<div class="alert alert-warning" role="alert">
						  Registro no puede ser modificado
						</div>
					<?php
					break;
				default:
					?>
						<div class="alert alert-warning" role="alert">
						  Error en los datos
						</div>
					<?php
					break;
			}
		}
	}

?>