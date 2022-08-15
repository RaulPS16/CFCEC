<?php
    // Aca se valida si la sesión está abierta
    session_start();
    include_once("loginControl.php");
    // No se pasan valores a la funcion loginControl ya que se asume que está logeado
    $login = new loginControl();
    //Destruye la sesión
    session_destroy();
    //Coloca la variable cUsuario expirada hace una hota
    setcookie("cUsuario","",time()-4600);
    // vuelve al index
    header("Location: index.php");
?>