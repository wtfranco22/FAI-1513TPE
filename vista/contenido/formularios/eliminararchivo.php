<?php
include_once("../../estructura/cabecera.php");
?>
<?php
if (!$comienzaSesion->activa()) {
    header("Location:ingresarCuenta.php");
    die();
}
if (isset($_GET['id'])) {
    $idarchivo = $_GET['id'];
} else {
    header("Location:ingresarCuenta.php");
}
?>

<script>
    window.addEventListener("load", function(event) {
        var ref = window.location.href;
        var nombre = document.getElementById('nombre');
        nombre.value = ref.split('&').pop();
    });
</script>

<div class="border border-light m-3 shadow">
    <a class="btn btn-outline-danger" href="contenido.php?">&#xf060;</a>
    <form class="m-5" id="eliminararchivo" name="eliminararchivo" action="../acciones/accionEliminar.php" method="POST" data-toggle="validator">
        <div class="form-group">
            <label for="nombre"> Nombre del archivo: </label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="" readonly>
        </div>
        <input type="hidden" class="form-control" id="idarchivo" name="idarchivo" value="<?php echo $idarchivo; ?>">
        <div class="form-group">
            <label for="motivo"> Motivo de eliminar: </label>
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