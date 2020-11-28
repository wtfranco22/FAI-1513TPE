<?php
include_once("../../estructura/cabecera.php");
?>
<?php
if (!$comienzaSesion->activa()) {
    header("Location:ingresarCuenta.php");
    die();
}
$datos = data_submitted();
$archivos = [];
if (isset($datos['cerrar'])) {
    $comienzaSesion->cerrar();
    header("Location:ingresarCuenta.php");
}
if ($datos != null) {
    $archivosEnBD = new Archivo();
    $datos['idusuario']=$comienzaSesion->getIdUsuario();
    $archivos = $archivosEnBD->traerArchivos($datos);
}
?>
<form id="contenido" name="contenido" action="../acciones/accionContenido.php" method="GET">
    <h2 class="text-center">Seleccione un archivo o carpeta para realizar una accion</h2>
    <div class="row">
        <div class="col-md-6 form-group">
            <?php
            $directorio = "../archivos";
            echo "<a class='btn btn-light' href='#$directorio' onclick='opciones(\"carpeta\",\"$directorio\")'>" .
                "<i class='fa fa-folder-open-o'></i>$directorio</a>";
            if (count($archivos) > 0) {
                echo "<ul>";
                foreach ($archivos as $archivo) {
                    $nombre = $archivo->getObjArchivoCargado()->getAcNombre();
                    $descripcion = $archivo->getObjArchivoCargado()->getAcDescripcion();
                    $estado = $archivo->getObjEstadoTipos()->getEtDescripcion();
                    $ide = $archivo->getObjArchivoCargado()->getIdArchivoCargado();
                    $ruta = $directorio . '/' . $nombre;
                    echo "<a href='#$ruta' onclick='opciones(\"archivo\",\"$ruta\",\"$ide\")'>" .
                        "<i class='fa fa-file'></i>$nombre</a>".
                        "<span style='float:right;'><a href='verArchivo.php?archivos=".$_GET['archivos']."&&idarchivocargado=$ide'><b>Ver Archivo</b></a></span><br>";
                }
                echo "</ul>";
            } else {
                echo "No se encuentran archivos en la BD, seleccione la carpeta para un nuevo archivo <br>";
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
                <div class="col-md-6">
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
            <h1 class="text-center">archivo</h1>
            <input type="hidden" class="form-control" id="idarchivo" name="idarchivo" value="">
            <input type="text" class="form-control" id="ubicacionmodarchivo" name="ubicacionmodarchivo" value="" readonly>
            <div class="row mt-5">
                <div class="col-md-6">
                    <button type="button" class="btn btn-dark btn-block" data-toggle="collapse" data-target="#modArchivo">Modificar archivo</button>
                    <div id="modArchivo" class="collapse">
                        <button type="button" onclick="redireccionar('modificararchivo')" class="btn btn-success btn-block"> Modificar archivo <i class="fa fa-pencil"></i></button>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-dark btn-block" data-toggle="collapse" data-target="#eliminarArchivo">Eliminar archivo</button>
                    <div id="eliminarArchivo" class="collapse">
                        <button onclick="redireccionar('eliminararchivo')" type="button" class="btn btn-success btn-block"> Eliminar archivo <i class="fa fa-trash-o"></i></button>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <button type="button" class="btn btn-dark btn-block" data-toggle="collapse" data-target="#compartirarchivo">Compartir archivo</button>
                    <div id="compartirarchivo" class="collapse">
                        <button onclick="redireccionar('compartirarchivo')" type="button" class="btn btn-success btn-block">Compartir Archivo <i class="fa fa-share-alt"></i></button>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-dark btn-block" data-toggle="collapse" data-target="#eliminarArchivoCompartido">Dejar de compartir</button>
                    <div id="eliminarArchivoCompartido" class="collapse">
                        <button onclick="redireccionar('eliminararchivocompartido')" type="button" class="btn btn-success btn-block"> Dejar de compartir <i class="fa fa-stop-circle"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <div class="form-group m-2">
        <button type="submit" class="col-4 btn btn-success" id="cargados" name="archivos" value="cargados">Archivos Cargados</button>
    </div>
    <div class="form-group m-2">
        <button type="submit" class="col-4 btn btn-success" id="compartidos" name="archivos" value="compartidos">Archivos Compartidos</button>
    </div>
    <div class="form-group m-2">
        <button type="submit" class="col-4 btn btn-success" id="nocompartidos" name="archivos" value="nocompartidos">Archivos No Compartidos</button>
    </div>
    <div class="form-group m-2">
        <button type="submit" class="col-4 btn btn-success" id="eliminados" name="archivos" value="eliminados">Archivos Eliminados</button>
    </div>
    <div class="form-group m-2">
        <button type="submit" class="col-4 btn btn-success" id="desactivados" name="archivos" value="desactivados">Archivos Desactivados</button>
    </div>
    <div class="clearfix">
        <button type="submit" class="btn btn-danger float-right" id="cerrar" name="cerrar" value="salir">Cerrar Sesion</button>
    </div>
</form>
<?php
include_once("../../estructura/pie.php");
?>