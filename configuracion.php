<?php
header('Content-Type: text/html; charset=utf-8');
header ("Cache-Control: no-cache, must-revalidate ");

/////////////////////////////
// CONFIGURACION APP//
/////////////////////////////
$PROYECTO='FAI-1513TPE-master';

//variable que almacena el directorio del proyecto
$ROOT=$_SERVER['DOCUMENT_ROOT']."/$PROYECTO/";

include_once($ROOT.'utiles/funciones.php');

// Variable que define la pagina de autenticacion del proyecto
$INICIO = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/vista/contenido/formularios/ingresarCuenta.php";

// variable que define la pagina principal del proyecto (menu principal)
$VISTA = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/vista/contenido/formularios/";

$_SESSION['ROOT']=$ROOT;
?>