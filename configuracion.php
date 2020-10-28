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
include_once($ROOT.'control/archivo.php');


// Variable que define la pagina de autenticacion del proyecto
$INICIO = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/vista/login/login.php";

// variable que define la pagina principal del proyecto (menu principal)
$PRINCIPAL = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/principal.php";

$_SESSION['ROOT']=$ROOT;
?>