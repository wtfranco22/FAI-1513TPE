<?php
include_once("../../estructura/cabecera.php");

    $datos = data_submitted();
    $obj = new Archivo();
    $respuesta= $obj->compartirarchivo($datos);
    header("Location:../formularios/contenido.php?archivos=compartidos");

include_once("../../estructura/pie.php");
?>
