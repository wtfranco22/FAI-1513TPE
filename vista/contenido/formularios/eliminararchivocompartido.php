<?php
include_once("../../estructura/cabecera.php");
?>
<?php
if (!$comienzaSesion->activa()) {
    //si no hay sesion iniciada, lo dirige a ingresar cuenta
    header("Location:ingresarCuenta.php");
    die();
}
if (isset($_GET['id'])) {
    //buscamos con el id enviado por url
    $idarchivo = $_GET['id'];
    $buscArchivo = new AbmArchivoCargado();
    $archivo = $buscArchivo->buscar(['idarchivocargado'=>$idarchivo]);
} else {
    //si no hay id para buscar, volvemos a contenido
    header("Location:contenido.php");
    die();
}
?>
<script type="text/javascript">
    window.addEventListener("load", function(event) {
        var ref = window.location.href;
        var nombre = document.getElementById('nombre');
        nombre.value = ref.split('&').pop();
    });
</script>

<div class="border border-light m-3 shadow">
    <a class="btn btn-outline-danger" href="contenido.php?">&#xf060;</a>
    <form class="m-5" id="eliminararchivocompartido" name="eliminararchivocompartido" action="../acciones/accionDejarCompartir.php" method="POST" data-toggle="validator">
        <div class="form-group">
            <label for="nombre"> Nombre del archivo: </label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="" readonly>
        </div>
        <input type="hidden" class="form_control" id="idarchivo" name="idarchivo" value="<?php echo $idarchivo; ?>">
        <div class="form-group">
            <label for="cantveces"> Cantidad de veces compartido: </label>
            <input type="number" class="form-control" id="cantveces" name="cantveces" value="<?php echo $archivo[0]->getAcCantidadUsada(); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="motivo"> Motivo de dejar de compartir: </label>
            <input type="text" class="form-control" id="motivo" name="motivo" placeholder="Motivo">
        </div>
        <div class="form-group">
            <label for="usuario"> Usuario </label>
            <select id="usuario" name="usuario" class="form-control">
                <option value="<?php echo $comienzaSesion->getIdUsuario(); ?>"> <?php echo $comienzaSesion->getLoginUsuario(); ?> </option>
            </select>
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