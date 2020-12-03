<?php
include_once('../../estructura/cabecera.php');
?>
<?php
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

?>
<?php
include_once('../../estructura/pie.php');
?>