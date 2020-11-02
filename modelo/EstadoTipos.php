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

    public function cargarArchivosDeTipo()
    {
        $archivosDeTipo = [];
        $archivosDeTipo = ArchivoCargadoEstado::listar("idestadotipos=" . $this->getIdEstadoTipos());
        $this->setArchivosDeTipo($archivosDeTipo);
    }
}
