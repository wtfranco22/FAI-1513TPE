<?php
include_once("../../estructura/cabecera.php");
?>

<!--<h2>Eliminar Archivo: </h2>-->
    <?php
    $datos = data_submitted();
    $obj = new Archivo();
    $respuesta= $obj->eliminararchivo($datos);
    //echo $respuesta;
    header("Location:../formularios/contenido.php?archivos=eliminados")
    ?>
    <!--<br/>
    <a class="btn btn-primary" href='../formularios/contenido.php'>volver</a>-->
<?php
include_once("../../estructura/pie.php");
?>
