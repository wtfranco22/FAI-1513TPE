<?php
include_once("../../estructura/cabecera.php");

$datos = data_submitted();
$buscArchivo = new AbmArchivoCargado();
$archivo = $buscArchivo->buscarArchivo($datos);
if ($archivo[0] != null) {
    header("Location:../compartidos/".$archivo[0]->getAcNombre());
} else {
    echo '<script type="text\javascript">alert("No se encontro el archivo");window.location.href="contenido.php"</script>';
}

include_once("../../estructura/pie.php");
