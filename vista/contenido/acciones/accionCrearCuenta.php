<?php
include_once("../../estructura/cabecera.php");
?>
<?php
$datos = data_submitted();
$nuevoObjUsuario = new AbmUsuario();
if ($nuevoObjUsuario->alta($datos)) {
    echo "<script> alert('Registrado con éxito!'); window.location.href='../formularios/ingresarCuenta.php'; </script>";
} else {
    echo "<script> alert('Ups! Ha ocurrido un error.'); window.location.href='../formularios/crearCuenta.php'; </script>";
}
?>
<?php
include_once("../../estructura/pie.php");
?>