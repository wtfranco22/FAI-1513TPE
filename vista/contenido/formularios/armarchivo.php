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
<script type="text/javascript">
window.addEventListener("load", function(event) {
    
    var ref = window.location.href;
    var accion = ref.split('#').pop();
    var clave = document.getElementById('clave');
    if(accion=='0'){
        clave.value = '0';
    }else{
        clave.value = '1';
        var ocultarsubida=document.getElementById('subida');
        ocultarsubida.style.display='none';
        var nombre = document.getElementById('nombre');
        nombre.value = (ref.split('/').pop()).split('#', 1);
        onload=sugerirExtension('1');
        nombre.readOnly = true;
    }
  });
</script>
<form id="armarchivo" name="armarchivo" action="../acciones/accionArmarchivo.php" method="POST" data-toggle="validator" enctype="multipart/form-data">
    <div id="subida" class="media form-group">
        <div class="media-left">
            <img src="../archivos/upload.png" class="media-object" width="100">
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
    <input type="hidden" class="form_control" id="idarchivo" name="idarchivo" value="<?php echo$idarchivo; ?>">
    <div class="form-group">
        <textarea id="descripcion" name="descripcion"></textarea>
    </div>
    <div class="form-group">
        <label for="usuario"> Usuario </label>
        <select id="usuario" name="usuario" class="form-control">
        <option value=""> Tipo de usuario </option>
            <?php foreach($usuarios as $user): ?>
            <option value="<?php echo $user->getIdUsuario(); ?>"> <?php echo $user->getUsApellido(); ?> </option>
            <?php endforeach; ?>
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
        <input type="radio" class="form-check-input" id="pdf" name="tipo" value="pdf" >
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
            <input type="hidden" Class="form-control" id="clave" name="clave" value="">
        </div>
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