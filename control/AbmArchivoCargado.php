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
        $elObjtArchivoCargado = $this->cargarObjeto($param);
        //verEstructura($elObjtArchivoCargado);
        if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->insertar()) {
            $resp = true;
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
     * @return boolean
     */
    public function modificacion($param)
    {
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtArchivoCargado = $this->cargarObjeto($param);
            if ($elObjtArchivoCargado != null && $elObjtArchivoCargado->modificar()) {
                $resp = true;
            }
        }
        return $resp;
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
