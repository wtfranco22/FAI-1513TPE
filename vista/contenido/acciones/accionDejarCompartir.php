<?php
include_once("../../estructura/cabecera.php");

    $datos = data_submitted();
    $obj = new Archivo();
    $respuesta= $obj->eliminararchivocompartido($datos);    
    header("Location:../formularios/contenido.php?archivos=nocompartidos");

include_once("../../estructura/pie.php");
?>
