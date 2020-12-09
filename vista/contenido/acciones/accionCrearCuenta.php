<?php
include_once("../../estructura/cabecera.php");

        $datos = data_submitted();
        $nuevoObjUsuario = new AbmUsuario();
        if ($nuevoObjUsuario->alta($datos)) {
            echo '<script type="text\javascript">alert("Registrado con éxito!");window.location.href="../formularios/ingresarCuenta.php"</script>';
        } else {
            echo '<script type="text\javascript">alert("Ups! Ha ocurrido un error.");window.location.href="../formularios/crearCuenta.php"</script>';
        }

include_once("../../estructura/pie.php");
?>