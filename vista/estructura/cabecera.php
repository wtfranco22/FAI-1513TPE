<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practicos Programacion Web dinámica</title>
    <link rel="stylesheet" type="text/css" href="/FAI-1513TPE/vista/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/FAI-1513TPE/vista/css/bootstrapValidator.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
    <script src="/FAI-1513TPE/ckeditor5/ckeditor.js"></script>
    <style type="text/css">
        /*Como son unas lineas de codigo, los deje para variar un poco los iconos*/
        .fa-thumbs-up {
            color: green;
        }

        .fa-thumbs-down {
            color: red;
        }

        .placeicon {
            font-family: fontawesome;
            font-style: normal;
            font-weight: normal;
            text-decoration: inherit;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark text-center bg-dark shadow">
        <h3 class="col-12 text-white">Esta es la cabecera</h3>
        <button class="navbar-toggler position-absolute d-md-none bg-primary collapsed" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container-fluid bg-primary">
        <?php
        include_once("lateral.php");
        ?>