<?php
class AbmArchivoCargado
{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return ArchivoCargado
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idarchivocargado', $param) and array_key_exists('acnombre', $param)
            and array_key_exists('acdescripcion', $param) and array_key_exists('acicono', $param) and
            array_key_exists('objusuario', $param) and array_key_exists('aclinkacceso', $param) and
            array_key_exists('accantidaddescarga', $param) and array_key_exists('accantidadusada', $param)
            and array_key_exists('acfechainiciocompartir', $param) and
            array_key_exists('acefechafincompartir', $param) and
            array_key_exists('acprotegidoclave', $param)
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
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idarchivocargado']))
            $resp = true;
        return $resp;
    }

    /**
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
        $archivo['acfechainiciocompartir'] = '0000-00-00';
        $archivo['acefechafincompartir'] = '0000-00-00';
        $archivo['acprotegidoclave'] = '--';
        $elObjtArchivoCargado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->insertar()) {
            $param['idarchivocargado'] = $elObjtArchivoCargado->getIdArchivoCargado();
            $estado = new AbmArchivoCargadoEstado();
            $resp = $estado->alta($param);
        }
        return $resp;
    }

    /**
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
            $modificar = new AbmArchivoCargadoEstado();
            $resp = $modificar->modificarArchivo($param);
        }
        return $resp;
    }

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
        if ($param['dias'] != 0)
            $archivo['acefechafincompartir'] = date("Y-m-d H:i:s", strtotime($fecha . "+ " . $param['dias'] . " days"));
        else
            $archivo['acefechafincompartir'] = '2038-01-19 03:14:07'; //mayor posibilidad de timestamp
        if ($param['descargas'] == 0)
            $archivo['accantidaddescarga'] = 2147483648; //mayor valor con numero negativo
        else
            $archivo['accantidaddescarga'] = $param['descargas'];
        $archivo['accantidadusada'] = $archivocargar->getAcCantidadUsada();
        $archivo['acprotegidoclave'] = $param['clave'];
        if ($this->seteadosCamposClaves($archivo)) {
            $elObjtArchivoCargado = $this->cargarObjeto($archivo);
            if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->modificar()) {
                $compartir = new AbmArchivoCargadoEstado();
                $resp = $compartir->compartirArchivo($param);
            }
        }
        return $resp;
    }
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
        $archivo['accantidaddescarga'] = $archivocargar->getIdArchivoCargado();
        $archivo['accantidadusada'] = $param['cantveces'];
        $archivo['acprotegidoclave'] = $archivocargar->getAcProtegidoClave();
        $elObjtArchivoCargado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->modificar()) {
            $dejarcompartir = new AbmArchivoCargadoEstado();
            $resp = $dejarcompartir->dejarCompartirArchivo($param);
        }
        return $resp;
    }
    /**
     * @param array $param
     * @return array
     */
    public function eliminarArchivo($param)
    {
        $resp = false;
        $archivocargar = $this->cargarObjetoConClave($param);
        $archivo['idarchivocargado'] = $param['idarchivo'];
        $archivo['acnombre'] = $archivocargar->getAcNombre();
        $archivo['acdescripcion'] = $archivocargar->getAcDescripcion();
        $archivo['acicono'] = $archivocargar->getAcIcono();
        $archivo['objusuario'] = $param['usuario'];
        $archivo['aclinkacceso'] = $archivocargar->getAcLinkAcceso();
        $archivo['acfechainiciocompartir'] = $archivocargar->getAcFechaInicioCompartir();
        $archivo['acefechafincompartir'] = $archivocargar->getAceFechaFinCompartir();
        $archivo['accantidaddescarga'] = $archivocargar->getAcCantidadDescarga();
        $archivo['accantidadusada'] = $archivocargar->getAcCantidadUsada();
        $archivo['acprotegidoclave'] = $archivocargar->getAcProtegidoClave();
        $elObjtArchivoCargado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->modificar()) {
            $dejarcompartir = new AbmArchivoCargadoEstado();
            $resp = $dejarcompartir->eliminarArchivo($param);
        }
        return $resp;
    }
    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtArchivoCargado = $this->cargarObjetoConClave($param);
            if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function archivosTipo($param)
    {
        $buscar = $param['archivos'];
        switch ($buscar) {
            case 'cargados':
                $condicion = 1;
                break;
            case 'compartidos':
                $condicion = 2;
                break;
            case 'nocompartidos':
                $condicion = 3;
                break;
            case 'eliminados':
                $condicion = 4;
                break;
            case 'desactivados':
                $condicion = 5;
                break;
            default:
                $condicion = null;
                break;
        }
        $archivos = $this->buscar($param);
        $archivosDeUntipo = [];
        foreach($archivos as $archivo){
            $tiposDelArchivo= $archivo->getModificacionesArchivo();
            $ultimaModificacion = array_pop($tiposDelArchivo);
            if($ultimaModificacion->getObjEstadoTipos()->getIdEstadoTipos()==$condicion){
                $archivosDeUntipo[]=$ultimaModificacion;
            }
        }
        return $archivosDeUntipo;
    }
    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
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
     * se encargar de devolver el archivo solamente si esta habilitado
     * @return boolean
     */
    public function buscarArchivo($param){
        $res = [];
        $arreglo = $this->buscar($param);
        $elObjtArchivoCargado = $arreglo[0];
        if($elObjtArchivoCargado->getAceFechaFinCompartir()=='0000-00-00 00:00:00'){
            $res[]=$elObjtArchivoCargado;
        }else{
            if($elObjtArchivoCargado->getAcFechaInicioCompartir()<$elObjtArchivoCargado->getAceFechaFinCompartir()){
                $res[]=$elObjtArchivoCargado;
            }
        }
        return $res;
    }
}
