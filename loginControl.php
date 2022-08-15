<?php
	// Aca se valida si la sesión está abierta
	session_start();
	include_once("loginControl.php");
	// No se pasan valores a la funcion loginControl ya que se asume que está logeado
	$login = new loginControl();
?>
<?php
    class loginControl{
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
                if (isset($_SESSION['tiempoLogin']) &&
                (time() > $_SESSION['tiempoLogin'] ) ) {
                    session_unset();
                    session_destroy();
                    header("Location: index.php?error=18");
                }
            }else{
                //si el usuario y clave es <> NULL llama al metodo verificaUsuario
                $this->verificaUsuario($pTiempo,$pUsuario,$pClave);
            }
        } // fin __construct

        private function verificaUsuario($pTiempo,$pUsuario,$pClave){
            if ($pUsuario == "1" && $pClave == "1234") {
                //encripta con hash MD5
                $idUsuario = md5($pUsuario);
                // Se crea la cookie cUsuario, se le pasa el tiempo + lo deficido en $pTiempo
                setcookie("cUsuario",$idUsuario,time()+$pTiempo);
                //Se cuarda el $idUsuario en la variable de session para sUsuario
                $_SESSION['sUsuario'] = $idUsuario;
                $_SESSION['tiempoLogin'] = time() + $pTiempo;
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