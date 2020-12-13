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
            array_key_exists('idarchivocargadoestado', $param) and array_key_exists('objestadotipos', $param)
            and array_key_exists('acedescripcion', $param) and array_key_exists('objusuario', $param)
            and array_key_exists('acefechaingreso', $param) and array_key_exists('acefechafin', $param)
            and array_key_exists('objarchivocargado', $param)
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
        if (isset($param['idarchivo'])) {
            $obj = new ArchivoCargadoEstado();
            $archivo['objarchivocargado'] = $param['idarchivo'];
            $modificaciones = $this->buscar($archivo);
            $obj = array_pop($modificaciones);
        }
        return $obj;
    }

    /**
     * esperamos un arreglo asociativo con los valores ingresados por el usuario y luego
     * creamos un arreglo asociativo para tener todos los datos para crear un objeto y
     * reflejar este nuevo objeto en la base de datos
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        $archivo['idarchivocargadoestado'] = 1;
        $archivo['objestadotipos'] = 1;
        $archivo['acedescripcion'] = $param['descripcion'];
        $archivo['objusuario'] = $param['usuario'];
        $archivo['acefechaingreso'] = date('Y-m-d H:i:s');
        $archivo['acefechafin'] = '2038-01-19 03:14:07'; //ultimo año permitido por mysql con timestamp
        $archivo['objarchivocargado'] = $param['idarchivocargado'];
        $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * esperamos un arreglo asociativo con los valores ingresados por el usuario y luego
     * creamos un arreglo asociativo para tener todos los datos para cargar un objeto con el id y
     * reflejar esta modificacion del objeto en la base de datos
     * @param array $param
     * @return boolean
     */
    public function modificarArchivo($param)
    {
        $resp = false;
        $objAC = $this->cargarObjetoConClave($param);
        $archivo['objarchivocargado'] = $param['idarchivo'];
        $archivo['idarchivocargadoestado'] = 1;
        $archivo['objestadotipos'] = $objAC->getObjEstadoTipos()->getIdEstadoTipos();
        $archivo['acedescripcion'] = $param['descripcion'];
        $archivo['objusuario'] = $param['usuario'];
        $archivo['acefechaingreso'] = date('Y-m-d H:i:s');
        $archivo['acefechafin'] = $objAC->getAceFechaFin();
        $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * esperamos un arreglo asociativo con los valores ingresados por el usuario y luego
     * creamos un arreglo asociativo para tener todos los datos para cargar un objeto con el id y
     * reflejar esta modificacion del objeto en la base de datos
     * @param array $param
     * @return boolean
     */
    public function compartirArchivo($param)
    {
        $resp = false;
        $objAC = $this->cargarObjetoConClave($param);
        $archivo['objarchivocargado'] = $param['idarchivo'];
        $archivo['idarchivocargadoestado'] = 1;
        $archivo['objestadotipos'] = 2;
        $archivo['acedescripcion'] = $objAC->getAceDescripcion();
        $archivo['objusuario'] = $param['usuario'];
        $archivo['acefechaingreso'] = date('Y-m-d H:i:s');
        $archivo['acefechafin'] = $objAC->getAceFechaFin();
        $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->insertar()) {
            $resp = true;
        }
        return $resp;
    }
    
    /**
     * esperamos un arreglo asociativo con los valores ingresados por el usuario y luego
     * creamos un arreglo asociativo para tener todos los datos para cargar un objeto con el id y
     * reflejar esta modificacion del objeto en la base de datos
     * @param array $param
     * @return boolean
     */
    public function dejarCompartirArchivo($param)
    {
        $resp = false;
        $objAC = $this->cargarObjetoConClave($param);
        $archivo['objarchivocargado'] = $param['idarchivo'];
        $archivo['idarchivocargadoestado'] = 1;
        $archivo['objestadotipos'] = 3;
        $archivo['acedescripcion'] = $param['motivo'];
        $archivo['objusuario'] = $objAC->getObjUsuario()->getIdUsuario();
        $archivo['acefechaingreso'] = $objAC->getAceFechaIngreso();
        $archivo['acefechafin'] = $objAC->getAceFechaFin();
        $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->insertar())
            $resp = true;
        return $resp;
    }
    
    /**
     * esperamos un arreglo asociativo con los valores ingresados por el usuario y luego
     * creamos un arreglo asociativo para tener todos los datos para cargar un objeto con el id y
     * reflejar esta modificacion del objeto en la base de datos
     * @param array $param
     * @return boolean
     */
    public function eliminarArchivo($param)
    {
        $archivo['objarchivocargado'] = $param['idarchivo'];
        $mismosArchivos = $this->buscar($archivo);
        $objAC = array_pop($mismosArchivos);
        $archivo['idarchivocargadoestado'] = 1;
        $archivo['objestadotipos'] = 4;
        $archivo['acedescripcion'] = $param['motivo'];
        $archivo['objusuario'] = $param['usuario'];
        $archivo['acefechaingreso'] = $objAC->getAceFechaIngreso();
        $archivo['acefechafin'] = date("Y-m-d H:i:s");
        $resp = false;
        $elObjtArchivoCargadoEstado = $this->cargarObjeto($archivo);
        if ($elObjtArchivoCargadoEstado != null && $elObjtArchivoCargadoEstado->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * permite buscar un objeto dependiendo el valor ingresado por parametro o no
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

    /**
     * Este metodo se encarga de devolver los archivos de un solo tipo (cargados, compartidos...)
     * por eso el switch y en $param se encuentra el tipo y el IDusuario para que solo traiga los archivos
     * de 1 solo usuario,siempre verificamos que sea la ultima modificacion de un
     * archivo con array_pop y este debe coincidir con el tipo estado que el usuario quiere
     */
    public function archivosTipo($param)
    {
        //si no esta seteado, elegimos a todos
        if (isset($param['archivos'])) {
            $tipo = $param['archivos'];
        } else {
            $tipo = 'todos';
        }
        switch ($tipo) {
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
                $condicion = true;
                break;
        }
        $archivosCargados = new AbmArchivoCargado();
        //busco de esta manera para comparar con posibles consultas de los atributos de la tabla archivos cargados
        $archivos = $archivosCargados->buscar($param);//traemos todos los archivos de un usuario por el id, o lo que sea valido para comparar en buscar
        $archivosDeUntipo = [];
        foreach ($archivos as $archivo) {//recorremos tods ls archivos del usuario
            $tiposDelArchivo = $archivo->getModificacionesArchivo();//obtenemos el historial del archivo
            $ultimaModificacion = new ArchivoCargadoEstado();
            $ultimaModificacion = array_pop($tiposDelArchivo);//del historial, solo tomamos el ultimo archivo
            if ($ultimaModificacion->getObjEstadoTipos()->getIdEstadoTipos() == $condicion) {//el ultimo estado coincide con lo que pedimos?
                $archivosDeUntipo[] = $ultimaModificacion;
            }
        }
        return $archivosDeUntipo;
    }
}
