<?php
include_once("../../estructura/cabecera.php");
?>
<h2>
    <center>
        <?php
        $datos = data_submitted();
        if ($comienzaSesion->validar($datos)) {
            echo "BIENVENID@! " . $datos['usuario'] ;
            header("refresh:2;url=../formularios/contenido.php");
        } else {
            echo "¡Verifique sus datos por favor!";
            header("refresh:2;url=../formularios/login.php");
        }
        ?>
    </center>
</h2>
<?php
include_once("../../estructura/pie.php");
?>