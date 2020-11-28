<?php
include_once("../../estructura/cabecera.php");
?>
<h2>
    <center>
        <?php
        $datos = data_submitted();
        $nuevoObjUsuario = new AbmUsuario();
        if ($nuevoObjUsuario->alta($datos)) {
            echo "¡Gracias por ser parte de nosotros!";
            header("refresh:1;url=../formularios/ingresarCuenta.php");
        } else {
            echo "¡Ups! Ha ocurrido un error";
            header("refresh:1;url=../formularios/crearCuenta.php");
        }
        ?>
    </center>
</h2>
<?php
include_once("../../estructura/pie.php");
?>