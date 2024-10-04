<?php
    require_once("../../config/conexion.php");
    $conexion = new Conectar();
    session_destroy();
    header("Location:". $conexion->ruta()."/index.php");
    exit();
?>