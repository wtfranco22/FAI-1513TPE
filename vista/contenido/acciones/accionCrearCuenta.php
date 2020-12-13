<?php
include_once("../../estructura/cabecera.php");

/**
 * $datos es la coleccion de los datos del formulario
 * $nuevoObjUsuario objeto para utilizar sus propios metodos
 * pasamos los datos a alta para saber si es posible habilitar al usuario o 
 * avisar que no se pudo concretar
 */
$datos = data_submitted();
$nuevoObjUsuario = new AbmUsuario();
if ($nuevoObjUsuario->alta($datos)) {
    echo "<script>
    alert('Registrado con éxito!');
    window.location.href='../formularios/ingresarCuenta.php';
    </script>";
} else {
    echo "<script>
    alert('Ups! Ha ocurrido un error.');
    window.location.href='../formularios/crearCuenta.php';
    </script>";
}

include_once("../../estructura/pie.php");
?>