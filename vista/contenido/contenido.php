<?php
include_once("../estructura/cabecera.php");
include_once("../../configuracion.php");
?>
<form id="contenido" name="contenido" action="accion.php" method="GET">
    <div class="row">
        <div class="col-md-6 form-group">
            <?php
            $elementos = [];
            $directorio = '../../archivos';
            $nivel = 0;
            mostrarCarpeta($directorio, $elementos, $nivel);
            echo "<a class='btn btn-light' href='#$directorio' onclick='opciones(\"carpeta\",\"$directorio\")'>" .
                "<i class='fa fa-folder-open-o'></i>$directorio</a><ul>";
            $tempNivel = 0;
            foreach ($elementos as $archivo) {
                $elemento = $archivo["elemento"];
                $ruta = $archivo["ruta"];
                $nombre = $archivo["nombre"];
                $nivel = $archivo["nivel"];
                if($tempNivel>$nivel ){
                    echo"</ul>";
                    $tempNivel--;
                }
                if ($elemento == "carpeta") {
                    if($tempNivel==$nivel ){
                        echo"</ul>";
                        $tempNivel--;
                    }
                    echo "<a class='btn btn-light' href='#$ruta' onclick='opciones(\"carpeta\",\"$ruta\")'>" .
                        "<i class='fa fa-folder-open-o'></i> $nombre</a><br>";
                } else {
                    echo "<a href='#$ruta' onclick='opciones(\"archivo\",\"$ruta\")'>" .
                        "<i class='fa fa-file'></i> $nombre</a><br>";
                }
                if($tempNivel<$nivel){
                    echo"<ul>";
                    $tempNivel++;
                }
            }
            echo "</ul>";
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
                            <button type="submit" class="fa fa-plus btn btn-primary btn-block">Crear carpeta</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-dark btn-block" data-toggle="collapse" data-target="#crearArchivo">Nuevo archivo</button>
                    <div id="crearArchivo" class="collapse">
                        <label for="nombreCarpeta">Nuevo archivo en: </label>
                        <input type="text" class="form-control" id="ubicacionarchivo" name="ubicacionarchivo" value="" readonly>
                        <div>
                            <button onclick="redireccionar('creararchivo')" type="button" class="fa fa-plus btn btn-primary btn-block"> Crear archivo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 form-group" id="funcionarchivo" style="display: none;">
            <h1 class="text-center">archivo</h1>
            <input type="text" class="form-control" id="ubicacionmodarchivo" name="ubicacionmodarchivo" value="" readonly>
            <div class="row mt-5">
                <div class="col-md-6">
                    <button type="button" class="btn btn-dark btn-block" data-toggle="collapse" data-target="#modArchivo">Modificar archivo</button>
                    <div id="modArchivo" class="collapse">
                        <button type="button" onclick="redireccionar('modificararchivo')" class="fa fa-pencil btn btn-primary btn-block"> Modificar archivo</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-dark btn-block" data-toggle="collapse" data-target="#eliminarArchivo">Eliminar archivo</button>
                    <div id="eliminarArchivo" class="collapse">
                        <button onclick="redireccionar('eliminararchivo')" type="button" class=" fa fa-pencil btn btn-primary btn-block"> Eliminar archivo</button>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <button type="button" class="btn btn-dark btn-block" data-toggle="collapse" data-target="#compartirarchivo">Compartir archivo</button>
                    <div id="compartirarchivo" class="collapse">
                        <button onclick="redireccionar('compartirarchivo')" type="button" class="fa fa-pencil btn btn-primary btn-block">Compartir Archivo</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-dark btn-block" data-toggle="collapse" data-target="#eliminarArchivoCompartido">Eliminar archivo compartido</button>
                    <div id="eliminarArchivoCompartido" class="collapse">
                        <button onclick="redireccionar('eliminararchivocompartido')" type="button" class="fa fa-pencil btn btn-primary btn-block"> Eliminar archivo compartido</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

</div>

<?php
include_once("../estructura/pie.php");
?>