<!DOCTYPE html>
<html lang="es">
<?php
include_once("../../../configuracion.php");
$comienzaSesion = new Session(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practicos Programacion Web dinámica</title>
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrapValidator.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
    <script src="../../../ckeditor5/ckeditor.js"></script>
    <style type="text/css">
        /*Como son unas lineas de codigo, los deje para variar un poco los iconos*/
        .fa-thumbs-up {
            color: green;
        }

        .fa-thumbs-down {
            color: red;
        }

        #encabezado {
            margin-left: 70px;
        }

        * {
            font-family: fontawesome;
            font-style: normal;
            font-weight: normal;
            text-decoration: inherit;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark shadow">
        <h4 id="encabezado" class="text-white">
            Bienvenid@
            <?php if ($comienzaSesion->activa()) {
                echo $comienzaSesion->getLoginUsuario();
            } ?>
        </h4>
        <?php if ($comienzaSesion->activa()) : ?>
            <button class="navbar-toggler position-absolute d-md-none bg-success collapsed" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <?php endif; ?>
    </nav>
    <div class="container-fluid bg-success">
        <?php
        if ($comienzaSesion->activa()) {
            include_once("lateral.php");
        }
        if (isset($_GET['cerrar'])) {
            $comienzaSesion->cerrar();
            header("Location:ingresarCuenta.php");
        }
        ?>