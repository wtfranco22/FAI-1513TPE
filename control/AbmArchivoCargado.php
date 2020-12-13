<?php
class AbmArchivoCargado
{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * y asi con los valores del parametro devolvemos el objeto ArchivoCargado
     * @param array $param
     * @return ArchivoCargado
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idarchivocargado', $param) and array_key_exists('acnombre', $param)
            and array_key_exists('acdescripcion', $param) and array_key_exists('acicono', $param)
            and array_key_exists('objusuario', $param) and array_key_exists('aclinkacceso', $param)
            and array_key_exists('accantidaddescarga', $param) and array_key_exists('accantidadusada', $param)
            and array_key_exists('acfechainiciocompartir', $param) and array_key_exists('acefechafincompartir', $param)
            and array_key_exists('acprotegidoclave', $param)
        ) {
            $obj = new ArchivoCargado();
            $user = new Usuario();
            $user->setIdUsuario($param['objusuario']);
            $user->cargar();
            $obj->setear(
                $param['idarchivocargado'],
                $param['acnombre'],
                $param['acdescripcion'],
                $param['acicono'],
                $user,
                $param['aclinkacceso'],
                $param['accantidaddescarga'],
                $param['accantidadusada'],
                $param['acfechainiciocompartir'],
                $param['acefechafincompartir'],
                $param['acprotegidoclave']
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return ArchivoCargado
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idarchivo'])) {
            $obj = new ArchivoCargado();
            $obj->setear($param['idarchivo'], null, null, null, null, null, null, null, null, null, null);
            $obj->cargar();
        }
        return $obj;
    }

    /**
     * esperamos un arreglo asociativo con los valores ingresados por el usuario y luego
     * creamos un arreglo asociativo para tener todos los datos para crear un objeto y
     * reflejar este nuevo objeto en la base de datos
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        $archivo['idarchivocargado'] = 1;
        $archivo['acnombre'] = $param['nombre'];
        $archivo['acdescripcion'] = $param['descripcion'];
        $archivo['acicono'] = $param['tipo'];
        $archivo['objusuario'] = $param['usuario'];
        $archivo['aclinkacceso'] = "--";
        $archivo['accantidaddescarga'] = 0;
        $archivo['accantidadusada'] = 0;
        $archivo['acfechainiciocompartir'] = '0000-00-00 00:00:00';
        $archivo['acefechafincompartir'] = '0000-00-00 00:00:00';
        $archivo['acprotegidoclave'] = '--';
        $elObjtArchivoCargado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->insertar()) {
            //si no es nuelo y fue agregado a la base de datos, seguimos
            $param['idarchivocargado'] = $elObjtArchivoCargado->getIdArchivoCargado();
            $estado = new AbmArchivoCargadoEstado();
            $resp = $estado->alta($param);
        }
        return $resp;
    }

    /**
     * esperamos un arreglo asociativo con los valores ingresados por el usuario y luego
     * creamos un arreglo asociativo para tener todos los datos para cargar un objeto con el id y
     * reflejar esta modificacion del objeto en la base de datos
     * @param array $param
     * @return boolean
     */
    public function modificarArchivo($param)
    {
        $resp = false;
        $archivocargar = $this->cargarObjetoConClave($param);
        $archivo['idarchivocargado'] = $param['idarchivo'];
        $archivo['acnombre'] = $param['nombre'];
        $archivo['acdescripcion'] = $param['descripcion'];
        $archivo['acicono'] = $param['tipo'];
        $archivo['objusuario'] = $archivocargar->getObjUsuario()->getIdUsuario();
        $archivo['aclinkacceso'] = $archivocargar->getAcLinkAcceso();
        $archivo['accantidaddescarga'] = $archivocargar->getAcCantidadDescarga();
        $archivo['accantidadusada'] = $archivocargar->getAcCantidadUsada();
        $archivo['acfechainiciocompartir'] = $archivocargar->getAcFechaInicioCompartir();
        $archivo['acefechafincompartir'] = $archivocargar->getAceFechaFinCompartir();
        $archivo['acprotegidoclave'] = $archivocargar->getAcProtegidoClave();
        $elObjtArchivoCargado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->modificar()) {
            //si la modificacion tuvo exito en la BD entonces seguimos
            $modificar = new AbmArchivoCargadoEstado();
            $resp = $modificar->modificarArchivo($param);
        }
        return $resp;
    }

    /**
     * esperamos un arreglo asociativo con los valores ingresados por el usuario y luego
     * creamos un arreglo asociativo para tener todos los datos para cargar un objeto con el id y
     * reflejar esta modificacion de compartir del objeto en la base de datos
     * @param array $param
     * @return boolean
     */
    public function compartirArchivo($param)
    {
        $resp = false;
        $archivocargar = $this->cargarObjetoConClave($param);
        $archivo['idarchivocargado'] = $archivocargar->getIdArchivoCargado();
        $archivo['acnombre'] = $archivocargar->getAcNombre();
        $archivo['acdescripcion'] = $archivocargar->getAcDescripcion();
        $archivo['acicono'] = $archivocargar->getAcIcono();
        $archivo['objusuario'] = $archivocargar->getObjUsuario()->getIdUsuario();
        $archivo['aclinkacceso'] = $param['enlace'];
        $fecha = date("Y-m-d H:i:s");
        $archivo['acfechainiciocompartir'] = $fecha;
        if ($param['dias'] == 0)
            $archivo['acefechafincompartir'] = '0000-00-00 00:00:00';
        else
            $archivo['acefechafincompartir'] = date("Y-m-d H:i:s", strtotime($fecha . " + " . $param['dias'] . " days"));
        if ($param['descargas'] == 0)
            $archivo['accantidaddescarga'] = 0;
        else
            $archivo['accantidaddescarga'] = $param['descargas'];
        $archivo['accantidadusada'] = 0;
        $archivo['acprotegidoclave'] = $param['clave'];
        $elObjtArchivoCargado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->modificar()) {
            //si la modificacion tuvo exito en la BD entonces seguimos
            $compartir = new AbmArchivoCargadoEstado();
            $resp = $compartir->compartirArchivo($param);
        }
        return $resp;
    }

    /**
     * esperamos un arreglo asociativo con los valores ingresados por el usuario y luego
     * creamos un arreglo asociativo para tener todos los datos para cargar un objeto con el id y
     * reflejar esta modificacion de dejar de compartir del objeto en la base de datos
     * @param array $param
     * @return boolean
     */
    public function dejarCompartirArchivo($param)
    {
        $resp = false;
        $archivocargar = $this->cargarObjetoConClave($param);
        $archivo['idarchivocargado'] = $archivocargar->getIdArchivoCargado();
        $archivo['acnombre'] = $archivocargar->getAcNombre();
        $archivo['acdescripcion'] = $archivocargar->getAcDescripcion();
        $archivo['acicono'] = $archivocargar->getAcIcono();
        $archivo['objusuario'] = $archivocargar->getObjUsuario()->getIdUsuario();
        $archivo['aclinkacceso'] = $archivocargar->getAcLinkAcceso();
        $archivo['acfechainiciocompartir'] = $archivocargar->getAcFechaInicioCompartir();
        $archivo['acefechafincompartir'] = Date("Y-m-d H:i:s");
        $archivo['accantidaddescarga'] = $archivocargar->getAcCantidadDescarga();
        $archivo['accantidadusada'] = $archivocargar->getAcCantidadUsada();
        $archivo['acprotegidoclave'] = $archivocargar->getAcProtegidoClave();
        $elObjtArchivoCargado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->modificar()) {
            //si la modificacion tuvo exito en la BD entonces seguimos
            $dejarcompartir = new AbmArchivoCargadoEstado();
            $resp = $dejarcompartir->dejarCompartirArchivo($param);
        }
        return $resp;
    }
    /**
     * esperamos un arreglo asociativo con los valores ingresados por el usuario y luego
     * creamos un arreglo asociativo para tener todos los datos para cargar un objeto con el id y
     * reflejar esta modificacion de dejar de compartir del objeto en la base de datos
     * verificamos si el archivo estaba compartidos sino nos vamos a eliminar
     * @param array $param
     * @return boolean
     */
    public function eliminarArchivo($param)
    {
        $resp = false;
        $archivocargar = $this->cargarObjetoConClave($param);
        $estadoArchivo = new AbmArchivoCargadoEstado();
        if (($estadoArchivo->archivosTipo(['archivos' => 'compartidos', 'idarchivocargado' => $param['idarchivo']])) != []) {
            //preguntamos si el estado del archivo era compartido, para dejar de compartir y despues eliminar
            $datos['idarchivo'] = $param['idarchivo'];
            $datos['motivo'] = 'Se dejo de compartir porque el usuario seleciono eliminar el archivo';
            $this->dejarCompartirArchivo($datos);
        }
        $resp = $estadoArchivo->eliminarArchivo($param);
        return $resp;
    }

    /**
     * permite buscar un objeto a traves de cualquier valor ingresado por parametro
     * y retornamos un arreglo si son muchos objetos o solo uno 
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param <> null) {
            if (isset($param['idarchivocargado']))
                $where .= " AND idarchivocargado ='" . $param['idarchivocargado'] . "'";
            if (isset($param['acnombre']))
                $where .= " AND acnombre ='" . $param['acnombre'] . "'";
            if (isset($param['acdescripcion']))
                $where .= " AND acdescripcion ='" . $param['acdescripcion'] . "'";
            if (isset($param['acicono']))
                $where .= " AND acicono ='" . $param['acicono'] . "'";
            if (isset($param['idusuario']))
                $where .= " AND idusuario ='" . $param['idusuario'] . "'";
            if (isset($param['aclinkacceso']))
                $where .= " AND aclinkacceso ='" . $param['aclinkacceso'] . "'";
            if (isset($param['accantidaddescarga']))
                $where .= " AND accantidaddescarga ='" . $param['accantidaddescarga'] . "'";
            if (isset($param['accantidadusada']))
                $where .= " AND accantidadusada ='" . $param['accantidadusada'] . "'";
            if (isset($param['acfechainiciocompartir']))
                $where .= " AND acfechainiciocompartir ='" . $param['acfechainiciocompartir'] . "'";
            if (isset($param['acefechafincompartir']))
                $where .= " AND acefechafincompartir='" . $param['acefechafincompartir'] . "'";
            if (isset($param['acprotegidoclave']))
                $where .= " AND acprotegidoclave ='" . $param['acprotegidoclave'] . "'";
        }
        $arreglo = ArchivoCargado::listar($where);
        return $arreglo;
    }

    /**
     * se encargar de devolver el archivo solamente si esta habilitado para compartir
     * comparamos primero con la cantidad de descargar si esta disponible, luego con el 
     * limite de los dias, si esta todo bien habilitamos el ArchivoCargado y lo retornamos
     * Si justo coincide que es la ultima descarga segundo la cantidad de descargas posibles
     * dejamos de compartir el archivo y cambiamos su estado
     * @return boolean
     */
    public function habilitadoCompartir($param)
    {
        $res = null;
        $archivo = $this->buscar($param);
        if ($archivo[0] != null && file_exists("../compartidos/" . $archivo[0]->getAcNombre())) {
            //primero ante todo, verificamos que el archivo exista en la carpeta exclusiva de compartidos
            $elObjtArchivoCargado = $archivo[0];
            if (($elObjtArchivoCargado->getAcCantidadUsada() + 1) <= $elObjtArchivoCargado->getAcCantidadDescarga() || $elObjtArchivoCargado->getAcCantidadDescarga() == 0) {
                //preguntamos si esta disponible la cantidad de descargas
                if ($elObjtArchivoCargado->getAceFechaFinCompartir() == '0000-00-00 00:00:00') {
                    //preguntamos si es ilimitada la fecha de compartir
                    $elObjtArchivoCargado->setAcCantidadUsada($elObjtArchivoCargado->getAcCantidadUsada() + 1);
                    $res[] = $elObjtArchivoCargado;
                    $elObjtArchivoCargado->modificar();
                } elseif ($elObjtArchivoCargado->getAcFechaInicioCompartir() <= $elObjtArchivoCargado->getAceFechaFinCompartir()) {
                    //preguntamos si esta dentro de los dias habilitados para compartir el archivo
                    $elObjtArchivoCargado->setAcCantidadUsada($elObjtArchivoCargado->getAcCantidadUsada() + 1);
                    $res[] = $elObjtArchivoCargado;
                    $elObjtArchivoCargado->modificar();
                }else{
                    //en este caso llegamos xq aun esta el archivo compartido pero no ha cambiado el estado y se ha excedido los dias habiles de compartido
                    $datos['idarchivo'] = $elObjtArchivoCargado->getIdArchivoCargado();
                    $datos['motivo'] = 'Se ha completado la cantidad de días compartidos';
                    $this->dejarCompartirArchivo($datos);
                }
                if ($elObjtArchivoCargado->getAcCantidadUsada() == $elObjtArchivoCargado->getAcCantidadDescarga()) {
                    //en este caso preguntamos si es igual ya que seria la ultima descarga posible y cambiamos su estado
                    $datos['idarchivo'] = $elObjtArchivoCargado->getIdArchivoCargado();
                    $datos['motivo'] = 'Se ha completado la cantidad de descargas posibles';
                    $this->dejarCompartirArchivo($datos);
                }
            }
        }
        return $res;
    }
}
