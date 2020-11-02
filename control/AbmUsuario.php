<?php
class AbmUsuario
{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Usuario
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idusuario', $param) && array_key_exists('usapellido', $param) && array_key_exists('usnombre', $param) && array_key_exists('uslogin', $param) && array_key_exists('usclave', $param) AND array_key_exists('usactivo', $param)) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], $param['usapellido'], $param['usnombre'], $param['uslogin'], $param['usclave'], $param['usactivo']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los usnombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Usuario
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idusuario'])) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], null, null, null, null, null);
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
        if (isset($param['idusuario']))
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
        $elObjtUsuario = $this->cargarObjeto($param);
        //verEstructura($elObjtUsuario);
        if ($elObjtUsuario != NULL && $elObjtUsuario->insertar()) {
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
            $elObjtUsuario = $this->cargarObjetoConClave($param);
            if ($elObjtUsuario != null and $elObjtUsuario->eliminar()) {
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
            $elObjtUsuario = $this->cargarObjeto($param);
            if ($elObjtUsuario != null && $elObjtUsuario->modificar()) {
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
        if ($param <> NULL) {
            if (isset($param['idusuario']))
                $where .= " AND idusuario = '" . $param['idusuario']."'";
            if (isset($param['usapellido']))
                $where .= " AND usApellido ='" . $param['usapellido'] . "'";
            if (isset($param['usnombre']))
                $where .= " AND usnombre ='" . $param['usnombre'] . "'";
            if (isset($param['uslogin']))
                $where .= " AND uslogin ='" . $param['uslogin'] . "'";
            if (isset($param['usclave']))
                $where .= " AND usclave ='" . $param['usclave'] . "'";
            if (isset($param['usactivo']))
                $where .= " AND usactivo ='" . $param['usactivo'] . "'";
        }
        $arreglo = Usuario::listar($where);
        return $arreglo;
    }
}
