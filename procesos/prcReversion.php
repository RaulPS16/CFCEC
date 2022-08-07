<?php
    include_once("../dat/datTransacciones.php");
    include_once("../dat/datContabilidad.php");

    $datTransaccion = new datTransacciones();
    $datConta = new datContabilidad();

    $datosReversar = array('id_usuario' => $_GET['id_usuario'], 
    'fecha_trx' => $_GET['fecha_trx'],
    'num_documento' => $_GET['num_documento'],
    'modulo' => $_GET['traReversion']);

    $datTransaccion->eliminar($datosReversar);
    $datConta->eliminar($datosReversar);
    header("Location: ../traReversion.php?error=2");
?>