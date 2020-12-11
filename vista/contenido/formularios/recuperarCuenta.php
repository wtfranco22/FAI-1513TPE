<?php
include_once("../../estructura/cabecera.php");
if ($comienzaSesion->activa()) {
    header("Location:ingresarCuenta.php");
    die();
}else{
    if(isset($_GET['nueva']) && $comienzaSesion->recuperando($_GET['nueva'])){
        header("Location:perfilCuenta.php");
        die();
    }
}
?>

<div class="bg-light border border-light shadow">
    <a class="btn btn-outline-danger" href="ingresarCuenta.php?">&#xf060;</a>
    <form class="m-5" id="recuperarCuenta" name="recuperarCuenta" action="../acciones/accionRecuperarCuenta.php" method="POST" data-toggle="validator" autocomplete="off">
        <h2>Recuperar Cuenta &#xf2bb; </h2>
        <div class="form-group">
            <label for="nombre">Nombre: </label>
            <input type="text" id="nombre" name="nombre" class="form-control shadow" value="" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="apellido">Apellido: </label>
            <input type="text" id="apellido" name="apellido" class="form-control shadow" value="" placeholder="Apellido">
        </div>
        <div class="form-group">
            <label for="login">Login Identificador: </label>
            <input type="text" id="login" name="login" class="form-control shadow" value="" placeholder="Nombre de usuario único">
        </div>
        <div class="form-group">
            <label for="correo">Correo: </label>
            <input type="text" id="correo" name="correo" class="form-control shadow" value="" placeholder="Correo">
        </div>
        <div class="clearfix">
            <button type="reset" class="btn btn-outline-dark float-left">Borrar</button>
            <button type="submit" class="btn btn-success float-right">Enviar</button>
        </div>
    </form>
</div>

<?php
include_once("../../estructura/pie.php");
?>