<?php
header('Content-Type: text/html; charset=utf-8');
header ("Cache-Control: no-cache, must-revalidate ");

/////////////////////////////
// CONFIGURACION APP//
/////////////////////////////
$PROYECTO='FAI-1513TPE';

//variable que almacena el directorio del proyecto
$ROOT=$_SERVER['DOCUMENT_ROOT']."/$PROYECTO/";

include_once($ROOT.'utiles/funciones.php');

$_SESSION['ROOT']=$ROOT;
?>