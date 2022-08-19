<?php

    include_once("datRoles.php");
    $datRoles = new datRoles();
    
    if (isset($_GET['btnModRol'])) {
        try {
            $datosRol = array("id_rol" => $_GET['id_rol'],
        "modulo" => "conRoles",
        "descripcion" => $_GET['descripcion']);
        $datosRol = serialize($datosRol);
        $datosRol = urlencode($datosRol);
        header("Location: manRoles.php?datosRol=". $datosRol);
        } catch (\Throwable $th) {
            header("Location: conRoles.php?error=18");
        }
        
    }elseif (isset($_GET['btnEstado'])) {
        try {
            $datosRol = array("id_rol" => $_GET['id_rol'],
            "modulo" => "conRoles",
            "estado" => $_GET['estado']);
            $datRoles->modificarEstado($datosRol);
            header("Location: conRoles.php?error=1");
        } catch (\Throwable $th) {
            header("Location: conRoles.php?error=18");
        }
        
    }elseif (isset($_POST['btnCrear'])) {
        try {
            $datosRol = array("modulo" => "conRoles",
            "descripcion" => $_POST['descripcion']);
            $datRoles->insertar($datosRol);
            header("Location: conRoles.php?error=0");
        } catch (\Throwable $th) {
            header("Location: conRoles.php?error=18");
        }
        
    }elseif (isset($_GET['btnModificar'])) {
        try {
            $datosRol = array("id_rol" => $_GET['id_rol'],
            "modulo" => "conRoles",
            "descripcion" => $_GET['descripcion']);
            $datRoles->modificarRol($datosRol);
            echo"a";
            header("Location: conRoles.php?error=1");
        } catch (\Throwable $th) {
            header("Location: conRoles.php?error=18");
        }
        
    }

?>