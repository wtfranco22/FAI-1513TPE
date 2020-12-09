<?php
include_once("../../estructura/cabecera.php");
?>
    <?php
    $datos = data_submitted();
    $obj = new Archivo();
    if($datos['clave']=='0'){
        $respuesta = $obj->alta($datos);
    }else{
        $respuesta = $obj->modificacion($datos);
    }
    header("Location:../formularios/contenido.php?archivos=cargados");
    ?>
<?php
include_once("../../estructura/pie.php");
?>