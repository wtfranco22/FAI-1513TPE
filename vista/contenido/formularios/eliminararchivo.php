<?php
include_once("../../estructura/cabecera.php");
?>
<?php
if(isset($_GET['id'])){
    $idarchivo=$_GET['id'];
}else{
    $idarchivo=null;
}
$mostrarUsuarios = new AbmUsuario();
$usuarios = $mostrarUsuarios->buscar(null);
?>
<script>
    window.addEventListener("load", function(event) {
        var ref = window.location.href;
        var nombre = document.getElementById('nombre');
        nombre.value = ref.split('/').pop();
    });
</script>
<form id="eliminararchivo" name="eliminararchivo" action="../acciones/accionEliminar.php" method="POST" data-toggle="validator">
    <div class="form-group">
        <label for="nombre"> Nombre del archivo: </label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="" readonly>
    </div>
    <input type="hidden" class="form_control" id="idarchivo" name="idarchivo" value="<?php echo$idarchivo; ?>">
    <div class="form-group">
        <label for="motivo"> Motivo de eliminar: </label>
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