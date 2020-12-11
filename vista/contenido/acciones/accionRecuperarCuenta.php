<?php
include_once("../../estructura/cabecera.php");
?>

<?php
$datos = data_submitted();
$recuperarUsuario = new AbmUsuario();
$contra = $recuperarUsuario->validarCorreo($datos);
if ($contra!=null) {
    include_once("../../../PHPMailer/enviarCorreo.php");
} else {
    echo "<script>
    alert('Datos erroneos');
    window.location.href='../formularios/recuperarCuenta.php';
    </script>";
}
?>

<?php
include_once("../../estructura/pie.php");
?>