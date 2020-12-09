<?php
include_once('../../estructura/cabecera.php');

$datos = data_submitted();
$modificar = new AbmUsuario();
if(isset($datos['alta'])){
    $modificar->activarUsuario($datos);
}elseif(isset($datos['baja'])){
    $modificar->inactivarUsuario(['idusuario'=>$datos['baja']]);
}elseif(isset($datos['accionRolUser'])){
    $modificar->modificarRolesUsuario($datos);
}
header('Location:../formularios/administrarUsuarios.php');


include_once('../../estructura/pie.php');
?>