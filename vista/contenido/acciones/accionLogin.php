<?php
include_once("../../estructura/cabecera.php");

/*
    EXISTE este accion por el motivo que encriptamos en cliente con js y despues en servidor,
    no sabemos si la contraseña coincide hasta consultar en la BD, y en este script podemos
    diseñar un mensaje de exito o error
*/


$datos = data_submitted(); //siempre recolectamos los datos de un formulario de esta manera para no examinar si usamos $_GET o $_POST
/*
         * Este validar es de clase SESSION, si es valido, creamos el arreglo $_SESSION
         * sino, no es necesario guardar datos en $_SESSION para mayor seguridad
*/

if ($comienzaSesion->validar($datos)) {
    header("Location:../formularios/contenido.php?archivos=cargados");
} else {
    echo '<script> alert("Error de autentificacion"); window.location.href="../formularios/ingresarCuenta.php"</script>';
}



include_once("../../estructura/pie.php");
?>