<?php
class EstadoTipos
{
    private $idEstadoTipos;
    private $etDescripcion;
    private $etActivo;
    private $archivosDeTipo;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idEstadoTipos = "";
        $this->aceDescripcion = "";
        $this->etActivo = "";
        $this->archivosDeTipo = [];
        $this->mensajeoperacion = "";
    }
    /**
     * @param int $id
     * @param string $desc
     * @param int $activo
     */
    public function setear($id, $desc, $activo)
    {
        $this->setIdEstadoTipos($id);
        $this->setEtDescripcion($desc);
        $this->setEtActivo($activo);
    }

    /**
     * @return int
     */
    public function getIdEstadoTipos()
    {
        return $this->idEstadoTipos;
    }
    /**
     * @return string
     */
    public function getEtDescripcion()
    {
        return $this->etDescripcion;
    }
    /** 
     * @return int
     */
    public function getEtActivo()
    {
        return $this->etActivo;
    }
    /**
     * @return array
     */
    public function getArchivosDeTipo()
    {
        return $this->archivosDeTipo;
    }
    /**
     * @return string
     */
    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    /**
     * @param int $id
     */
    public function setIdEstadoTipos($id)
    {
        $this->idEstadoTipos = $id;
    }
    /**
     * @param string $desc
     */
    public function setEtDescripcion($desc)
    {
        $this->etDescripcion = $desc;
    }
    /**
     * @param string $fechaIni
     */
    public function setEtActivo($fechaIni)
    {
        $this->etActivo = $fechaIni;
    }
    /**
     * @param array $archivoTipos
     */
    public function setArchivosDeTipo($archivosTipo)
    {
        $this->archivosDeTipo = $archivosTipo;
    }
    /**
     * @param string $mensaje
     */
    public function setmensajeoperacion($mensaje)
    {
        $this->mensajeoperacion = $mensaje;
    }

    /**
     * solo necesitamos que el EstadoTipo tenga su id seteado para cargar todos los demas valores
     * @return boolean
     */
    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM estadotipos WHERE idestadotipos = " . $this->getIdEstadoTipos();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idestadotipos'], $row['etdescripcion'], $row['etactivo']);
                }
            }
        } else {
            $this->setmensajeoperacion("EstadoTipos->listar: " . $base->getError());
        }
        return $resp;
    }

    /**
     * una vez que el EstadoTipos tenga sus valores seteados insertamos un nuevo EstadoTipos
     * con estos valores en la base de datos
     * @return boolean
     */
    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO EstadoTipos (idestadotipos, etdescripcion, etactivo)" .
            " VALUES(" . $this->getIdEstadoTipos() . " , '" . $this->getEtDescripcion() . "' , '" . $this->getEtActivo() . "');";
        if ($base->Iniciar()) {
            if ($idEstado = $base->Ejecutar($sql)) {
                $this->setIdEstadoTipos($idEstado);
                $resp = true;
            } else {
                $this->setmensajeoperacion("EstadoTipos->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("EstadoTipos->insertar: " . $base->getError());
        }
        return $resp;
    }

    /**
     * si seteamos nuevos datos no nos alcanza utilizar un metodo set sobre el EstadoTipo
     * sino que debemos reflejar los nuevos cambios sobre la base de datos
     * @return boolean
     */
    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE estadotipos SET etdescripcion='" . $this->getEtDescripcion() . "', etactivo='" . $this->getEtActivo() . "' WHERE idestadotipos=" . $this->getIdEstadoTipos();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("EstadoTipos->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("EstadoTipos->modificar: " . $base->getError());
        }
        return $resp;
    }

    /**
     * para borrar el EstadoTipo de manera permanente lo debemos hacer en la base de datos
     * entonces al estar seteada el id, nos basta para buscarlos y realizar un DELETE
     * @return boolean
     */
    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM estadotipos WHERE idestadotipos=" . $this->getidEstadoTipos();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("EstadoTipos->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("EstadoTipos->eliminar: " . $base->getError());
        }
        return $resp;
    }

    /**
     * guardamos los EstadoTipo en un arreglo para poder manipular sobre ellos,
     * tenemos el parametro para cualquier especificacion sobre la busqueda de los EstadoTipo
     * pero si el parametro es vacio solamente mostrarmos a los usuarios sin restricciones
     * @param string $parametro
     * @return array
     */
    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM estadotipos ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new EstadoTipos();
                    $obj->setear($row['idestadotipos'], $row['etdescripcion'], $row['etactivo']);
                    $obj->cargarArchivosDeTipo();
                    array_push($arreglo, $obj);
                }
            }
        } else {
            EstadoTipos::setmensajeoperacion("EstadoTipos->listar: " . $base->getError());
        }
        return $arreglo;
    }

    /**
     * Como muchos archivos tienen un mismo EstadoTipo entonces en cada EstadoTipo podemos
     * tener una coleccion de los archivos que tienen un mismo estado
     */
    public function cargarArchivosDeTipo()
    {
        $archivosDeTipo = ArchivoCargadoEstado::listar("idestadotipos=" . $this->getIdEstadoTipos());
        $this->setArchivosDeTipo($archivosDeTipo);
    }
}
