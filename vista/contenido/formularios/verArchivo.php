<?php
include_once("../../estructura/cabecera.php");
if (!$comienzaSesion->activa()) {
    header("Location:ingresarCuenta.php");
    die();
}
?>
<h2>Ver Archivo: </h2>
<?php
$archivo = new AbmArchivoCargado();
$listado = $archivo->buscar($_GET);
?>
<br />
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Usuario</th>
                <th scope="col">Link</th>
                <th scope="col">Clave</th>
                <th scope="col">Fin compartir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($listado) > 0) {
                $objArchivo = $listado[0];
                echo "<tr>";
                echo "<th>" . $objArchivo->getAcNombre() . "</th>";
                echo "<td>" . $objArchivo->getAcDescripcion() . "</td>";
                echo "<td>" . $objArchivo->getObjUsuario()->getUsLogin() . "</td>";
                echo "<td>" . $objArchivo->getAcLinkAcceso() . "</td>";
                echo "<td>" . $objArchivo->getAcProtegidoClave() . "</td>";
                echo "<td>" . $objArchivo->getAceFechaFinCompartir() . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<a class="btn btn-success" href='contenido.php'>volver</a>
<?php
$descargarArchivo = new Archivo();
$nombreArchivo = $objArchivo->getAcNombre();
if($descargarArchivo->existeArchivo($nombreArchivo)){
    echo "<a href='../compartidos/$nombreArchivo' download='$nombreArchivo'>Descargar archivo</a>";
}
?>
<?php
include_once("../../estructura/pie.php");
?>