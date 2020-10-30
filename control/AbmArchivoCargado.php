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
        if (array_key_exists('idarchivocargado', $param) and array_key_exists('acnombre', $param) and array_key_exists('acdescripcion', $param) and array_key_exists('acicono', $param) and array_key_exists('idusuario', $param) and array_key_exists('aclinkacceso', $param) and array_key_exists('accantidaddescarga', $param) and array_key_exists('accantidadusada', $param) and array_key_exists('acfechainiciocompartir', $param) and array_key_exists('acefechafincompartir', $param) and array_key_exists('acprotegidoclave', $param)) {
            $obj = new ArchivoCargado();
            $obj->setear($param['idarchivocargado'], $param['acnombre'], $param['acdescripcion'], $param['acicono'], $param['idusuario'], $param['aclinkacceso'], $param['accantidaddescarga'], $param['accantidadusada'], $param['acfechainiciocompartir'], $param['acefechafincompartir'], $param['acprotegidoclave']);
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
        if (isset($param['idarchivocargado'])) {
            $obj = new ArchivoCargado();
            $obj->setear($param['idarchivocargado'], null, null, null, null, null, null, null, null, null, null);
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
     * 
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        $archivo['idarchivocargado']=1;
        $archivo['acnombre']=$param['nombre'];
        $archivo['acdescripcion']=$param['descripcion'];
        $archivo['acicono']=$param['tipo'];
        $archivo['idusuario']=$param['usuario'];
        $archivo['aclinkacceso']="--";
        $archivo['accantidaddescarga']=0;
        $archivo['accantidadusada']=0;
        $archivo['acfechainiciocompartir']='0000-00-00';
        $archivo['acefechafincompartir']='0000-00-00';
        $archivo['acprotegidoclave']='--';
        $elObjtArchivoCargado = $this->cargarObjeto($archivo);
        //verEstructura($elObjtArchivoCargado);
        if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->insertar()) {
            $estado = new AbmArchivoCargadoEstado();
            $resp = $estado->alta($elObjtArchivoCargado);
        }
        return $resp;
    }

    public function modificarArchivo($param){
        $resp = false;
        $archivo = $this->setearDatos($param);
        if ($this->seteadosCamposClaves($archivo)) {
            $elObjtArchivoCargado = $this->cargarObjeto($archivo);
            if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->modificar()) {
                $modificar = new AbmArchivoCargadoEstado();
                $resp = $modificar->modificarArchivo($archivo);
            }
        }
        return $resp;
    }

    public function compartirArchivo($param)
    {
        $resp = false;
        $archivo = $this->setearDatos($param);
        if ($this->seteadosCamposClaves($archivo)) {
            $elObjtArchivoCargado = $this->cargarObjeto($archivo);
            if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->modificar()) {
                $modificar = new AbmArchivoCargadoEstado();
                $resp = $modificar->compartirArchivo($archivo);
            }
        }
        return $resp;
    }
    public function dejarCompartirArchivo($param)
    {
        $resp = false;
        $archivo = $this->setearDatos($param);
        if ($this->seteadosCamposClaves($archivo)) {
            $elObjtArchivoCargado = $this->cargarObjeto($archivo);
            if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->modificar()) {
                $modificar = new AbmArchivoCargadoEstado();
                $resp = $modificar->dejarCompartirArchivo($archivo);
            }
        }
        return $resp;
    }
    public function eliminarArchivo($param)
    {
       $resp = false;
       $archivo = $this->setearDatos($param);
        if ($this->seteadosCamposClaves($archivo)) {
            $elObjtArchivoCargado = $this->cargarObjeto($archivo);
            if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->modificar()) {
                $modificar = new AbmArchivoCargadoEstado();
                $resp = $modificar->eliminarArchivo($archivo);
            }
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
    /**
     * permite modificar un objeto
     * @param array $param
     * @return array
     */
    public function setearDatos($param)
    {
        $archivo['acnombre'] = $param['nombre'];
        $arreglo = $this->buscar($archivo);
        if (isset($param['descripcion'])) {
            $archivo['acdescripcion'] = $param['descripcion'];
        } else {
            $archivo['acdescripcion'] = $arreglo[0]->getAcDescripcion();
        }
        if (isset($param['tipo'])) {
            $archivo['acicono'] = $param['tipo'];
        } else {
            $archivo['acicono'] = $arreglo[0]->getAcIcono();
        }
        if (isset($param['usuario'])) {
            $archivo['idusuario'] = $param['usuario'];
        } else {
            $archivo['idusuario'] = $arreglo[0]->getObjUsuario()->getIdUsuario();
        }
        if (isset($param['enlace'])) {
            $archivo['aclinkacceso'] = $param['enlace'];
        } else {
            $archivo['aclinkacceso'] = $arreglo[0]->getAcLinkAcceso();
        }
        if (isset($param['descargas'])) {
            $archivo['accantidaddescarga'] = $param['descargas'];
        } else {
            $archivo['accantidaddescarga'] = $arreglo[0]->getAcCantidadDescarga();
        }
        if (isset($param['clave'])) {
            $archivo['acprotegidoclave'] = $param['clave'];
        } else {
            $archivo['acprotegidoclave'] = $arreglo[0]->getAcProtegidoClave();
        }
        if (isset($param['dias'])) {
            $fecha = date("Y-m-d");
            $archivo['acfechainiciocompartir'] = $fecha;
            if ($param['dias'] != 0) {
                $archivo['acefechafincompartir'] = date("Y-m-d", strtotime($fecha . "+ " . $param['dias'] . " days"));
            } else {
                $archivo['acefechafincompartir'] = '9999-99-99';
            }
        } else {
            $archivo['acfechainiciocompartir'] = $arreglo[0]->getAcFechaInicioCompartir();
            $archivo['acefechafincompartir'] = $arreglo[0]->getAceFechaFinCompartir();
        }
        return $archivo;
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
}
