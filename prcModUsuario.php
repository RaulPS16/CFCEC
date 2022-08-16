<?php
    include_once("datUsuarios.php");

    $datUsuarios = new datUsuarios();
    

    if (isset($_GET['btnEstado'])) {
        $datosPantalla = array("id_usuario" => $_GET['id_usuario'],
        "estado" => $_GET['estado'],
        "modulo" => "conUsuarios");
        $datUsuarios->modificaEstado($datosPantalla);
    }elseif (isset($_GET['btnRol'])) {
        $datosRol = array("id_usuario" => $_GET['id_usuario'],
        "id_rol" => $_GET['id_rol'],
        "modulo" => "conUsuarios");
        $datosRol = serialize($datosRol);
        $datosRol = urlencode($datosRol);
        header("Location: manUsuario.php?datosRol=" . $datosRol);
    }elseif (isset($_GET['btnModRol'])) {
        $datosRol = array("id_usuario" => $_GET['id_usuario'],
        "id_rol" => $_GET['id_rol'],
        "modulo" => "conUsuarios");
        $datUsuarios->modificaRol($datosPantalla);
    }
?>