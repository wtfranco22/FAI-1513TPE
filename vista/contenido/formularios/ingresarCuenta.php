<?php
include_once("../../estructura/cabecera.php");
if($comienzaSesion->activa()){
    header("Location:contenido.php");
    die();
}?>

<form class="row justify-content-around" id="login" name="login" method="POST" action="../acciones/accionLogin.php" data-toggle="validator" autocomplete="off">
    <div class="bg-dark p-4 m-5 shadow">
        <div class="bg-light p-5">
            <h1 class="text-center m-5">Iniciar sesión</h1>
            <div class="form-group">
                <input type="text" id="usuario" name="usuario" class="placeicon form-control shadow" placeholder="&#xf007; Usuario">
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="password" id="clave" name="clave" class="placeicon form-control shadow" placeholder="&#xf023; Contraseña">
                    <button type="button" id="ojo" class="btn btn-dark fa fa-eye-slash" onclick="mostrarClave()"></button>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-success btn-block shadow" onclick="encriptarPass()">Iniciar sesión</button>
                <a class="btn btn-outline-dark btn-block" href="crearCuenta.php" role="button">Registrarse</a>
            </div>
        </div>
    </div>
</form>

<?php
include_once("../../estructura/pie.php");
?>