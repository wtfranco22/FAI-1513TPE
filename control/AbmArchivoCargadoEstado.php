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
            array_key_exists('idestadotipos', $param) and array_key_exists('acedescripcion', $param) and
            array_key_exists('idusuario', $param) and array_key_exists('acefechaingreso', $param) and
            array_key_exists('acefechafin', $param) and array_key_exists('idarchivocargado', $param)
        ) {
            $obj = new ArchivoCargadoEstado();
            $archivocargado = new ArchivoCargado();
            $archivocargado->setIdArchivoCargado($param['idarchivocargado']);
            $archivocargado->cargar();
            $user = new Usuario();
            $user->setIdUsuario($param['idusuario']);
            $user->cargar();
            $estado = new EstadoTipos();
            $estado->setIdEstadoTipos($param['idestadotipos']);
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
        $archivo['idestadotipos'] = 1;
        $archivo['acedescripcion'] = $param['acdescripcion'];
        $archivo['idusuario'] = $param['idusuario'];
        $archivo['acefechaingreso'] = date('Y-m-d H:i:s');
        $archivo['acefechafin'] = '9999-12-31 23:59:59'; //ultimo año permitido por mysql con timestamp
        $archivo['idarchivocargado'] = $param['idarchivocargado'];
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
        $archivo['idarchivocargado'] = $param['idarchivocargado'];
        $buscar = new AbmArchivoCargadoEstado();
        $arreglo = $buscar->buscar($archivo);
        $archivo['objarchivocargado'] = $arreglo[0]->getObjArchivoCargado();
        $archivo['idarchivocargadoestado'] = $arreglo[0]->getIdArchivoCargadoEstado();
        $archivo['idestadotipos'] = 1;
        $archivo['acedescripcion'] = $param['acdescripcion'];
        $archivo['idusuario'] = $param['idusuario'];
        $archivo['acefechaingreso'] = $arreglo[0]->getAceFechaInicio();
        $archivo['acefechafin'] = $arreglo[0]->getAceFechaFin();
        $resp = false;
        if ($this->seteadosCamposClaves($archivo)) {
            $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
            if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->modificar()) {
                $resp = true;
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
        $archivo['idarchivocargado'] = $param['idarchivocargado'];
        $buscar = new AbmArchivoCargadoEstado();
        $arreglo = $buscar->buscar($archivo);
        $archivo['objarchivocargado'] = $arreglo[0]->getObjArchivoCargado();
        $archivo['idarchivocargadoestado'] = $arreglo[0]->getIdArchivoCargadoEstado();
        $archivo['idestadotipos'] = 2;
        $archivo['acedescripcion'] = $arreglo[0]->getAceDescripcion();
        $archivo['idusuario'] = $param['idusuario'];
        $archivo['acefechaingreso'] = $arreglo[0]->getAceFechaIngreso();
        $archivo['acefechafin'] = $arreglo[0]->getAceFechaFin();
        $resp = false;
        if ($this->seteadosCamposClaves($archivo)) {
            $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
            if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }
    /**
     * @param array $param
     * @return boolean
     */
    public function dejarCompartirArchivo($param)
    {
        $archivo['idarchivocargado'] = $param['idarchivocargado'];
        $buscar = new AbmArchivoCargadoEstado();
        $arreglo = $buscar->buscar($archivo);
        $archivo['objarchivocargado'] = $arreglo[0]->getObjArchivoCargado();
        $archivo['idarchivocargadoestado'] = $arreglo[0]->getIdArchivoCargadoEstado();
        $archivo['idestadotipos'] = 3;
        $archivo['acedescripcion'] = $param['acdescripcion'];
        $archivo['idusuario'] = $param['idusuario'];
        $archivo['acefechaingreso'] = $arreglo[0]->getAceFechaIngreso();
        $archivo['acefechafin'] = $arreglo[0]->getAceFechaFin();
        $resp = false;
        if ($this->seteadosCamposClaves($archivo)) {
            $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
            if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }
    /**
     * @param array $param
     * @return boolean
     */
    public function eliminarArchivo($param)
    {
        $archivo['idarchivocargado'] = $param['idarchivocargado'];
        $arreglo = $this->buscar($archivo);
        $archivo['idarchivocargadoestado'] = $arreglo[0]->getIdArchivoCargadoEstado();
        $archivo['idestadotipos'] = 4;
        $archivo['acedescripcion'] = $param['acdescripcion'];
        $archivo['idusuario'] = $param['idusuario'];
        $archivo['acefechaingreso'] = $arreglo[0]->getAceFechaIngreso();
        $archivo['acefechafin'] = date("Y-m-d H:i:s");
        $resp = false;
        if ($this->seteadosCamposClaves($archivo)) {
            $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
            if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->modificar()) {
                $resp = true;
            }
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
            if (isset($param['idestadotipos']))
                $where .= " AND idestadotipos ='" . $param['idestadotipos'] . "'";
            if (isset($param['acedescripcion']))
                $where .= " AND acedescripcion ='" . $param['acedescripcion'] . "'";
            if (isset($param['idusuario']))
                $where .= " AND idusuario ='" . $param['idusuario'] . "'";
            if (isset($param['acefechaingreso']))
                $where .= " AND acefechaingreso ='" . $param['acefechaingreso'] . "'";
            if (isset($param['acefechafin']))
                $where .= " AND acefechafin='" . $param['acefechafin'] . "'";
            if (isset($param['idarchivocargado']))
                $where .= " AND idarchivocargado ='" . $param['idarchivocargado'] . "'";
        }
        $arreglo = ArchivoCargadoEstado::listar($where);
        return $arreglo;
    }
}
