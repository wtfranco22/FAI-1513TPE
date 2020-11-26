<?php
include_once("../../estructura/cabecera.php");
?>

<h2>Eliminar Archivo: </h2>
    <?php
    $datos = data_submitted();
    $obj = new Archivo();
    $respuesta= $obj->eliminararchivo($datos);
    echo $respuesta;
    ?>
    <br/>
    <a class="btn btn-primary" href='../formularios/contenido.php'>volver</a>


<?php
include_once("../../estructura/pie.php");
?>
