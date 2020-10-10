
<?php
include_once("../estructura/cabecera.php");
include_once("../../configuracion.php");
?>

    <h2>Compartir Archivo: </h2>
    <?php
    $datos = data_submitted();
    $obj = new archivo();
    $respuesta= $obj->compartirarchivo($datos);
    echo $respuesta;
    ?>
    <br/>
    <a class="btn btn-primary" href='compartirarchivo.php'>volver</a>
</div>

<?php
include_once("../estructura/pie.php");
?>
