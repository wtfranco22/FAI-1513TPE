<?php
include_once("../../estructura/cabecera.php");
/*
 * enviamos los datos a buscarArchivo compartido y si esta compartido lo mostramos
 */
$datos = data_submitted();
$buscArchivo = new AbmArchivoCargado();
$archivo = $buscArchivo->habilitadoCompartir($datos);
if ($archivo[0] != null) {
    header("Location:../compartidos/" . $archivo[0]->getAcNombre());
} else {
    echo '<script>alert("No se encontro el archivo");window.location.href="contenido.php"</script>';
}

include_once("../../estructura/pie.php");
