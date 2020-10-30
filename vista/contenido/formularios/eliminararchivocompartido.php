<?php
include_once("../../estructura/cabecera.php");
?>
<?php
$mostrarUsuarios = new AbmUsuario();
$usuarios = $mostrarUsuarios->buscar(null);
?>
<script type="text/javascript">
    window.addEventListener("load", function(event) {
        var ref = window.location.href;
        var nombre = document.getElementById('nombre');
        nombre.value = ref.split('/').pop();
    });
</script>
<form id="eliminararchivocompartido" name="eliminararchivocompartido" action="../acciones/accionDejarCompartir.php" method="POST" data-toggle="validator">
    <div class="form-group">
        <label for="nombre"> Nombre del archivo: </label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="1234.png" readonly>
    </div>
    <div class="form-group">
        <label for="cantveces"> Cantidad de veces compartido: </label>
        <input type="number" class="form-control" id="cantveces" name="cantveces" value="15" readonly>
    </div>
    <div class="form-group">
        <label for="motivo"> Motivo de dejar de compartir: </label>
        <input type="text" class="form-control" id="motivo" name="motivo" placeholder="Motivo">
    </div>
    <div class="form-group">
        <label for="usuario"> Usuario </label>
        <select id="usuario" name="usuario" class="form-control">
            <option value=""> Tipo de usuario </option>
            <?php foreach ($usuarios as $user) : ?>
                <option value="<?php echo $user->getIdUsuario(); ?>"> <?php echo $user->getUsApellido(); ?> </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="clearfix">
        <button type="reset" class="btn btn-danger float-left">Borrar Todo</button>
        <button type="submit" class="btn btn-primary float-right">Enviar</button>
    </div>
</form>
</div>

<?php
include_once("../../estructura/pie.php");
?>