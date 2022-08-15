

<?php

	/*include_once("ConexionDB.php");;

	$db = new ConexionDB();

	$consultaSQL = 'SELECT * FROM clientes';
	$ConsultaID = $db->Consultar($consultaSQL);

	$fila = mysqli_fetch_array($ConsultaID,MYSQLI_ASSOC);

	print_r($fila);*/
	echo "<br><br>";

	/**
	 * 
	 */
	/*class pruebaErrores
	{
		//var $arrayName = array('descripcion_error' => '','error_num' => '', 'mudulo' => '', 'funcion' => '', 'script_sql' => '', '' => '');
		
		function __construct()
		{
			// code...
		}

		public function insertaValores()
		{
			//$this->arrayName = array('descripcion_error' => 'errordescripcion larga','error_num' => 1, 'mudulo' => 'pruebaErrores', 'funcion' => 'insetarValores', 'script_sql' => 'SELECT * FROM clientes', 'datos_pantalla' => '');
			//print_r($this->arrayName) ;
			$error = 3;
			return($error);
		}
	}*/

	//$prueba = new pruebaErrores();
	//print_r ($prueba->insertaValores());

	/*echo "<br><br>";
	include_once("datClientes.php");
	$valores = array('id_cliente' => '123', 'nombre' => 'Juan', 'apellidos' => 'Perez Acuna', 'fecha_nacimiento' => '1995-05-05','tipo_cliente' => 'comun', 'direccion_fisica' => 'san jose', 'email' => 'juanperez@correo.com', 'modulo' => 'pruebas');
	$cliente = new datClientes();
	$cliente->insertar($valores);*/

	//echo date('Y-m-d',strtotime(date('Y-m-d')."+ 1500 days"));
	/*include_once("../dat/datcontabilidad.php");
	include_once("../dat/datParam_contable.php");
	$datParam_contable = new datParam_contable();
	$datContabilidad = new datcontabilidad();

	$datosPantalla = array("num_documento" => 12, 
	"fecha_trx" => date("Y-m-d H:i:s"), 
	"id_cuenta" => 1, 
	"monto" => "1098.00", 
	"detalle_trx" => "prueba manual conta", 
	"id_tarjeta" => "0",
	"id_servicio" => "1", 
	"id_usuario" => "604320137",
	"modulo" => "traDepositos",
	"cr_db" => "",
	"cuenta_contable" => "");

	$datosContables = $datParam_contable->consultarXServicio($datosPantalla);

	print_r($datosContables);
	echo "<br>";
	foreach ($datosContables as $key => $value) {
		$datosPantalla["cr_db"] = $value["cr_db"];
		$datosPantalla["cuenta_contable"] = $value["cuenta_contable"];
		$aplicaConta = $datContabilidad->insertar($datosPantalla);
	}*/

	//$aplicaConta = $datContabilidad->insertar($datosPantalla);
	include_once("../datMenu.php");
	class menu{

		private $datMenu;
		private $rol;

		function __construct($pRol){
			$this->datMenu = new datMenu();
			$this->rol = $pRol;
			$this->construyeMenu();
		}

		function construyeMenu(){
			?>
			
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="inicio.php"><span class="material-icons">home</span></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-12">
				<?php
				//Consulta los titulos del menu
				$titulos = $this->datMenu->consultarTitulos($this->rol);
				//Recorre los titulos si hay
				foreach ($titulos as $key => $value) {
					if ($value['url'] <> '') {
						?>
						<li class="nav-item"><a class="nav-link" href="<?php print_r($value['url']);?>"><?php print_r($value['titulo']);?></a></li>
					<?php
					}else{
						?>
				<li class="nav-item dropdown"><!--Ini mantenimientos-->
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<?php print_r($value['titulo']); ?>
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<?php
								$subTitulos = $this->datMenu->consultarSubTitulos($value['titulo']);
								foreach ($subTitulos as $col => $valor) {
									?>
										<li class="dropdown-item"><a href="<?php print_r($valor['url']);?>"><?php print_r($valor['sub_titulo']);?></a></li>
									<?php
								}
								?>
					</ul>
				</li> <!--Fin mantenimientos-->
						<?php
					}
					
				}
				?>
			</ul>
		</div>
	</div>
</nav>
			<?php

		}
	}

	$menu = new menu(1);

?>
