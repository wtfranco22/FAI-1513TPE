<?php
include_once('../../estructura/cabecera.php');
/*
 * Le damos a cada usuario la posibilidad de modificar sus datos almacenados
 * podemos cambiar el nombre, apellido, correo y la contraseña
 * ademas el usuario puede darse de baja
 */
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
if($resp){
    echo "<script> alert('Cambios registrados con éxito!');
     window.location.href='../formularios/perfilCuenta.php'</script>";
}else{
    echo "<script> alert('No se han registrados los cambios!');
     window.location.href='../formularios/perfilCuenta.php'</script>";
}

include_once('../../estructura/pie.php');
?>