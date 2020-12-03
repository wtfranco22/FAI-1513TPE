<?php
include_once('../../estructura/cabecera.php');
?>
<?php
$datos = data_submitted();
$modificar = new AbmUsuario();
if (isset($datos['usactivo'])) {
    $resp = $modificar->inactivarUsuario(['idusuario' => $datos['idusuario']]);
    $comienzaSesion->cerrar();
} else {
    $resp = $modificar->modificacion($datos);
    $resp = $resp == $comienzaSesion->reCargar($datos);

}
header('Location:../formularios/perfilCuenta.php');
?>

<?php
include_once('../../estructura/pie.php');
?>