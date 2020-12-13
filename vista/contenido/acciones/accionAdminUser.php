<?php
include_once('../../estructura/cabecera.php');
/*
 * Nos encargamos de obtener los datos del formularios  con $datos yleer las acciones
 * estas acciones son exclusivas del administrador sobre los usuarios
 * podemos dale el alta/baja a la cuenta de un usuario
 * podemos otorgar/eliminar permisos sobre los usuarios
 */
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