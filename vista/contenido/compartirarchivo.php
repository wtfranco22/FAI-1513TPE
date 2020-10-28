<?php
include_once("../estructura/cabecera.php");
?>
<script type="text/javascript">
    window.addEventListener("load", function(event) {
        var ref = window.location.href;
        var ubicacion = ref.split('?').pop();
        var url = document.getElementById('ubicacion');
        url.value = ubicacion;
        var nombre = document.getElementById('nombre');
        nombre.value = (ref.split('/').pop()).split('#', 1);
        nombre.readOnly = true;
    });
</script>
<form id="compartirarchivo" name="compartirarchivo" action="accion2.php" method="POST" data-toggle="validator">
    <div class="form-group">
        <label for="nombre"> Nombre del archivo: </label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="">
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control" id="ubicacion" name="ubicacion" value="">
    </div>
    <div class="form-group">
        <label for="dias"> Cantidad de días compartido: </label>
        <input type="number" class="form-control" id="dias" name="dias" placeholder="Cantidad de dias compartido">
    </div>
    <div class="form-group">
        <label for="descargas"> Cantidad de descargas posibles: </label>
        <input type="number" class="form-control" id="descargas" name="descargas" placeholder="Cantidad de descargas posibles">
    </div>
    <div class="form-group">
        <label for="usuario"> Usuario </label>
        <select id="usuario" name="usuario" class="form-control">
            <option value=""> Tipo de usuario </option>
            <option value="administrador"> Administrador </option>
            <option value="visitante"> Visitante </option>
            <option value="yo"> Yo </option>
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
        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#enlacegenerado" onclick="generarHash()"> Generar hash </button>
        <div id="enlacegenerado" class="collapse">
            <label for="enlace"> link para compartir: </label>
            <input type="text" id="enlace" class="form-control" value="/" name="enlace" readonly>
        </div>
    </div>
    <div class="clearfix">
        <button type="reset" class="btn btn-danger float-left"> Borrar Todo </button>
        <button type="submit" class="btn btn-primary float-right"> Enviar </button>
    </div>
</form>
</div>

<?php
include_once("../estructura/pie.php");
?>