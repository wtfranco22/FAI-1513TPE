<?php
include_once("../../estructura/cabecera.php");
if ($comienzaSesion->activa()) {
    //una sesion activa no puede leer esta pagina
    header("Location:ingresarCuenta.php");
    die();
}
?>

<form class="row justify-content-around" id="recuperarCuenta" name="recuperarCuenta" method="POST" action="../acciones/accionRecuperarCuenta.php" data-toggle="validator" autocomplete="off">
    <!--CAMPOS | login | correo | solicitamos login y correo para comparar en la bd si existen y podemos volver a iniciar sesion-->
    <div class="bg-dark p-4 m-5 shadow">
        <div class="bg-light p-5">
            <h1 class="text-center m-5">Recuperando Cuenta</h1>
            <div class="form-group">
                <input type="text" id="login" name="login" class="form-control shadow" placeholder="&#xf007; Login único del usuario">
            </div>
            <div class="form-group">
                <input type="text" id="correo" name="correo" class="form-control shadow" placeholder="Correo">
            </div>
            <div>
                <button type="submit" class="btn btn-success btn-block shadow">Enviar</button>
                <a class="btn btn-outline-dark btn-block" href="ingresarCuenta.php" role="button">Iniciar Sesión</a>
            </div>
        </div>
    </div>
</form>

<?php
include_once("../../estructura/pie.php");
?>