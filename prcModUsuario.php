<?php
    include_once("datUsuarios.php");
    include_once("datClientes.php");

    $datUsuarios = new datUsuarios();
    $datClientes = new datClientes();
    
    $_POST['btnCrear'] = 'crear';

    if (isset($_GET['btnEstado'])) {
        try {
            $datosPantalla = array("id_usuario" => $_GET['id_usuario'],
            "estado" => $_GET['estado'],
            "modulo" => "conUsuarios");
            $datUsuarios->modificaEstado($datosPantalla);
            header("Location: conUsuarios.php?error=1");
        } catch (Exception $th) {
            header("Location: conUsuarios.php?error=21");
        }
        
    }elseif (isset($_GET['btnRol'])) {
        try {
            $datosRol = array("id_usuario" => $_GET['id_usuario'],
            "id_rol" => $_GET['id_rol'],
            "descripcion" => $_GET['descripcion'],
            "modulo" => "conUsuarios");
            $datosRol = serialize($datosRol);
            $datosRol = urlencode($datosRol);
            header("Location: manUsuario.php?datosRol=" . $datosRol);
        } catch (\Throwable $th) {
            header("Location: conUsuarios.php?error=21");
        }
        
    }elseif (isset($_GET['btnModRol'])) {
        try {
            $datosRol = array("id_usuario" => $_GET['id_usuario'],
            "id_rol" => $_GET['id_rol'],
            "modulo" => "manUsuario");
            $datUsuarios->modificaRol($datosRol);
            header("Location: conUsuarios.php?error=1");
        } catch (Exception $th) {
            header("Location: conUsuarios.php?error=21");
        }
    }elseif (isset($_POST['btnCrear'])) {
        try {
            $datosUsuarios = array("id_usuario" => $_POST['id_usuario'],
            "clave" => "12345",
            "id_rol" => $_POST['id_rol'],
            "modulo" => "conUsuarios");
            $datosUsuarios = array("id_usuario" => "604320137",
            "clave" => "12345",
            "id_rol" => "1",
            "modulo" => "conUsuarios");
            $datosConsulta = array("id_cliente" => $_POST['id_usuario'],
            "modulo" => "conUsuarios");
            $datosConsulta = array("id_cliente" => "604320137",
            "modulo" => "conUsuarios");
            try {
                $datosSQL = $datClientes->consultar($datosConsulta);
                
            } catch (\Throwable $th) {
                header("Location: conUsuarios.php?error=20");
            }
            $datosSQL = null;
            $datosSQL = $datUsuarios->consultaUsuario($datosUsuarios);
            if (isset($datosSQL['id_usuario'])) {
                header("Location: conUsuarios.php?error=5");
            }else {
                $datUsuarios->insertar($datosUsuarios);
                header("Location: conUsuarios.php?error=0");
            }
        } catch (\Throwable $th) {
            header("Location: conUsuarios.php?error=21");
        }
    }else{
        header("Location: conUsuarios.php?error=21");
    }

?>