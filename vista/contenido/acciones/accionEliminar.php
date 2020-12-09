<?php
include_once("../../estructura/cabecera.php");

    $datos = data_submitted();
    $obj = new Archivo();
    $respuesta= $obj->eliminararchivo($datos);    
    header("Location:../formularios/contenido.php?archivos=eliminados");

include_once("../../estructura/pie.php");
?>
