<?php
include_once("../../estructura/cabecera.php");
?>
<?php
if (!$comienzaSesion->activa()) {
    header("Location:ingresarCuenta.php");
    die();
}
/*
En primera instancia no utilizamos $datos pero utilizamos autollamado con un formulario de botones, ultimas lineas
 */
$datos = data_submitted();
if (!isset($datos['archivos'])) {
    $datos['archivos'] = 'cargados';
}
$archivosEnBD = new AbmArchivoCargadoestado();
$datos['idusuario'] = $comienzaSesion->getIdUsuario();

$archivos = $archivosEnBD->archivosTipo($datos);
?>
<h2 class="m-3 text-center">ARCHIVOS <?php echo strtoupper($datos['archivos']) ?></h2>
<form class="m-2 shadow" method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <div class="input-group">
        <select class="form-control border border-success" id="archivos" name="archivos">
            <option value="cargados">Cargados</option>
            <option value="compartidos">Compartidos</option>
            <option value="nocompartidos">No compartidos</option>
            <option value="eliminados">Eliminados</option>
            <?php if ($comienzaSesion->rolAutorizado('arministrador')) : ?>
                <option value='desactivados'>Desactivados</option>
            <?php endif; ?>
        </select>
        <button type="submit" class="btn btn-success col-3">BUSCAR &#xf002;</button>
    </div>
</form>

<form class="m-md-5" id="contenido" name="contenido" action="../acciones/accionContenido.php" method="GET">
    <div class="row">
        <div class="col-md-6 form-group">
            <?php
            $directorio = "../archivos/";
            echo "<a class='btn btn-light' href='#$directorio' onclick='opciones(\"carpeta\",\"$directorio\")'>" .
                "<i class='fa fa-folder-open-o'></i>$directorio</a>";
            if (count($archivos) > 0) {
                echo "<ul>";
                foreach ($archivos as $archivo) {
                    $nombre = $archivo->getObjArchivoCargado()->getAcNombre();
                    $ide = $archivo->getObjArchivoCargado()->getIdArchivoCargado();
                    echo "<a href='#' onclick='opciones(\"archivo\",\"$nombre\",\"$ide\")'>" .
                        "<i class='fa fa-file'>" . $nombre . "</i></a><span style='float:right;'>" .
                        "<a href='verArchivo.php?archivos=".$_GET['archivos']."&&idarchivocargado=$ide&&idusuario=" .
                        $comienzaSesion->getIdUsuario() . "'><b>Ver Archivo</b></a></span><br>";
                }
                echo "</ul>";
            } else {
                echo "<br>Seleccione la carpeta 'archivos' para cargar un nuevo archivo.";
            }
            ?>
        </div>
        <div class="col-md-6 form-group" id="funcioncarpeta" style="display: none;">
            <h1 class="text-center">carpeta</h1>
            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-dark btn-block" data-toggle="collapse" data-target="#nuevacarpeta">Nueva carpeta</button>
                    <div id="nuevacarpeta" class="collapse">
                        <label for="nombreCarpeta">Nueva carpeta en: </label>
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="" readonly>
                        <input type="text" id="nombreCarpeta" name="nombreCarpeta" class="form-control" placeholder="Ingrese el nombre de la nueva carpeta">
                        <div>
                            <button type="submit" class="btn btn-success btn-block">Crear carpeta <i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-5 mt-md-0">
                    <button type="button" class="btn btn-dark btn-block" data-toggle="collapse" data-target="#crearArchivo">Nuevo archivo</button>
                    <div id="crearArchivo" class="collapse">
                        <label for="nombreCarpeta">Nuevo archivo en: </label>
                        <input type="text" class="form-control" id="ubicacionarchivo" name="ubicacionarchivo" value="" readonly>
                        <div>
                            <button onclick="redireccionar('creararchivo')" type="button" class="btn btn-success btn-block"> Crear archivo <i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 form-group" id="funcionarchivo" style="display: none;">
            <h2 class="text-center">Archivo</h2>
            <input type="hidden" class="form-control" id="idarchivo" name="idarchivo" value="">
            <input type="text" class="form-control text-center" id="nombreArchivo" name="nombreArchivo" value="" readonly>
            <div class="row mt-5">
                <div class="col-md-6">
                    <button type="button" onclick="redireccionar('modificararchivo')" class="btn btn-success btn-block">Modificar archivo <span class="float-right">&#xf044;</span></button>
                </div>
                <div class="col-md-6 mt-5 mt-md-0">
                    <button type="button" onclick="redireccionar('compartirarchivo')" class="btn btn-success btn-block">Compartir Archivo <span class="float-right">&#xf1e0;</span></button>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <button type="button" onclick="redireccionar('eliminararchivo')" class="btn btn-success btn-block">Eliminar archivo <span class="float-right">&#xf1f8;</span></button>
                </div>
                <div class="col-md-6 mt-5 mt-md-0">
                    <button type="button" onclick="redireccionar('eliminararchivocompartido')" class="btn btn-success btn-block">Dejar de compartir <span class="float-right">&#xf28d;</span></button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
include_once("../../estructura/pie.php");
?>