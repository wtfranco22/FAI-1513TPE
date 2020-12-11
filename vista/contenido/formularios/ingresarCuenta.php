<?php
include_once("../../estructura/cabecera.php");
if ($comienzaSesion->activa()) {
    //esta pagina solo se vera si no esta iniciada la sesion, caso contrario mandamos a la principal
    header("Location:contenido.php");
    die();
} ?>

<form class="row justify-content-around" id="ingresarCuenta" name="ingresarCuenta" onsubmit="return encriptarPass('clave')" method="POST" action="../acciones/accionLogin.php" data-toggle="validator" autocomplete="off">
    <div class="bg-dark p-4 m-5 shadow">
        <div class="bg-light p-5">
            <h1 class="text-center m-5">Iniciar sesión</h1>
            <div class="form-group">
                <input type="text" id="usuario" name="usuario" class="form-control shadow" placeholder="&#xf007; Usuario">
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="password" id="clave" name="clave" class="form-control shadow" placeholder="&#xf023; Contraseña">
                    <button type="button" id="ojo" class="btn btn-dark fa fa-eye-slash" onclick="mostrarClave('clave')"></button>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-success btn-block shadow">Iniciar sesión</button>
                <a class="btn btn-outline-dark btn-block" href="crearCuenta.php" role="button">Registrarse</a>
            </div>
            <div>
                <a class="text-center" href="recuperarCuenta.php">¿Olvidaste tu contraseña?</a>
            </div>
        </div>
    </div>
</form>

<script src="../../../botman/widget.js" type="text/javascript"></script>
<!--BOTMAN solo lo utilizamos para ingresar el link de un archivo compartido-->
<script type="text/javascript">
    var botmanWidget = {
        frameEndpoint: '../../../botman/chat.html', // configuraciones del entorno de vista
        introMessage: 'Hola! Tenes el código?SI/NO', //saludo inicial
        chatServer: 'botman.php', //es el bot con el que vamos a ir trabajando aca mismo en la web
        title: 'Buscar Archivo', //titulo del chat
        placeholderText: 'Enviar mensaje...',
        displayMessageTime: false, //decidimos si mostrar la hora del mensaje 
        mainColor: '#006CE0', //encabezado
        bubbleAvatarUrl: URL = ("../../../botman/fondo.png"), //logo de la burbuja
        aboutText: '@Wtfranco',
    };
</script>

<?php
include_once("../../estructura/pie.php");
?>