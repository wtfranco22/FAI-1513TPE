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
        if (array_key_exists('idusuario', $param) && array_key_exists('usapellido', $param) && array_key_exists('uscorreo', $param) && array_key_exists('usnombre', $param) && array_key_exists('uslogin', $param) && array_key_exists('usclave', $param) and array_key_exists('usactivo', $param)) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], $param['uscorreo'], $param['usapellido'], $param['usnombre'], $param['uslogin'], md5($param['usclave']), $param['usactivo']);
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
            $obj->setear($param['idusuario'], null, null, null, null, null, null);
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
        $usuario['uscorreo'] = $param['correo'];
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
        if (isset($param['nombre']) && (($param['nombre']) != 'null'))
            $elObjtUsuario->setUsNombre($param['nombre']);
        if (isset($param['apellido']) && (($param['apellido']) != 'null'))
            $elObjtUsuario->setUsApellido($param['apellido']);
        if (isset($param['correo']) && (($param['correo']) != 'null'))
            $elObjtUsuario->setUsCorreo($param['apellido']);
        if (isset($param['clave']) && (($param['clave']) != 'null')) {
            if (isset($param['clave2']) && (($param['clave2']) != 'null')) {
                if ($param['clave'] == $param['clave2'])
                    $elObjtUsuario->setUsClave(md5($param['clave']));
            }
        }
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
            if (isset($param['uscorreo']))
                $where .= " AND uscorreo ='" . $param['uscorreo'] . "'";
            if (isset($param['uslogin']))
                $where .= " AND uslogin ='" . $param['uslogin'] . "'";
            if (isset($param['usclave']))
                $where .= " AND usclave ='" . md5($param['usclave']) . "'";
            if (isset($param['usactivo'])) {
                $where .= " AND usactivo ='" . $param['usactivo'] . "'";
            }
        }
        $arreglo = Usuario::listar($where);
        return $arreglo;
    }

    /**
     * se encarga de inactivar al usuario dejandolo como visitante inactivo
     * @param array $param
     * @return boolean
     */
    public function inactivarUsuario($param)
    {
        $elObjtUsuario = $this->cargarObjetoConClave($param);
        $elObjtUsuario->cargarRoles();
        foreach ($elObjtUsuario->getRoles() as $rol) {
            $elObjtUsuario->eliminarRol($rol->getDescripcion());
        }
        $elObjtUsuario->setUsActivo(0);
        return $elObjtUsuario->modificar();
    }

    /**
     * vuelve a habilitar el ingreso al usuario que estaba inactivo
     * param es ['alta'=>idusuario] nada mas
     * @param array $param 
     * @return boolean
     */
    public function activarUsuario($param)
    {
        $elObjtUsuario = $this->cargarObjetoConClave(['idusuario' => $param['alta']]);
        $elObjtUsuario->setUsActivo(1);
        return ($elObjtUsuario != null && $elObjtUsuario->modificar() && $elObjtUsuario->agregarRol());
    }

    /**
     * utilizado para agregar o quitar un rol del usuario
     * @param array $param
     * @return boolean
     */
    public function modificarRolesUsuario($param)
    {
        $resp = false;
        $elObjtUsuario = $this->cargarObjetoConClave($param);
        if ($param['accionRolUser'] == 'agregarRolUser') {
            $resp = $elObjtUsuario->agregarRol($param['valorRol']);
        } else {
            $resp = $elObjtUsuario->eliminarRol($param['valorRol']);
        }
        return $resp;
    }

    /**
     * Este metodo se encarga de buscar al usuario con los datos y retornar si es valido
     * @param array $datos
     * @return string
     */
    public function validarCorreo($datos)
    {
        $valor = null;
        $busqueda['usnombre'] = $datos['nombre'];
        $busqueda['usapellido'] = $datos['apellido'];
        $busqueda['uscorreo'] = $datos['correo'];
        $busqueda['uslogin'] = $datos['login'];
        $busqueda['usactivo'] = 1;
        $buscar = $this->buscar($busqueda);
        $elObjtUsuario = $buscar[0];
        if ($elObjtUsuario != null) {
            $valor = md5(microtime());
            $elObjtUsuario->setUsClave($valor);
            $elObjtUsuario->modificar();
        }
        return $valor;
    }
}
