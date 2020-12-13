<?php
include_once("../../estructura/cabecera.php");

/*
 * este script decide que hacer con los datos del formulario, 
 * si la clave es 0 entonces es un archivo a cargar sino es un archivo a modificar
 */
    $datos = data_submitted();
    $obj = new Archivo();
    if($datos['clave']=='0'){
        $respuesta = $obj->alta($datos);
    }else{
        $respuesta = $obj->modificacion($datos);
    }
    header("Location:../formularios/contenido.php?archivos=cargados");

include_once("../../estructura/pie.php");
?>