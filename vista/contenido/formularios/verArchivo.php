<?php
include_once("../../estructura/cabecera.php");
if (!$comienzaSesion->activa()) {
    header("Location:ingresarCuenta.php");
    die();
}
if(!($_GET['idusuario']==$comienzaSesion->getIdUsuario())){
    header("Location:contenido.php");
}
?>
<?php
$archivo = new AbmArchivoCargado();
$listado = $archivo->buscar($_GET);
?>
<a class="btn btn-outline-success" href='contenido.php'>volver</a>
<div class="table-responsive mt-5 mb-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Usuario</th>
                <th scope="col">Link</th>
                <th scope="col">Clave</th>
                <th scope="col">Inicio compartir</th>
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
                echo "<td>" . $objArchivo->getAcFechaInicioCompartir() . "</td>";
                echo "<td>" . $objArchivo->getAceFechaFinCompartir() . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$descargarArchivo = new Archivo();
$nombreArchivo = $objArchivo->getAcNombre();
if($descargarArchivo->existeArchivo($nombreArchivo)): ?>
<div class="clearfix">
    <button class='btn btn-success float-right' id='link' value='<?php echo$objArchivo->getAcLinkAcceso(); ?>' onclick='copiarLink()'> &#xf0c5; Copiar Link</button>
    <a class='btn btn-outline-primary float-left' href='../compartidos/<?php echo$nombreArchivo;?>' download='<?php echo$nombreArchivo;?>' >Descargar archivo</a>
</div>
<?php endif; ?>
<?php
include_once("../../estructura/pie.php");
?>