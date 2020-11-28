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
        if (array_key_exists('idusuario', $param) && array_key_exists('usapellido', $param) && array_key_exists('usnombre', $param) && array_key_exists('uslogin', $param) && array_key_exists('usclave', $param) and array_key_exists('usactivo', $param)) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], $param['usapellido'], $param['usnombre'], $param['uslogin'], md5($param['usclave']), $param['usactivo']);
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
        $usuario['idusuario'] = 1;
        $usuario['usnombre'] = $param['nombre'];
        $usuario['usapellido'] = $param['apellido'];
        $usuario['uslogin'] = $param['login'];
        $usuario['usclave'] = $param['clave'];
        $usuario['usactivo'] = 1;
        $elObjtUsuario = $this->cargarObjeto($usuario);
        if ($elObjtUsuario != null && $elObjtUsuario->insertar()) {
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
        $elObjtUsuario = $this->cargarObjetoConClave($param);
        $elObjtUsuario->setUsActivo(0);
        if ($elObjtUsuario != null and $elObjtUsuario->modificar()) {
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
        $elObjtUsuario = $this->cargarObjetoConClave($param);
        if (isset($param['nombre']))
            $elObjtUsuario->setUsNombre($param['nombre']);
        if (isset($param['apellido']))
            $elObjtUsuario->setUsApellido($param['apellido']);
        if (isset($param['clave']))
            $elObjtUsuario->setUsNombre(md5($param['clave']));
        if ($elObjtUsuario != null && $elObjtUsuario->modificar()) {
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
            if (isset($param['idusuario']))
                $where .= " AND idusuario = '" . $param['idusuario'] . "'";
            if (isset($param['usapellido']))
                $where .= " AND usApellido ='" . $param['usapellido'] . "'";
            if (isset($param['usnombre']))
                $where .= " AND usnombre ='" . $param['usnombre'] . "'";
            if (isset($param['uslogin']))
                $where .= " AND uslogin ='" . $param['uslogin'] . "'";
            if (isset($param['usclave']))
                $where .= " AND usclave ='" . md5($param['usclave']) . "'";
            if (isset($param['usactivo']))
                $where .= " AND usactivo ='" . $param['usactivo'] . "'";
        }
        $arreglo = Usuario::listar($where);
        return $arreglo;
    }

    /**
     * El administrador se encarga de otorgarle roles a los usuarios
     * @param array $param
     * @return true
     */
    public function nuevoRol($param){
        $elObjtUsuario = $this->cargarObjetoConClave($param);
        return $elObjtUsuario->agregarRol($param['descripcion']);
    }
}
