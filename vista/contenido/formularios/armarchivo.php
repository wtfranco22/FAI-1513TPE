<?php
include_once("../../estructura/cabecera.php");
?>
<?php
if (!$comienzaSesion->activa()) {
    //si no hay sesion activa lo sacamos de la pagina 
    header("Location:ingresarCuenta.php");
    die();
}
if (isset($_GET['id'])) {
    //obtenemos el id del archivo si ingreso para modificar
    $idarchivo = $_GET['id'];
} else {
    //enviamos id null cuendo el usuario va a cargar un archivo
    $idarchivo = null;
}
?>

<script type="text/javascript">
    /*
al cargar la pagina leemos la url y tenemos la clave si es alta o modificacion,
tenemos el nombre del archivo junto a su extension,
extraemos estos datos y los volcamos a los campos
 */
    window.addEventListener("load", function(event) {
        
        var ref = window.location.href;
        var accion = ref.split('#').pop();
        var clave = document.getElementById('clave');
        if (accion == '0') {
            clave.value = '0';
        } else {
            clave.value = '1';
            var ocultarsubida = document.getElementById('subida');
            ocultarsubida.style.display = 'none';
            var nombre = document.getElementById('nombre');
            nombre.value = (ref.split('&').pop()).split('#', 1);
            onload = sugerirExtension('1');
            nombre.readOnly = true;
        }
    });
</script>
<div class="border border-light m-3 shadow">
    <a class="btn btn-outline-danger" href="contenido.php?">&#xf060;</a>
    <form class="m-5" id="armarchivo" name="armarchivo" action="../acciones/accionArmarchivo.php" method="POST" data-toggle="validator" enctype="multipart/form-data">
    <!--CAMPOS | archivo | nombre | idarchivo | descripcion | usuario | tipo | clave (0,1) este formulario debemos mostrar si es un archivo a modificar o cargar uno nuevo-->
        <div id="subida" class="media form-group">
            <div class="media-left">
                <img src="../../../archivos/upload.png" class="media-object" width="100">
            </div>
            <div class="media-body">
                <h4>Archivo a compartir:</h4>
                <input type="file" class="form-control-file" id="archivo" name="archivo" onchange="sugerirExtension('0')">
            </div>
        </div>
        <div class="form-group">
            <label for="nombre"> Nombre del archivo: </label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="">
        </div>
        <input type="hidden" class="form-control" id="idarchivo" name="idarchivo" value="<?php echo $idarchivo; ?>">
        <div class="form-group">
            <textarea id="descripcion" name="descripcion"></textarea>
        </div>
        <div class="form-group">
            <label for="usuario"> Usuario </label>
            <select id="usuario" name="usuario" class="form-control">
                <option value="<?php echo $comienzaSesion->getIdUsuario(); ?>"> <?php echo $comienzaSesion->getLoginUsuario(); ?> </option>
            </select>
        </div>
        <div class="form-check-inline">
            <input type="radio" class="form-check-input" id="img" name="tipo" value="img">
            <i class="fa fa-picture-o" aria-hidden="true"></i>
            <label for="img"> Imagen </label>
        </div>
        <div class="form-check-inline">
            <input type="radio" class="form-check-input" id="zip" name="tipo" value="zip">
            <i class="fa fa-file-archive-o" aria-hidden="true"></i>
            <label for="zip"> Zip </label>
        </div>
        <div class="form-check-inline">
            <input type="radio" class="form-check-input" id="doc" name="tipo" value="doc">
            <i class="fa fa-file-word-o" aria-hidden="true"></i>
            <label for="doc"> Doc </label>
        </div>
        <div class="form-check-inline">
            <input type="radio" class="form-check-input" id="pdf" name="tipo" value="pdf">
            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
            <label for="pdf"> PDF </label>
        </div>
        <div class="form-check-inline">
            <input type="radio" class="form-check-input" id="xls" name="tipo" value="xls">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i>
            <label for="xls"> XLS </label>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input type="hidden" class="form-control" id="clave" name="clave" value="">
            </div>
        </div>
        <div class="clearfix">
            <button type="reset" class="btn btn-danger float-left">Borrar Todo</button>
            <button type="submit" class="btn btn-success float-right">Enviar</button>
        </div>
    </form>
</div>

<?php
include_once("../../estructura/pie.php");
?>