<?php
include_once("../../estructura/cabecera.php");
?>
<?php
$datos = data_submitted();
$comienzaSesion->iniciar($datos['usuario'], ($datos['clave']));
if ($comienzaSesion->validar()) {
    echo "<h1><center>BIENVENIDO! " . $datos['usuario']."</center></h1>";
    header("refresh:10;url=../formularios/contenido.php");
} else {
    $comienzaSesion->cerrar();
    echo "<h1><center>¡Verifique sus datos por favor!</center></h1>";
    header("refresh:3;url=../formularios/login.php");
}
?>
<?php
include_once("../../estructura/pie.php");
?>