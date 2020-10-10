<?php
include_once("../estructura/cabecera.php");
?>
<script type="text/javascript">
    window.addEventListener("load", function(event) {
        var ref = window.location.href;
        var url = ref.split('.php').pop();
        var ubicacion = document.getElementById('ubicacion');
        ubicacion.value = url;
        var nombre = document.getElementById('nombre');
        nombre.value = ref.split('/').pop();
    });
</script>
    <form id="eliminararchivocompartido" name="eliminararchivocompartido" action="accion3.php" method="POST" data-toggle="validator">
        <div class="form-group">
            <label for="nombre"> Nombre del archivo: </label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="1234.png" readonly>
        </div>
        <div>
            <input type="hidden" class="form-control" id="ubicacion" name="ubicacion" readonly>
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
                <option value="administrador"> Administrador </option>
                <option value="visitante"> Visitante </option>
                <option value="yo"> Yo </option>
            </select>
        </div>
        <div class="clearfix">
            <button type="reset" class="btn btn-danger float-left">Borrar Todo</button>
            <button type="submit" class="btn btn-primary float-right">Enviar</button>
        </div>
    </form>
</div>

<?php
include_once("../estructura/pie.php");
?>