<?php

    include_once("datRoles.php");
    $datRoles = new datRoles();

    if ($_GET['btnModRol'] <> '') {
        $datosRol = array("id_rol" => $_GET['id_rol'],
        "modulo" => "conRoles");
        $datosRol = serialize($datosRol);
        $datosRol = urlencode($datosRol);
        header("Location: manRoles.php?datosRol=". $datosRol);
    }elseif ($_GET['btnEstado'] <> '') {
        $datosRol = array("id_rol" => $_GET['id_rol'],
        "modulo" => "conRoles",
        "estado" => $_GET['estado']);
        $datRoles->modificarEstado($datosRol);
        header("Location: conRoles.php?error=1");
    }elseif ($_POST['btnCrear']) {
        $datosRol = array("id_rol" => $_GET['id_rol'],
        "modulo" => "conRoles",
        "descripcion" => $_GET['descipcion']);
        $datRoles->insertar($datosRol);
        header("Location: conRoles.php?error=0");
    }

?>