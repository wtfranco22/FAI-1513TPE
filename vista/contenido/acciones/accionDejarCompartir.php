<?php
include_once("../../estructura/cabecera.php");
/*
 * enviamos los datos del formulario para dejar de compartir los archivos
 */
    $datos = data_submitted();
    $obj = new Archivo();
    $respuesta= $obj->eliminararchivocompartido($datos);    
    header("Location:../formularios/contenido.php?archivos=nocompartidos");

include_once("../../estructura/pie.php");
?>
