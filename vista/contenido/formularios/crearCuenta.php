<?php
include_once("../../estructura/cabecera.php");
if($comienzaSesion->activa()){
    header("Location:contenido.php");
    die();
}
?>

<form class="row justify-content-around" id="crearCuenta" name="crearCuenta" method="POST" action="../acciones/accionCrearCuenta.php" data-toggle="validator" autocomplete="off">
    <div class="bg-dark p-4 m-5 shadow">
        <div class="bg-light p-5">
            <h1 class="text-center m-5">Crear Cuenta</h1>
            <div class="form-group">
                <input type="text" id="login" name="login" class="m-2 placeicon form-control shadow" placeholder="&#xf007; Usuario">
            </div>
            <div class="form-group">
                <input type="text" id="nombre" name="nombre" class="m-2 placeicon form-control shadow" placeholder="Nombre">
            </div>
            <div class="form-group">
                <input type="text" id="apellido" name="apellido" class="m-2 placeicon form-control shadow" placeholder="Apellido">
            </div>
            <div class="form-group">
                <div class="m-2 input-group">
                    <input type="password" id="clave" name="clave" class="placeicon form-control shadow" placeholder="&#xf023; Contraseña">
                    <button type="button" id="ojo" class="btn btn-dark fa fa-eye-slash" onclick="mostrarClave()"></button>
                </div>
            </div>
            <div class="form-group">
                <input type="password" id="clave2" name="clave2" class="m-2 placeicon form-control shadow" placeholder="&#xf023; Confirmar Contraseña">
            </div>
            <div>
                <button type="submit" class="m-2 btn btn-success btn-block shadow" onclick="encriptarPass()">Registrarse</button>
                <a class="m-2 btn btn-outline-dark btn-block" href="login.php" role="button">Iniciar Sesión</a>
            </div>
        </div>
    </div>
</form>


<?php
include_once("../../estructura/pie.php");
?>