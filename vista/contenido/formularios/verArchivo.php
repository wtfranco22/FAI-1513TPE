<?php
include_once("../../estructura/cabecera.php");
$archivo = new AbmArchivoCargadoEstado();
if (!$comienzaSesion->activa()) {
    if ($_GET['aclinkacceso'] != null) {
        //si no hay sesion, solo puede ingresar por aclinkacceso
        $listado = $archivo->archivosTipo(['archivos' => 'compartidos', 'aclinkacceso' => $_GET['aclinkacceso']]);
        //de todos los archivos compartidos, buscamos el que coincide con el linkacceso
        if (count($listado) <= 0) {
            //no hay nada que hacer, salimos
            echo '<script type="text\javascript">alert("No se encontro el archivo");window.location.href="ingresarCuenta.php"</script>';
            die();
        } else {
            echo "</div>";
        }
    } else {
        header("Location:ingresarCuenta.php");
        die();
    }
} else {
    if ($_GET['idusuario'] == $comienzaSesion->getIdUsuario()) {
        $listado = $archivo->archivosTipo($_GET);
        if ($listado[0] == null) {
            header("Location:contenido.php");
            die();
        }
    } else {
        header("Location:contenido.php");
        die();
    }
}
?>

<a class="btn btn-outline-danger" href="contenido.php?">&#xf060;</a>
<div class="table-responsive mt-5 mb-5">
    <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">Nombre Archivo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Usuario</th>
                <th scope="col">Link Descarga</th>
                <th scope="col">Descagadas</th>
                <th scope="col">Limite Descagas</th>
                <th scope="col">Inicio compartir</th>
                <th scope="col">Fin compartir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($listado) > 0) {
                $objArchivo = $listado[0];
                echo "<tr>";
                echo "<th>" . $objArchivo->getObjArchivoCargado()->getAcNombre() . "</th>";
                echo "<td>" . $objArchivo->getObjArchivoCargado()->getAcDescripcion() . "</td>";
                echo "<td>" . $objArchivo->getObjUsuario()->getUsLogin() . "</td>";
                echo "<td>" . $objArchivo->getObjArchivoCargado()->getAcLinkAcceso() . "</td>";
                echo "<td>" . $objArchivo->getObjArchivoCargado()->getAcCantidadUsada() . "</td>";
                echo "<td>" . $objArchivo->getObjArchivoCargado()->getAcCantidadDescarga() . "</td>";
                echo "<td>" . $objArchivo->getObjArchivoCargado()->getAcFechaInicioCompartir() . "</td>";
                echo "<td>" . $objArchivo->getObjArchivoCargado()->getAceFechaFinCompartir() . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    if ($objArchivo->getObjEstadoTipos()->getIdEstadoTipos() == 2) : ?>
        <form id="contadorDescargas" name="contadorDescargas" action="../acciones/accionDescargar.php" method="POST" data-toggle="validator">
            <button type="submit" class='btn btn-primary float-left' id="aclinkacceso" name="aclinkacceso" value="<?php echo $objArchivo->getObjArchivoCargado()->getAcLinkAcceso(); ?>">&#xf019; Descargar </button>
        </form>
        <button class='btn btn-success float-right' id='link' name="link" value='<?php echo $objArchivo->getObjArchivoCargado()->getAcLinkAcceso(); ?>' onclick="copiarLink()">&#xf0c5; Copiar Link</button>
    <?php endif; ?>
</div>


<?php
include_once("../../estructura/pie.php");
?>