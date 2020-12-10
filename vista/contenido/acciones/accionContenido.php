<?php
include_once("../../estructura/cabecera.php");
//Se encuentra en esta accion para poder crear una carpeta para nuevos archivos

$datos = data_submitted();
$obj = new Archivo();
$obj->crearCarpeta($datos);
header("Location:../formularios/contenido.php?archivos=cargados");

include_once("../../estructura/pie.php");
?>