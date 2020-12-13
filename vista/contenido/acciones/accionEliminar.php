<?php
include_once("../../estructura/cabecera.php");
// simplemente enviamos los datos necesarios del formulario para eliminar el archivo
    $datos = data_submitted();
    $obj = new Archivo();
    $respuesta= $obj->eliminararchivo($datos);    
    header("Location:../formularios/contenido.php?archivos=eliminados");

include_once("../../estructura/pie.php");
?>
