<?php
class ArchivoCargadoEstado
{
    private $idArchivoCargadoEstado;
    private $objIdEstadoTipos;
    private $aceDescripcion;
    private $objUsuario;
    private $objIdArchivoCargado;
    private $aceFechaIngreso;
    private $aceFechaFin;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idArchivoCargadoEstado = "";
        $this->objIdEstadoTipos = "";
        $this->aceDescripcion = "";
        $this->objUsuario = "";
        $this->aceFechaIngreso = "";
        $this->aceFechaFin="";
        $this->objIdArchivoCargado = "";
        $this->mensajeoperacion = "";
    }

    public function setear($id, $idEstadoTipos, $desc, $user, $fechaIni, $fechaFin, $idArcCarga)
    {
        $this->setIdArchivoCargadoEstado($id);
        $this->setObjIdEstadoTipos($idEstadoTipos);
        $this->setAceDescripcion($desc);
        $this->setObjUsuario($user);
        $this->setAceFechaIngreso($fechaIni);
        $this->setAceFechaFin($fechaFin);
        $this->setObjIdArchivoCargado($idArcCarga);
    }

    public function getIdArchivoCargadoEstado(){ return $this->idArchivoCargadoEstado;}
    public function getObjIdEstadoTipos(){ return $this->objIdEstadoTipos;}
    public function getAceDescripcion(){ return $this->aceDescripcion;}
    public function getObjUsuario(){ return $this->objUsuario;}
    public function getAceFechaIngreso(){ return $this->aceFechaIngreso;}
    public function getAceFechaFin(){ return $this->aceFechaFin;}
    public function getObjIdArchivoCargado(){ return $this->objIdArchivoCargado;}
    public function getmensajeoperacion(){ return $this->mensajeoperacion;}

    public function setIdArchivoCargadoEstado($id){ $this->idArchivoCargadoEstado=$id; }
    public function setObjIdEstadoTipos($nombre){ $this->objIdEstadoTipos=$nombre; }
    public function setAceDescripcion($desc){ $this->aceDescripcion=$desc; }
    public function setObjUsuario($user){ $this->objUsuario=$user; }
    public function setAceFechaIngreso($fechaIni){ $this->aceFechaIngreso=$fechaIni; }
    public function setAceFechaFin($fechaFin){ $this->aceFechaFin=$fechaFin; }
    public function setObjIdArchivoCargado($enlace){ $this->objIdArchivoCargado=$enlace; }
    public function setmensajeoperacion($mensaje){ $this->mensajeoperacion=$mensaje; }


    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM archivocargadoestado WHERE idarchivocargadoestado = " . $this->getIdArchivoCargadoEstado() ;
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idarchivocargadoestado'], $row['idestadotipos'], $row['acedescripcion'], $row['idusuario'], $row['acefechaingreso'], $row['acefechafin'], $row['idarchivocargado'] );
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
        $sql = "INSERT INTO archivocargadoestado (idarchivocargadoestado, idestadotipos, acedescripcion, idusuario, acefechaingreso, acefechafin, idarchivocargado)".
        " VALUES(".$this->getIdArchivoCargadoEstado()." , '".$this->getObjIdEstadoTipos()."' , '".$this->getAceDescripcion()."', '".$this->getObjUsuario()."' , '".$this->getAceFechaIngreso()."' , '".$this->getAceFechaFin()."' , '".$this->getObjIdArchivoCargado()."');";
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
        $sql = "UPDATE archivocargadoestado SET Idestadotipos='".$this->getobjIdEstadoTipos()."', acedescripcion='".$this->getAceDescripcion()."', idusuario='".$this->getObjUsuario()."', idarchivocargado='".$this->getObjIdArchivoCargado()."', acefechaingreso='".$this->getAceFechaIngreso()."', acefechafin'".$this->getAceFechaFin()."' WHERE idarchivocargadoestado=".$this->getIdArchivoCargadoEstado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql) ) {
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
        $sql = "DELETE FROM archivocargadoestado WHERE idarchivocargadoestado=". $this->getidArchivoCargadoEstado();
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
                    $archivoCargado = new ArchivoCargado();
                    $user = new Usuario();
                    $tipoEstado = new EstadoTipos();
                    $archivoCargado->setIdArchivoCargado($row['idarchivocargado']);
                    $archivoCargado->cargar();
                    $user->setIdUsuario($row['idusuario']);
                    $user->cargar();
                    $tipoEstado->setIdEstadoTipos($row['idestadotipos']);
                    $tipoEstado->cargar();
                    $obj->setear($row['idarchivocargadoEstado'], $tipoEstado, $row['acedescripcion'], $user, $row['acefechaingreso'], $row['acefechafin'], $archivoCargado);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            ArchivoCargadoEstado::setmensajeoperacion("ArchivoCargadoEstado->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
