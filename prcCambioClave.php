<?php
    session_start();
    include_once("datUsuarios.php");

    try {
        $datUsuarios = new datUsuarios();
        if (!isset($_POST['clave_anterior']) || 
            !isset($_POST['clave_nueva_1']) ||
            !isset($_POST['clave_nueva_2'])) {
            header("Location: cambioClave.php?error=4");
            exit;
        }
        
        if ($_POST['clave_anterior'] == $_POST['clave_nueva_1'] ||
            $_POST['clave_anterior'] == $_POST['clave_nueva_2']) {
            header("Location: cambioClave.php?error=22");
            exit;
        }

        if ($_POST['clave_nueva_2'] <> $_POST['clave_nueva_1']) {
            header("Location: cambioClave.php?error=23");
            exit;
        }
        $datosSQL = array("id_usuario" => $_SESSION['sUsuario'],
        "clave" => $_POST['clave_nueva_1'],
        "modulo" => "cambioClave");
        $datUsuarios->modificaCalves($datosSQL);
        header("Location: cambioClave.php?error=24");

    } catch (\Throwable $th) {
        header("Location: cambioClave.php?error=21");
    }

?>