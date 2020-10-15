<?php
function mostrarCarpeta($ruta, &$res,&$nivel)
{
    // Se comprueba que realmente sea la ruta de un directorio
    if (is_dir($ruta)) {
        // Abre un gestor de directorios para la ruta indicada
        $gestor = opendir($ruta);
        // Recorre todos los elementos del directorio
        while (($archivo = readdir($gestor)) !== false) {
            $ruta_completa = $ruta . "/" . $archivo;
            // Se muestran todos los archivos y carpetas excepto "." y ".."
            if ($archivo != "." && $archivo != "..") {
                // Si es un directorio se recorre recursivamente
                if (is_dir($ruta_completa)) {
                    $nivel++;
                    $res[] = ["elemento" => "carpeta", "ruta" => $ruta_completa, "nombre" => $archivo,"nivel"=>$nivel];
                    mostrarCarpeta($ruta_completa, $res,$nivel);
                } else {
                    $res[] = ["elemento" => "archivo", "ruta" => $ruta_completa, "nombre" => $archivo,"nivel"=>$nivel];
                }
            }
        }
        $nivel--;
        closedir($gestor);
    }
}


class archivo
{

    public function alta($datos)
    {
        $nombre = $datos["nombre"];
        $ubicacion=$datos["ubicacion"];
        $descripcion = $datos["descripcion"];
        $usuario = $datos["usuario"];
        $tipo = $datos["tipo"];
        $res = "<h4>DATOS:</h4>" .
            "<b>Nombre</b>: " . $nombre . "<br>" .
            "<b>Descripción</b>: " . $descripcion . "<br>" .
            "<b>Usuario</b>: " . $usuario . "<br>" .
            "<b>Tipo de archivo</b>: " . $tipo . "<br>";
        $error = "";
        $dir = '\\XAMPP\htdocs\FAI-1513TPE\archivos\\';
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
                        "<b>FUTURA UBICACION</b> :". $ubicacion ." (proximo intento)<br>".
                        "Se ha copiado con exito en " . $dir . $nombre;
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
        $ubicacion = $datos["ubicacion"];
        $descripcion = $datos["descripcion"];
        $usuario = $datos["usuario"];
        $tipo = $datos["tipo"];
        $res = "<h4>DATOS:</h4>" .
            "<b>Nombre</b>:" . $nombre . "<br>" .
            "<b>Ubicacion</b>: " . $ubicacion . "(proximo intento)<br>" .
            "<b>Descripción</b>: " . $descripcion . "<br>" .
            "<b>Usuario</b>: " . $usuario . "<br>" .
            "<b>Tipo de archivo</b>: " . $tipo . "<br>" .
            "Se ha modificado de manera correcta";
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
        if ($cantDias == 0 || $cantDias == "null") {
            $cantDias = "No expira";
        }
        if ($descargas == "null") {
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
        return $res;
    }

    public function eliminararchivocompartido($datos)
    {
        $nombre = $datos["nombre"];
        $ubicacion = $datos["ubicacion"];
        $cantVeces = $datos["cantveces"];
        $motivo = $datos["motivo"];
        $usuario = $datos["usuario"];
        $res =
            "<b>Nombre</b>: " . $nombre . "<br>" .
            "<b>Ubicacion</b>: " . $ubicacion . "<br>" .
            "<b>Cantidad de veces compartido</b>: " . $cantVeces . "<br>" .
            "<b>Motivo de dejar de compartir</b>: " . $motivo . "<br>" .
            "<b>Usuario</b>: " . $usuario . "<br>";
        return $res;
    }

    public function eliminararchivo($datos)
    {
        $nombre = $datos["nombre"];
        $motivo = $datos["motivo"];
        $ubicacion=$datos["ubicacion"];
        $usuario = $datos["usuario"];
        $res =
            "<b>Nombre</b>: " . $nombre . "<br>" .
            "<b>Ubicacion</b>: " . $ubicacion. "<br>" .
            "<b>Motivo de eliminación</b>: " . $motivo . "<br>" .
            "<b>Usuario</b>: " . $usuario . "<br>";
        return $res;
    }

    public function subirarchivo($datos)
    {
        $error = "";
        $dir = '\\XAMPP\htdocs\FAI-1513TPE\archivos\\';
        if ($_FILES['archivo']['error'] <= 0) {
            $tipo = $_FILES['archivo']['type'];

            if ($tipo == "application/pdf" || $tipo == "application/msword") {
                $tam = $_FILES['archivo']['size'];

                if ($tam < 2097153) {
                    $temp = $_FILES['archivo']['tmp_name'];
                    if (copy($temp, $dir . $_FILES['archivo']['name'])) {
                        $nombre = $_FILES['archivo']['name'];
                        $res = "<b>Nombre</b>: " . $nombre . "<br>" .
                            "<b>Tipo</b>: " . $tipo . "<br>" .
                            "<b>Tamaño</b>: " . $tam . "MB<br>" .
                            "<b>Carpeta temporal</b>: " . $temp . "<br>" .
                            "Se ha copiado con exito en " . $dir . $nombre;
                    } else {

                        $error = "ERROR: no se pudo copiar el archivo<br>";
                    }
                } else {

                    $error = "El archivo es demasiado grande<br>";
                }
            } else {

                $error = "El archivo no es .pdf o .doc <br>";
            }
        } else {

            $error = "ERROR: no se puedo cargar<br>";
        }
        if ($error != "") {
            $res = $error;
        }
        return $res;
    }

    public function leerarchivo()
    {
        $dir = '\\XAMPP\htdocs\FAI-1513TPE\archivos\\';
        $res["contenido"] = "Sin Leer archivo";
        if ($_FILES['archivo']['error'] <= 0) {
            $tipo = $_FILES['archivo']['type'];

            if ($tipo == "text/plain") {
                $temp = $_FILES['archivo']['tmp_name'];

                if (copy($temp, $dir . $_FILES['archivo']['name'])) {
                    $nombre = $_FILES['archivo']['name'];
                    $tam = $_FILES['archivo']['size'];
                    $res["detalles"] = "Nombre: " . $nombre . "<br>" .
                        "Tipo: " . $tipo . "<br>" .
                        "Tamaño: " . $tam . "<br>" .
                        "Carpeta temporal: " . $temp . "<br>" .
                        "Se ha copiado con exito en " . $dir . $nombre . "<br>";
                    $res["contenido"] = "\nContenido:\n\n" . file_get_contents($dir . $nombre);
                } else {

                    $res["detalles"] = "ERROR: no se pudo copiar el archivo";
                }
            } else {

                $res["detalles"] = "El archivo no es un .txt <br>";
            }
        } else {
            $res["detalles"] = "ERROR: no se puedo cargar, no se pudo acceder al archivo temporal";
        }
        return $res;
    }

    public function crearCarpeta($datos)
    {
        $nombreNuevaCarpeta = $datos["nombreCarpeta"];
        $directorio = $datos["ubicacion"];
        if (!is_dir($directorio . $nombreNuevaCarpeta)) {
            mkdir($directorio . $nombreNuevaCarpeta);
            $res = "<b>Se ha creado una nueva carpeta en " . $directorio . $nombreNuevaCarpeta."</b><br>";
        } else {
            $res = "<b>Ya existe la carpeta " . $nombreNuevaCarpeta . " en " . $directorio."</b><br>";
        }
        return $res;
    }
}
