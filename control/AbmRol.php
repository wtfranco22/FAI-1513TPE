<?php
class AbmRol
{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Rol
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idrol', $param) && array_key_exists('roldescripcion', $param)) {
            $obj = new Rol();
            $obj->setear($param['idrol'], $param['roldescripcion']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los usnombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Rol
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idrol'])) {
            $obj = new Rol();
            $obj->setear($param['idrol'], null);
            $obj->cargar();
        }
        return $obj;
    }

    /**
     * 
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        $rol['idrol'] = 1;
        $rol['roldescripcion'] = $param['descripcion'];
        $elObjtRol = $this->cargarObjeto($rol);
        if ($elObjtRol != NULL && $elObjtRol->insertar()) {
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
        $elObjtRol = $this->cargarObjetoConClave($param);
        if ($elObjtRol != null and $elObjtRol->eliminar()) {
            $resp = true;
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
        $resp = false;
        $elObjtRol = $this->cargarObjetoConClave($param);
        $elObjtRol->setDescripcion($param['descripcion']);
        if ($elObjtRol != null && $elObjtRol->modificar()) {
            $resp = true;
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
            if (isset($param['idrol']))
                $where .= " AND idrol = '" . $param['idrol'] . "'";
            if (isset($param['roldescripcion']))
                $where .= " AND roldescripcion ='" . $param['roldescripcion'] . "'";
        }
        $arreglo = Rol::listar($where);
        return $arreglo;
    }
}
