<?php
class AbmEstadoTipos
{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return EstadoTipos
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idestadotipos', $param) and array_key_exists('etdescripcion', $param) and array_key_exists('etactivo', $param)) {
            $obj = new EstadoTipos();
            $obj->setear($param['idestadotipos'], $param['etdescripcion'], $param['etactivo']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return EstadoTipos
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idestadotipos'])) {
            $obj = new EstadoTipos();
            $obj->setear($param['idestadotipos'], null, null);
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
        if (isset($param['idestadotipos']))
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
        $elObjtEstadoTipos = $this->cargarObjeto($param);
        //verEstructura($elObjtEstadoTipos);
        if ($elObjtEstadoTipos != null && $elObjtEstadoTipos->insertar()) {
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
            $elObjtEstadoTipos = $this->cargarObjetoConClave($param);
            if ($elObjtEstadoTipos != null && $elObjtEstadoTipos->eliminar()) {
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
            $elObjtEstadoTipos = $this->cargarObjeto($param);
            if ($elObjtEstadoTipos != null && $elObjtEstadoTipos->modificar()) {
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
            if (isset($param['idestadotipos']))
                $where .= " AND idestadotipos ='" . $param['idestadotipos'] . "'";
            if (isset($param['etdescripcion']))
                $where .= " AND etdescripcion ='" . $param['etdescripcion'] . "'";
            if (isset($param['etactivo']))
                $where .= " AND etactivo ='" . $param['etactivo'] . "'";
        }
        $arreglo = EstadoTipos::listar($where);
        return $arreglo;
    }
}
