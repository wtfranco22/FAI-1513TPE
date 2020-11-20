<?php
class ArchivoCargadoEstado
{
    private $idArchivoCargadoEstado;
    private $objEstadoTipos;
    private $aceDescripcion;
    private $objUsuario;
    private $objArchivoCargado;
    private $aceFechaIngreso;
    private $aceFechaFin;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idArchivoCargadoEstado = "";
        $this->objEstadoTipos = new EstadoTipos() ;
        $this->aceDescripcion = "";
        $this->objUsuario = new Usuario();
        $this->aceFechaIngreso = "";
        $this->aceFechaFin = "";
        $this->objArchivoCargado = new ArchivoCargado();
        $this->mensajeoperacion = "";
    }

    /**
     * @param int $id
     * @param EstadoTipos $objEstado
     * @param string $desc
     * @param Usuario $user
     * @param string $fechaIni
     * @param string $fechaFin
     * @param ArchivoCargado $objArchivo
     */
    public function setear($id, $objEstado, $desc, $user, $fechaIni, $fechaFin, $objArchivo)
    {
        $this->setIdArchivoCargadoEstado($id);
        $this->setObjEstadoTipos($objEstado);
        $this->setAceDescripcion($desc);
        $this->setObjUsuario($user);
        $this->setAceFechaIngreso($fechaIni);
        $this->setAceFechaFin($fechaFin);
        $this->setObjArchivoCargado($objArchivo);
    }

    public function getIdArchivoCargadoEstado()
    {
        return $this->idArchivoCargadoEstado;
    }
    /** 
     * @return EstadoTipos
     */
    public function getObjEstadoTipos()
    {
        return $this->objEstadoTipos;
    }
    public function getAceDescripcion()
    {
        return $this->aceDescripcion;
    }
    /**
     * @return Usuario
     */
    public function getObjUsuario()
    {
        return $this->objUsuario;
    }
    public function getAceFechaIngreso()
    {
        return $this->aceFechaIngreso;
    }
    public function getAceFechaFin()
    {
        return $this->aceFechaFin;
    }
    /**
     * @return ArchivoCargado
     */
    public function getObjArchivoCargado()
    {
        return $this->objArchivoCargado;
    }
    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function setIdArchivoCargadoEstado($id)
    {
        $this->idArchivoCargadoEstado = $id;
    }
    /**
     * @param EstadoTipos $objEstado
     */
    public function setObjEstadoTipos($objEstado)
    {
        $this->objEstadoTipos = $objEstado;
    }
    public function setAceDescripcion($desc)
    {
        $this->aceDescripcion = $desc;
    }
    /**
     * @param Usuario $user
     */
    public function setObjUsuario($user)
    {
        $this->objUsuario = $user;
    }
    public function setAceFechaIngreso($fechaIni)
    {
        $this->aceFechaIngreso = $fechaIni;
    }
    public function setAceFechaFin($fechaFin)
    {
        $this->aceFechaFin = $fechaFin;
    }
    /**
     * @param ArchivoCargado $objArchivo
     */
    public function setObjArchivoCargado($objArchivo)
    {
        $this->objArchivoCargado = $objArchivo;
    }
    public function setmensajeoperacion($mensaje)
    {
        $this->mensajeoperacion = $mensaje;
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM archivocargadoestado WHERE idarchivocargadoestado = " . $this->getIdArchivoCargadoEstado();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $user = new Usuario();
                    $user->setIdUsuario($row['idusuario']);
                    $user->cargar();
                    $archivo = new ArchivoCargado();
                    $archivo->setIdArchivoCargado('idarchivocargado');
                    $archivo->cargar();
                    $estado = new EstadoTipos();
                    $estado->setIdEstadoTipos($row['idestadotipos']);
                    $estado->cargar();
                    $this->setear(
                        $row['idarchivocargadoestado'],
                        $estado,
                        $row['acedescripcion'],
                        $user,
                        $row['acefechaingreso'],
                        $row['acefechafin'],
                        $archivo
                    );
                }
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargadoEstado->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO archivocargadoestado (idestadotipos, acedescripcion, idusuario, acefechafin, idarchivocargado)" .
            " VALUES( " . $this->getObjEstadoTipos()->getIdEstadoTipos() . " , '" . $this->getAceDescripcion() . "', " . $this->getObjUsuario()->getIdUsuario() . " , '" . $this->getAceFechaFin() . "' , " . $this->getObjArchivoCargado()->getIdArchivoCargado() . ");";
        if ($base->Iniciar()) {
            if ($idArchivoEstado = $base->Ejecutar($sql)) {
                $this->setIdArchivoCargadoEstado($idArchivoEstado);
                $resp = true;
            } else {
                $this->setmensajeoperacion("ArchivoCargadoEstado->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargadoEstado->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE archivocargadoestado SET idestadotipos=" . $this->getobjEstadoTipos()->getIdEstadoTipos() . ", acedescripcion='" . $this->getAceDescripcion() . "', idusuario=" . $this->getObjUsuario()->getIdUsuario() . ", idarchivocargado=" . $this->getObjArchivoCargado()->getIdArchivoCargado() . ", acefechaingreso='" . $this->getAceFechaIngreso() . "', acefechafin='" . $this->getAceFechaFin() . "' WHERE idarchivocargadoestado=" . $this->getIdArchivoCargadoEstado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("ArchivoCargadoEstado->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargadoEstado->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM archivocargadoestado WHERE idarchivocargadoestado=" . $this->getidArchivoCargadoEstado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("ArchivoCargadoEstado->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargadoEstado->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM archivocargadoestado ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new ArchivoCargadoEstado();
                    $archivo = new ArchivoCargado();
                    $archivo->setIdArchivoCargado($row['idarchivocargado']);
                    $archivo->cargar();
                    $user = new Usuario();
                    $user->setIdUsuario($row['idusuario']);
                    $user->cargar();
                    $tipoEstado = new EstadoTipos();
                    $tipoEstado->setIdEstadoTipos($row['idestadotipos']);
                    $tipoEstado->cargar();
                    $obj->setear($row['idarchivocargadoestado'], $tipoEstado, $row['acedescripcion'], $user, $row['acefechaingreso'], $row['acefechafin'], $archivo);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            ArchivoCargadoEstado::setmensajeoperacion("ArchivoCargadoEstado->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
