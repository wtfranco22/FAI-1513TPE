<?php
include_once("../../estructura/cabecera.php");
if ($comienzaSesion->activa()) {
    header("Location:contenido.php");
    die();
} ?>
<!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#descarga">Descargar un archivo</button>
<div class="modal fade bd-example-modal-lg" id="descarga" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Descarga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="descargaPorLink" name="descargaPorLink" method="POST" action="../acciones/accionDescargaPorLink.php" data-toggle="validator" autocomplete="off">
                    <div class="form-group">
                        <input type="text" id="linkAcceso" name="linkAcceso" class="form-control shadow" placeholder="&#xf0c1; link del archivo">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="protegerpass" name="protegerpass" data-toggle="collapse" data-target="#ingresarclave">
                        <label class="form-check-label" for="protegerpass">contraseña</label>
                    </div>
                    <div id="ingresarclave" class="form-group collapse">
                        <div class="input-group">
                            <input type="password" class="form-control shadow" id="clave2" name="clave2" placeholder="&#xf023; Contraseña">
                            <button type="button" id="ojo" class="btn btn-dark fa fa-eye-slash" onclick="mostrarClave('clave2')"></button>
                        </div>
                        <p id="aviso"></p>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success btn-block shadow">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>-->
<form class="row justify-content-around" id="ingresarCuenta" name="ingresarCuenta" method="POST" action="../acciones/accionLogin.php" data-toggle="validator" autocomplete="off">
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
                <button type="submit" class="btn btn-success btn-block shadow" onclick="encriptarPass('clave')">Iniciar sesión</button>
                <a class="btn btn-outline-dark btn-block" href="crearCuenta.php" role="button">Registrarse</a>
            </div>
        </div>
    </div>
</form>
<script src="../../../botman/widget.js" type="text/javascript"></script>
<script type="text/javascript">
    var botmanWidget = {
        frameEndpoint: '../../../botman/chat.html', // configuraciones del entorno de vista
        introMessage: 'Hola! Tenes el código?', //saludo inicial
        chatServer: 'botman.php', //es el bot con el que vamos a ir trabajando aca mismo en la web
        title: 'Buscar Archivo', //titulo del chat
        //dateTimeFormat: 'Y-m-d H:i:s', //formato con el cual trabajaremos
        placeholderText: 'Enviar mensaje...',
        displayMessageTime: false, //decidimos si mostrar la hora del mensaje 
        mainColor: '#006CE0', //encabezado
        //bubbleBackground: 'blue', //burbuja 
        bubbleAvatarUrl: URL = ("../../../botman/fondo.png"), //logo de la burbuja
        aboutText: '@Wtfranco',
    };
</script>
<?php
include_once("../../estructura/pie.php");
?>