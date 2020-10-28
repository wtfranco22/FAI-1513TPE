<?php
class EstadoTipos
{
    private $idEstadoTipos;
    private $etDescripcion;
    private $etActivo;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idEstadoTipos = "";
        $this->aceDescripcion = "";
        $this->etActivo = "";
        $this->mensajeoperacion = "";
    }

    public function setear($id, $desc, $activo)
    {
        $this->setIdEstadoTipos($id);
        $this->setEtDescripcion($desc);
        $this->setEtActivo($activo);
    }

    public function getIdEstadoTipos(){ return $this->idEstadoTipos;}
    public function getEtDescripcion(){ return $this->etDescripcion;}
    public function getEtActivo(){ return $this->etActivo;}
    public function getmensajeoperacion(){ return $this->mensajeoperacion;}

    public function setIdEstadoTipos($id){ $this->idEstadoTipos=$id; }
    public function setEtDescripcion($desc){ $this->etDescripcion=$desc; }
    public function setEtActivo($fechaIni){ $this->etActivo=$fechaIni; }
    public function setmensajeoperacion($mensaje){ $this->mensajeoperacion=$mensaje; }


    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM estadotipos WHERE idestadotipos = " . $this->getIdEstadoTipos() ;
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
        $sql = "INSERT INTO EstadoTipos (idestadotipos, etdescripcion, etactivo)".
        " VALUES(".$this->getIdEstadoTipos()." , '".$this->getEtDescripcion()."' , '".$this->getEtActivo()."');";
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
        $sql = "UPDATE estadotipos SET etdescripcion='".$this->getEtDescripcion()."', etactivo='".$this->getEtActivo()."' WHERE idestadotipos=".$this->getIdEstadoTipos();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql) ) {
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
        $sql = "DELETE FROM estadotipos WHERE idestadotipos=". $this->getidEstadoTipos();
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
                    array_push($arreglo, $obj);
                }
            }
        } else {
            EstadoTipos::setmensajeoperacion("EstadoTipos->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
