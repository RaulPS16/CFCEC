<?php
    include_once("datUsuarios.php");
    class loginControl{

        private $datUsuarios = NULL;

        //Clase __construct que resive tiempo de espera, usuario y clave
        function __construct($pTiempo=60, $pUsuario=Null, $pClave=Null){
            if ($pUsuario==Null && $pClave==Null) {
                // si $_SESSION['sUsiario'] contiene algo entonces está logeado
                if (!isset($_SESSION['sUsuario'])) {
                    //si $_COOKIE['cUsuario'] contiene algo entonces el login aun es vigente
                    if (isset($_COOKIE['cUsuario'])) {
                        //inicializa $_SESSION['sUsuaria']
                        $_SESSION['sUsuaria'] = $_COOKIE['cUsuario'];
                    }else{
                        //Devuelve error 16
                        header("Location: index.php?error=16");
                    }
                }
                // Valida $_SESSION['tiempoLogin'] tiene algo y valida que el timepo no sea mayot a los segundos de $pTiempo
                if (isset($_SESSION['sTiempoLogin']) &&
                (time() > $_SESSION['sTiempoLogin'] ) ) {
                    session_unset();
                    session_destroy();
                    header("Location: index.php?error=18");
                }
            }else{
                //si el usuario y clave es <> NULL llama al metodo verificaUsuario
                $this->datUsuarios = new datUsuarios();
                $this->verificaUsuario($pTiempo,$pUsuario,$pClave);
            }
        } // fin __construct

        private function verificaUsuario($pTiempo,$pUsuario,$pClave){
            $valores = array("id_usuario" => $pUsuario,
                            "clave" => $pClave);
            $resultLogin = $this->datUsuarios->consultar($valores);
            if ($resultLogin['contador'] > 0) {
                //encripta con hash MD5
                $idUsuario = md5($pUsuario);
                // Se crea la cookie cUsuario, se le pasa el tiempo + lo deficido en $pTiempo
                setcookie("cUsuario",$idUsuario,time()+$pTiempo);
                // Guarda el tiempo de login
                $_SESSION['sTiempoLogin'] = time() + $pTiempo;
                // instancia el rol, id_usuario y modifica fecha de ultimo ingreso en las variables sesiones
                $_SESSION['sId_rol'] = $resultLogin['id_rol'];
                $_SESSION['sUsuario'] = $resultLogin['id_usuario'];
                $actualizaFecha = $this->datUsuarios->actualizaFechaAcceso($valores);
                // ingresa al inicio del sitio
                header("Location: inicio.php");

            }else{
                // si la clave no es correcta entonces genera un error
                header("Location: index.php?error=17");
            }
        }//fin verificaUsuario

        private function restauraClave(){

        }// fin restauraClave

    }
    
?>