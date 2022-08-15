<?php
	// Aca se valida si la sesión está abierta
	session_start();
	include_once("loginControl.php");
	// No se pasan valores a la funcion loginControl ya que se asume que está logeado
	$login = new loginControl();
?>
<?php
    include_once("datTransacciones.php");
    include_once("datContabilidad.php");

    $datTransaccion = new datTransacciones();
    $datConta = new datContabilidad();

    $datosReversar = array('id_usuario' => $_GET['id_usuario'], 
    'fecha_trx' => $_GET['fecha_trx'],
    'num_documento' => $_GET['num_documento'],
    'modulo' => $_GET['traReversion']);

    $datTransaccion->eliminar($datosReversar);
    $datConta->eliminar($datosReversar);
    header("Location: traReversion.php?error=2");
?>