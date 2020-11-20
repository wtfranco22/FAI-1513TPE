<?php
class AbmArchivoCargadoEstado
{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return ArchivoCargadoEstado
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idarchivocargadoestado', $param) and
            array_key_exists('objestadotipos', $param) and array_key_exists('acedescripcion', $param) and
            array_key_exists('objusuario', $param) and array_key_exists('acefechaingreso', $param) and
            array_key_exists('acefechafin', $param) and array_key_exists('objarchivocargado', $param)
        ) {
            $obj = new ArchivoCargadoEstado();
            $archivocargado = new ArchivoCargado();
            $archivocargado->setIdArchivoCargado($param['objarchivocargado']);
            $archivocargado->cargar();
            $user = new Usuario();
            $user->setIdUsuario($param['objusuario']);
            $user->cargar();
            $estado = new EstadoTipos();
            $estado->setIdEstadoTipos($param['objestadotipos']);
            $estado->cargar();
            $obj->setear(
                $param['idarchivocargadoestado'],
                $estado,
                $param['acedescripcion'],
                $user,
                $param['acefechaingreso'],
                $param['acefechafin'],
                $archivocargado
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return ArchivoCargadoEstado
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idarchivocargadoEstado'])) {
            $obj = new ArchivoCargadoEstado();
            $obj->setear($param['idarchivocargadoEstado'], null, null, null, null, null, null);
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
        if (isset($param['idarchivocargadoestado']))
            $resp = true;
        return $resp;
    }

    /**
     * 
     * @param array $param
     * @return boolean
     */
    public function alta($param)
    {
        $archivo['idarchivocargadoestado'] = 1;
        $archivo['objestadotipos'] = 1;
        $archivo['acedescripcion'] = $param['descripcion'];
        $archivo['objusuario'] = $param['usuario'];
        $archivo['acefechaingreso'] = date('Y-m-d H:i:s');
        $archivo['acefechafin'] = '2038-01-19 03:14:07.999999'; //ultimo año permitido por mysql con timestamp
        $archivo['objarchivocargado'] = $param['idarchivocargado'];
        $resp = false;
        $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
        //verEstructura($elObjtArchivoCargadoEstado);
        if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->insertar()) {
            $resp = true;
        }
        return $resp;
    }
    /**
     * @param array $param
     * @return boolean
     */
    public function modificarArchivo($param)
    {
        $archivo['objarchivocargado'] = $param['idarchivocargado'];
        $modificaciones = $this->buscar($archivo);
        $objAC = array_pop($modificaciones);
        $archivo['idarchivocargadoestado'] = 1;
        $archivo['objestadotipos'] = $objAC->getObjEstadoTipos()->getIdEstadoTipos();
        $archivo['acedescripcion'] = $param['acdescripcion'];
        $archivo['objusuario'] = $param['objusuario'];
        $archivo['acefechaingreso'] = date('Y-m-d H:i:s');
        $archivo['acefechafin'] = $objAC->getAceFechaFin();
        print_r($archivo);
        $resp = false;
        $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->insertar()) {
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
            $elObjtArchivoCargadoEstado = $this->cargarObjetoConClave($param);
            if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * @param array $param
     * @return boolean
     */
    public function compartirArchivo($param)
    {
        $archivo['objarchivocargado'] = $param['idarchivocargado'];
        $arreglo = $this->buscar($archivo);
        $archivo['idarchivocargadoestado'] = $arreglo[0]->getIdArchivoCargadoEstado();
        $archivo['objestadotipos'] = 2;
        $archivo['acedescripcion'] = $arreglo[0]->getAceDescripcion();
        $archivo['objusuario'] = $param['objusuario'];
        $archivo['acefechaingreso'] = $arreglo[0]->getAceFechaIngreso();
        $archivo['acefechafin'] = $arreglo[0]->getAceFechaFin();
        $resp = false;
        $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->modificar()) {
            $resp = true;
        }
        return $resp;
    }
    /**
     * @param array $param
     * @return boolean
     */
    public function dejarCompartirArchivo($param)
    {
        $archivo['idarchivocargado'] = $param['idarchivo'];
        $arreglo = $this->buscar($archivo);
        $archivo['objarchivocargado'] = $arreglo[0]->getObjArchivoCargado();
        $archivo['idarchivocargadoestado'] = $arreglo[0]->getIdArchivoCargadoEstado();
        $archivo['objestadotipos'] = 3;
        $archivo['acedescripcion'] = $param['motivo'];
        $archivo['objusuario'] = $param['usuario'];
        $archivo['acefechaingreso'] = $arreglo[0]->getAceFechaIngreso();
        $archivo['acefechafin'] = $arreglo[0]->getAceFechaFin();
        $resp = false;
        $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->modificar())
            $resp = true;
        return $resp;
    }
    /**
     * @param array $param
     * @return boolean
     */
    public function eliminarArchivo($param)
    {
        $archivo['idarchivocargado'] = $param['idarchivo'];
        $arreglo = $this->buscar($archivo);
        $archivo['objarchivocargado'] = $arreglo[0]->getObjArchivoCargado();
        $archivo['idarchivocargadoestado'] = $arreglo[0]->getIdArchivoCargadoEstado();
        $archivo['objestadotipos'] = 4;
        $archivo['acedescripcion'] = $param['motivo'];
        $archivo['objusuario'] = $param['usuario'];
        $archivo['acefechaingreso'] = $arreglo[0]->getAceFechaIngreso();
        $archivo['acefechafin'] = date("Y-m-d H:i:s");
        $resp = false;
        $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->modificar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param <> null) {
            if (isset($param['idarchivocargadoEstado']))
                $where .= " AND idarchivocargadoestado ='" . $param['idarchivocargadoestado'] . "'";
            if (isset($param['objestadotipos']))
                $where .= " AND idestadotipos ='" . $param['objestadotipos'] . "'";
            if (isset($param['acedescripcion']))
                $where .= " AND acedescripcion ='" . $param['acedescripcion'] . "'";
            if (isset($param['objusuario']))
                $where .= " AND idusuario ='" . $param['objusuario'] . "'";
            if (isset($param['acefechaingreso']))
                $where .= " AND acefechaingreso ='" . $param['acefechaingreso'] . "'";
            if (isset($param['acefechafin']))
                $where .= " AND acefechafin='" . $param['acefechafin'] . "'";
            if (isset($param['objarchivocargado']))
                $where .= " AND idarchivocargado ='" . $param['objarchivocargado'] . "'";
        }
        $arreglo = ArchivoCargadoEstado::listar($where);
        return $arreglo;
    }
}
