<?php
class Archivo
{
    public function alta($datos)
    {
        $nombre = $datos["nombre"];
        $descripcion = $datos["descripcion"];
        $usuario = $datos["usuario"];
        $tipo = $datos["tipo"];
        $res = "<h4>DATOS:</h4>" .
            "<b>Nombre</b>: " . $nombre . "<br>" .
            "<b>Descripción</b>: " . $descripcion . "<br>" .
            "<b>Usuario</b>: " . $usuario . "<br>" .
            "<b>Tipo de archivo</b>: " . $tipo . "<br>";
        $error = "";
        $dir = '../archivos/';
        if ($_FILES['archivo']['error'] <= 0) {
            $tipo = $_FILES['archivo']['type'];
            $tam = $_FILES['archivo']['size'];
            if ($tam < 2097153) {
                $temp = $_FILES['archivo']['tmp_name'];
                if (copy($temp, $dir . $_FILES['archivo']['name'])) {
                    $nombre = $_FILES['archivo']['name'];
                    $res .= "<h4>ARCHIVO:</h4>" .
                        "<b>Nombre</b>: " . $nombre . "<br>" .
                        "<b>Tipo</b>: " . $tipo . "<br>" .
                        "<b>Tamaño</b>: " . $tam . "MB<br>" .
                        "<b>Carpeta temporal</b>: " . $temp . "<br>" .
                        "Se ha copiado con exito en " . $dir . $nombre . "<br><br>";
                    $agregarArchivo = new AbmArchivoCargado();
                    if ($agregarArchivo->alta($datos)) {
                        $res .= "Guardado en la BD con exito <br>";
                    } else {
                        $res .= "No ingreso a la BD";
                    }
                } else {
                    $error = "ERROR: no se pudo copiar el archivo<br>";
                }
            } else {
                $error = "El archivo es demasiado grande<br>";
            }
        } else {
            $error = "ERROR: no se puedo cargar<br>";
        }
        if ($error != "") {
            $res = $error;
        } else {
            $res .= "Se ha creado de manera correcta";
        }
        return $res;
    }

    public function modificacion($datos)
    {
        $nombre = $datos["nombre"];
        $descripcion = $datos["descripcion"];
        $usuario = $datos["usuario"];
        $tipo = $datos["tipo"];
        $archivoModificar = new AbmArchivoCargado();
        if ($archivoModificar->modificarArchivo($datos)) {
            $res = "<h4>DATOS:</h4>" .
                "<b>Nombre</b>:" . $nombre . "<br>" .
                "<b>Descripción</b>: " . $descripcion . "<br>" .
                "<b>Usuario</b>: " . $usuario . "<br>" .
                "<b>Tipo de archivo</b>: " . $tipo . "<br>" .
                "Se ha modificado de manera correcta";
        } else {
            $res = "No se ha realido ningun cambio";
        }
        return $res;
    }

    public function compartirarchivo($datos)
    {
        $nombre = $datos["nombre"];
        $cantDias = $datos["dias"];
        $descargas = $datos["descargas"];
        $usuario = $datos["usuario"];
        $clave = $datos["clave"];
        $enlace = $datos["enlace"];
        if ($cantDias == 0) {
            $cantDias = "No expira";
        }
        if ($descargas == 0) {
            $descargas = "Sin limite";
        }
        if ($clave != "null") {
            $protegerPass = "Si, con clave \"" . $clave . "\" ";
        } else {
            $protegerPass = "No";
        }
        $res =
            "<b>Nombre</b>: " . $nombre . "<br>" .
            "<b>Cantidad de días compartido</b>: " . $cantDias . "<br>" .
            "<b>Cantidad de descargas</b>: " . $descargas . "<br>" .
            "<b>Usuario</b>: " . $usuario . "<br>" .
            "<b>Protegido con clave</b>: " . $protegerPass . "<br>" .
            "<b>Link de compartir</b>: " . $enlace . "<br>";
        $compartirarchivo = new AbmArchivoCargado();
        if ($compartirarchivo->compartirArchivo($datos)) {
            $res .= "Se han registrado los cambios en la BD <br>";
        } else {
            $res .= "No se han registrado los cambios en la BD <br>";
        }
        return $res;
    }

    public function eliminararchivocompartido($datos)
    {
        $nombre = $datos["nombre"];
        $cantVeces = $datos["cantveces"];
        $motivo = $datos["motivo"];
        $usuario = $datos["usuario"];
        $res =
            "<b>Nombre</b>: " . $nombre . "<br>" .
            "<b>Cantidad de veces compartido</b>: " . $cantVeces . "<br>" .
            "<b>Motivo de dejar de compartir</b>: " . $motivo . "<br>" .
            "<b>Usuario</b>: " . $usuario . "<br>";
        $eliminarcompartido = new AbmArchivoCargado();
        if ($eliminarcompartido->dejarCompartirArchivo($datos)) {
            $res .= "Se dejo de compartir con exito <br>";
        } else {
            $res .= "No se realizo con exito <br>";
        }
        return $res;
    }

    public function eliminararchivo($datos)
    {
        $nombre = $datos["nombre"];
        $motivo = $datos["motivo"];
        $usuario = $datos["usuario"];
        $res =
            "<b>Nombre</b>: " . $nombre . "<br>" .
            "<b>Motivo de eliminación</b>: " . $motivo . "<br>" .
            "<b>Usuario</b>: " . $usuario . "<br>";
        $eliminar = new AbmArchivoCargado();
        if ($eliminar->eliminarArchivo($datos)) {
            $res .= "Se elimino con exito <br>";
        } else {
            $res .= "Se elimino con exito <br>";
        }
        return $res;
    }

    public function crearCarpeta($datos)
    {
        $nombreNuevaCarpeta = $datos["nombreCarpeta"];
        $directorio = "../archivos/";
        if (!is_dir($directorio . $nombreNuevaCarpeta)) {
            mkdir($directorio . $nombreNuevaCarpeta);
            $res = "<b>Se ha creado una nueva carpeta en " . $directorio . $nombreNuevaCarpeta . "</b><br>";
        } else {
            $res = "<b>Ya existe la carpeta " . $nombreNuevaCarpeta . " en " . $directorio . "</b><br>";
        }
        return $res;
    }

    public function traerArchivos($datos)
    {
        $buscar = "";
        if (array_key_exists('archivos', $datos))
            $buscar = $datos['archivos'];
        switch ($buscar) {
            case 'cargados':
                $condicion['idestadotipos'] = 1;
                break;
            case 'compartidos':
                $condicion['idestadotipos'] = 2;
                break;
            case 'nocompartidos':
                $condicion['idestadotipos'] = 3;
                break;
            case 'eliminados':
                $condicion['idestadotipos'] = 4;
                break;
            case 'desactivados':
                $condicion['idestadotipos'] = 5;
                break;
            default:
                $condicion = null;
                break;
        }
        $traerArchivos = new AbmArchivoCargadoEstado();
        $arreglo = $traerArchivos->buscar($condicion);
        return $arreglo;
    }
}
