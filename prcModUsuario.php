<?php
    include_once("datUsuarios.php");

    $datUsuarios = new datUsuarios();
    

    if ($_GET['btnEstado'] <> '') {
        try {
            $datosPantalla = array("id_usuario" => $_GET['id_usuario'],
            "estado" => $_GET['estado'],
            "modulo" => "conUsuarios");
            $datUsuarios->modificaEstado($datosPantalla);
            header("Location: conUsuarios.php?error=1");
        } catch (Exception $th) {
            header("Location: conUsuarios.php?error=18");
        }
        
    }elseif ($_GET['btnRol'] <> '') {
        $datosRol = array("id_usuario" => $_GET['id_usuario'],
        "id_rol" => $_GET['id_rol'],
        "descripcion" => $_GET['descripcion'],
        "modulo" => "conUsuarios");
        $datosRol = serialize($datosRol);
        $datosRol = urlencode($datosRol);
        header("Location: manUsuario.php?datosRol=" . $datosRol);
    }elseif ($_GET['btnModRol'] <> '') {
        try {
            $datosRol = array("id_usuario" => $_GET['id_usuario'],
            "id_rol" => $_GET['id_rol'],
            "modulo" => "manUsuario");
            $datUsuarios->modificaRol($datosRol);
            header("Location: conUsuarios.php?error=1");
        } catch (Exception $th) {
            header("Location: conUsuarios.php?error=18");
        }
    }else{
        header("Location: conUsuarios.php?error=18");
    }

?>