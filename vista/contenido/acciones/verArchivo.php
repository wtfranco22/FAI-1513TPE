<?php
include_once("../../estructura/cabecera.php");
?>

<h2>Ver Archivo: </h2>
<?php
$archivo = new AbmArchivoCargado();
$listado = $archivo->buscar($_GET);
?>
<br />
<a class="btn btn-primary" href='../formularios/contenido.php'>volver</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Icono</th>
            <th scope="col">Usuario</th>
            <th scope="col">Link</th>
            <th scope="col">Clave</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($listado) > 0) {
            foreach ($listado as $objArchivo) {
                echo "<tr>";
                echo "<td>" . $objArchivo->getAcNombre() . "</td>";
                echo "<td>" . $objArchivo->getAcDescripcion() . "</td>";
                echo "<td>" . $objArchivo->getAcIcono() . "</td>";
                echo "<td>" . $objArchivo->getObjUsuario()->getUsApellido() . "</td>";
                echo "<td>" . $objArchivo->getAcLinkAcceso() . "</td>";
                echo "<td>" . $objArchivo->getAcProtegidoClave() . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>

<?php
include_once("../../estructura/pie.php");
?>