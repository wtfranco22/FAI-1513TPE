<?php
include_once("../../estructura/cabecera.php");
?>

<form id="inicio" name="inicio" action="contenido.php" method="POST" data-toggle="validator" enctype="multipart/form-data">
<h3>Ver los siguientes archivos</h3>
    <div class="form-group m-5">
        <button type="submit" class="form-control" id="todos" name="archivos" value="todos">Todos los archivos</button>
    </div>
    <div class="form-group m-5">
        <button type="submit" class="form-control" id="cargados" name="archivos" value="cargados">Archivos Cargados</button>
    </div>
    <div class="form-group m-5">
        <button type="submit" class="form-control" id="compartidos" name="archivos" value="compartidos">Archivos Compartidos</button>
    </div>
    <div class="form-group m-5">
        <button type="submit" class="form-control" id="nocompartidos" name="archivos" value="nocompartidos">Archivos No Compartidos</button>
    </div>
    <div class="form-group m-5">
        <button type="submit" class="form-control" id="eliminados" name="archivos" value="eliminados">Archivos Eliminados</button>
    </div>
    <div class="form-group m-5">
        <button type="submit" class="form-control" id="desactivados" name="archivos" value="desactivados">Archivos Eliminados</button>
    </div>
</form>
</div>

<?php
include_once("../../estructura/pie.php");
?>