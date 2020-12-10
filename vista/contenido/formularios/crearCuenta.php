<?php
include_once("../../estructura/cabecera.php");
if ($comienzaSesion->activa()) {
    //si la sesion esta activa lo mandamos a contenido
    header("Location:contenido.php");
    die();
}
?>
<form class="row justify-content-around" id="crearCuenta" name="crearCuenta" method="POST" onsubmit="return compararContra()" action="../acciones/accionCrearCuenta.php" data-toggle="validator" autocomplete="off">
    <div class="bg-dark p-4 m-5 shadow">
        <div class="bg-light p-5">
            <h1 class="text-center mt-5 mb-5">Crear Cuenta</h1>
            <div class="form-group">
                <input type="text" id="login" name="login" class="m-2 placeicon form-control shadow" placeholder="&#xf007; Usuario">
            </div>
            <div class="form-group">
                <input type="text" id="nombre" name="nombre" class="m-2 form-control shadow" placeholder="Nombre">
            </div>
            <div class="form-group">
                <input type="text" id="apellido" name="apellido" class="m-2 form-control shadow" placeholder="Apellido">
            </div>
            <div class="form-group">
                <div class="m-2 input-group">
                    <input type="password" id="clave" name="clave" class="form-control shadow" placeholder="&#xf023; Contraseña">
                    <button type="button" id="ojo" class="btn btn-dark fa fa-eye-slash" onclick="mostrarClave('clave')"></button>
                </div>
            </div>
            <div class="form-group">
                <div class="m-2 input-group">
                    <input type="password" id="clave2" name="clave2" class="form-control shadow" placeholder="&#xf023; Contraseña">
                    <button type="button" id="ojo" class="btn btn-dark fa fa-eye-slash" onclick="mostrarClave('clave2')"></button>
                </div>
                <span id="aviso" class="text-danger"></span>
            </div>
            <div>
                <button type="submit" class="m-2 btn btn-success btn-block shadow">Registrarse</button>
                <a class="m-2 btn btn-outline-dark btn-block" href="ingresarCuenta.php" role="button">Iniciar Sesión</a>
            </div>
        </div>
    </div>
</form>
<?php
include_once("../../estructura/pie.php");
?>