<?php
include_once("../../estructura/cabecera.php");

/*
 * $datos array es la coleccion de datos del formulario
 * $recuperarUsuario AbmUsuario, un objeto para utilizar sus propios metodos
 * $contra sting, es la nueva clave para el usuario encontrado y validado sino es nulo
 */
$datos = data_submitted();
$recuperarUsuario = new AbmUsuario();
$contra = $recuperarUsuario->validarCorreo($datos);
if ($contra!=null) {
    //dejamos la responsabilidad a enviarCorreo.php
    include_once("../../../PHPMailer/enviarCorreo.php");
} else {
    //el login no coincidio con el correo en la BD
    echo "<script>
    alert('Datos erroneos');
    window.location.href='../formularios/recuperarCuenta.php';
    </script>";
}

include_once("../../estructura/pie.php");
?>