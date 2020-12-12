<?php
include_once("../../estructura/cabecera.php");
?>

<?php
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
?>

<?php
include_once("../../estructura/pie.php");
?>