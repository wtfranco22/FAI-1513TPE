<?php
include_once("estructura/cabecera.php");
include_once("../configuracion.php");
?>
    <?php
    $datos = data_submitted();
    $obj = new archivo();
    $respuesta = $obj->crearCarpeta($datos);
    echo $respuesta;
    ?>
    <br />
    <a class="btn btn-primary" href='contenido.php'>volver</a>
</div>

<?php
include_once("estructura/pie.php");
?>