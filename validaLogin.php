<?php
    session_start();
    include_once("loginControl.php");
    $login = new loginControl(60,$_POST['usuario'],$_POST['clave']);
?>