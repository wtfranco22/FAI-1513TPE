<?php
include_once("../../estructura/cabecera.php");
if (!$comienzaSesion->activa()) {
    header("Location:ingresarCuenta.php");
    die();
}
?>

<div class="border border-light m-3 shadow">
    <a class="btn btn-outline-danger" href="contenido.php?">&#xf060;</a>
    <form class="m-5" id="perfilCuenta" name="perfilCuenta" onsubmit="return compararContra()" action="../acciones/accionPerfil.php" method="POST" data-toggle="validator" autocomplete="off">
        <h2>Modificacion de los Datos &#xf2bb; </h2>
        <input type="hidden" id="idusuario" name="idusuario" class="form-control" value="<?php echo $comienzaSesion->getIdUsuario(); ?>">
        <div class="form-group">
            <label for="nombre">Nombre: </label>
            <input type="text" id="nombre" name="nombre" class="form-control shadow" value="<?php echo $comienzaSesion->getNombreUsuario(); ?>">
        </div>
        <div class="form-group">
            <label for="apellido">Apellido: </label>
            <input type="text" id="apellido" name="apellido" class="form-control shadow" value="<?php echo $comienzaSesion->getApellidoUsuario(); ?>">
        </div>
        <div class="form-group">
            <label for="correo">Correo: </label>
            <input type="text" id="correo" name="correo" class="form-control shadow" value="<?php echo $comienzaSesion->getCorreoUsuario(); ?>">
        </div>
        <div class="form-group">
            <label for="login">Login Identificador: </label>
            <input type="text" id="login" name="login" class="form-control shadow" value="<?php echo $comienzaSesion->getLoginUsuario(); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="clave">Nueva contraseña:</label>
            <div class="input-group">
                <input type="password" id="clave" name="clave" class="form-control shadow" placeholder="&#xf023; Contraseña">
                <button type="button" id="ojo" class="btn btn-dark fa fa-eye-slash" onclick="mostrarClave('clave')"></button>
            </div>
        </div>
        <div class="form-group">
            <label for="clave2">Confirmar contraseña:</label>
            <div class="input-group">
                <input type="password" id="clave2" name="clave2" class="form-control shadow" placeholder="&#xf023; Contraseña">
                <button type="button" id="ojo" class="btn btn-dark fa fa-eye-slash" onclick="mostrarClave('clave2')"></button>
            </div>
            <span id="aviso" class="text-danger"></span>
        </div>
        <div class="clearfix">
            <button type="reset" class="btn btn-outline-dark float-left">Restaurar valores</button>
            <button type="submit" class="btn btn-outline-danger float-left" id="usactivo" name="usactivo" value="0">Eliminar Cuenta</button>
            <button type="submit" class="btn btn-success float-right">Modificar</button>
        </div>
    </form>
</div>

<?php
include_once("../../estructura/pie.php");
?>