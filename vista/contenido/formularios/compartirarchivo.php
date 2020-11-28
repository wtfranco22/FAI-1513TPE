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
    $idarchivo = null;
}
?>
<script type="text/javascript">
    window.addEventListener("load", function(event) {
        var ref = window.location.href;
        var nombre = document.getElementById('nombre');
        nombre.value = ref.split('/').pop();
        nombre.readOnly = true;
        onload = generarHash();
    });
</script>
<form id="compartirarchivo" name="compartirarchivo" action="../acciones/accionCompartir.php" method="POST" data-toggle="validator">
    <div class="form-group">
        <label for="nombre"> Nombre del archivo: </label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="">
    </div>
    <input type="hidden" class="form_control" id="idarchivo" name="idarchivo" value="<?php echo $idarchivo; ?>">
    <div class="form-group">
        <label for="dias"> Cantidad de días compartido: </label>
        <input type="number" class="form-control" id="dias" name="dias" placeholder="Cantidad de dias compartido" oninput="generarHash()">
    </div>
    <div class="form-group">
        <label for="descargas"> Cantidad de descargas posibles: </label>
        <input type="number" class="form-control" id="descargas" name="descargas" placeholder="Cantidad de descargas posibles" oninput="generarHash()">
    </div>
    <div class="form-group">
        <label for="usuario"> Usuario </label>
        <select id="usuario" name="usuario" class="form-control">
            <option value=""> Tipo de usuario </option>
            <option value="<?php echo $comienzaSesion->getIdUsuario(); ?>"> <?php echo $comienzaSesion->getLoginUsuario(); ?> </option>
        </select>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="protegerpass" name="protegerpass" data-toggle="collapse" data-target="#ingresarclave">
        <label class="form-check-label" for="protegerpass">Proteger con contraseña</label>
    </div>
    <div id="ingresarclave" class="form-group collapse">
        <div class="input-group">
            <input type="password" class="form-control" id="clave" name="clave" oninput="fortaleza()">
            <button type="button" id="ojo" class="btn btn-dark fa fa-eye-slash" onclick="mostrarClave()"></button>
        </div>
        <p id="aviso"></p>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#enlacegenerado"> Generar hash </button>
        <div id="enlacegenerado" class="collapse">
            <label for="enlace"> link para compartir: </label>
            <input type="text" id="enlace" class="form-control" value="/" name="enlace" readonly>
        </div>
    </div>
    <div class="clearfix">
        <button type="reset" class="btn btn-danger float-left"> Borrar Todo </button>
        <button type="submit" class="btn btn-success float-right"> Enviar </button>
    </div>
</form>


<?php
include_once("../../estructura/pie.php");
?>