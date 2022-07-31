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
				case '8':
					?>
						<div class="alert alert-warning" role="alert">
							Servicio no habilitado por el momento
						</div>
					<?php
					break;
				case '9':
					?>
						<div class="alert alert-warning" role="alert">
							Cuenta no existe
						</div>
					<?php
					break;
				case '10':
					?>
						<div class="alert alert-warning" role="alert">
							Transacción ya ingresada con anterioridad (numero de documento)
						</div>
					<?php
					break;
				case '11':
					?>
						<div class="alert alert-warning" role="alert">
							No existen parametros contrables para la transacción, contacte con servicios tecnicos o contabildiad.
						</div>
					<?php
					break;
				case '12':
					?>
						<div class="alert alert-warning" role="alert">
							Error con la transacción
						</div>
					<?php
					break;
				case '13':
					?>
						<div class="alert alert-success" role="alert">
						Transcción exitosa
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