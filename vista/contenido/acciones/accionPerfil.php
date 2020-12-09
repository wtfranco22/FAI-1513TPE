<?php
include_once('../../estructura/cabecera.php');

$datos = data_submitted();
$modificar = new AbmUsuario();
if (isset($datos['usactivo'])) {
    $resp = $modificar->inactivarUsuario(['idusuario' => $datos['idusuario']]);
    $comienzaSesion->cerrar();
} else {
    $resp = $modificar->modificacion($datos);
    $resp = $resp == $comienzaSesion->reCargar($datos);
    //la accion recargar es para cargar los datos modificados por el usuario quien ya tiene una sesion iniciada y verificada
}
header('Location:../formularios/perfilCuenta.php');

include_once('../../estructura/pie.php');
?>