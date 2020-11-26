<?php
include_once("../../estructura/cabecera.php");
?>
    <?php
    $datos = data_submitted();
    $obj = new Archivo();
    $respuesta = $obj->crearCarpeta($datos);
    echo $respuesta;
    ?>
    <br />
    <a class="btn btn-primary" href='../formularios/contenido.php'>volver</a>


<?php
include_once("../../estructura/pie.php");
?>