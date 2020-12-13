<?php
include_once("../../estructura/cabecera.php");
// solo enviamos datos a compartir archivo 
    $datos = data_submitted();
    $obj = new Archivo();
    $respuesta= $obj->compartirarchivo($datos);
    header("Location:../formularios/contenido.php?archivos=compartidos");

include_once("../../estructura/pie.php");
?>
