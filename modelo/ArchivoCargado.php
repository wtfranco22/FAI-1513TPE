<?php
class ArchivoCargado
{
    private $idArchivoCargado;
    private $acNombre;
    private $acDescripcion;
    private $acIcono;
    private $objUsuario;
    private $acLinkAcceso;
    private $acCantidadDescarga;
    private $acCantidadUsada;
    private $acFechaInicioCompartir;
    private $aceFechaFinCompartir;
    private $acProtegidoClave;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idArchivoCargado = "";
        $this->acNombre = "";
        $this->acDescripcion = "";
        $this->objUsuario = "";
        $this->acIcono = "";
        $this->acLinkAcceso = "";
        $this->acCantidadDescarga = "";
        $this->acCantidadUsada = "";
        $this->acFechaInicioCompartir = "";
        $this->aceFechaFinCompartir="";
        $this->acProtegidoClave="";
        $this->mensajeoperacion = "";
    }

    public function setear($id, $nombre, $desc, $icon, $user, $link, $cantDes, $cantUsad, $fechaIni, $fechaFin, $clave )
    {
        $this->setIdArchivoCargado($id);
        $this->setAcNombre($nombre);
        $this->setAcDescripcion($desc);
        $this->setObjUsuario($user);
        $this->setAcIcono($icon);
        $this->setAcLinkAcceso($link);
        $this->setAcCantidadDescarga($cantDes);
        $this->setAcCantidadUsada($cantUsad);
        $this->setAcFechaInicioCompartir($fechaIni);
        $this->setAceFechaFinCompartir($fechaFin);
        $this->setAcProtegidoClave($clave);
    }

    public function getIdArchivoCargado(){ return $this->idArchivoCargado;}
    public function getAcNombre(){ return $this->acNombre;}
    public function getAcDescripcion(){ return $this->acDescripcion;}
    public function getObjUsuario(){ return $this->objUsuario;}
    public function getAcIcono(){ return $this->acIcono;}
    public function getAcLinkAcceso(){ return $this->acLinkAcceso;}
    public function getAcCantidadDescarga(){ return $this->acCantidadDescarga;}
    public function getAcCantidadUsada(){ return $this->acCantidadUsada;}
    public function getAcFechaInicioCompartir(){ return $this->acFechaInicioCompartir;}
    public function getAceFechaFinCompartir(){ return $this->aceFechaFinCompartir;}
    public function getAcProtegidoClave(){ return $this->acProtegidoClave;}
    public function getmensajeoperacion(){ return $this->mensajeoperacion;}

    public function setIdArchivoCargado($id){ $this->idArchivoCargado=$id; }
    public function setAcNombre($nombre){ $this->acNombre=$nombre; }
    public function setAcDescripcion($desc){ $this->acDescripcion=$desc; }
    public function setObjUsuario($user){ $this->objUsuario=$user; }
    public function setAcIcono($icon){ $this->acIcono=$icon; }
    public function setAcLinkAcceso($enlace){ $this->acLinkAcceso=$enlace; }
    public function setAcCantidadDescarga($cantDes){ $this->acCantidadDescarga=$cantDes; }
    public function setAcCantidadUsada($cantUsad){ $this->acCantidadUsada=$cantUsad; }
    public function setAcFechaInicioCompartir($fechaIni){ $this->acFechaInicioCompartir=$fechaIni; }
    public function setAceFechaFinCompartir($fechaFin){ $this->aceFechaFinCompartir=$fechaFin; }
    public function setAcProtegidoClave($clave){ $this->acProtegidoClave=$clave; }
    public function setmensajeoperacion($mensaje){ $this->mensajeoperacion=$mensaje; }


    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM archivocargado WHERE idarchivocargado = " . $this->getidArchivoCargado() ;
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idarchivocargado'], $row['acnombre'], $row['acdescripcion'], $row['acicono'], $row['idusuario'], $row['aclinkacceso'], $row['accantidaddescarga'], $row['accantidadusada'], $row['acfechainiciocompartir'], $row['acefechafincompartir'], $row['acprotegidoclave']);
                }
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargado->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO archivocargado ( acnombre, acdescripcion, acicono, idusuario, aclinkacceso, accantidaddescarga, accantidadusada, acfechainiciocompartir , acefechafincompartir, acprotegidoclave)".
        " VALUES( '".$this->getAcNombre()."' , '".$this->getAcDescripcion()."' , '".$this->getAcIcono()."' , '".$this->getObjUsuario()."' , '".$this->getAcLinkAcceso()."' , '".$this->getAcCantidadDescarga()."' , '".$this->getAcCantidadUsada()."', '".$this->getAcFechaInicioCompartir()."' , '".$this->getAceFechaFinCompartir()."' , '".$this->getAcProtegidoClave()."');";
        if ($base->Iniciar()) {
            if ($idArchivo = $base->Ejecutar($sql)) {
                $this->setIdArchivoCargado($idArchivo);
                $resp = true;
            } else {
                $this->setmensajeoperacion("ArchivoCargado->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargado->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE archivocargado SET acnombre='".$this->getAcNombre()."', acdescripcion='".$this->getAcDescripcion()."', acicono='".$this->getAcIcono()."', idusuario='".$this->getObjUsuario()."', aclinkacceso='".$this->getAcLinkAcceso()."', accantidaddescarga='".$this->getAcCantidadDescarga()."' , accantidadusada='".$this->getAcCantidadUsada()."', acfechainiciocompartir='".$this->getAcFechaInicioCompartir()."', acefechafincompartir='".$this->getAceFechaFinCompartir()."', acprotegidoclave='".$this->getAcProtegidoClave()."' WHERE idarchivocargado='".$this->getIdArchivoCargado()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("ArchivoCargado->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargado->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM archivocargado WHERE idarchivocargado=". $this->getidArchivoCargado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("ArchivoCargado->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargado->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM archivocargado ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new ArchivoCargado();
                    $user = new Usuario();
                    $user->setIdUsuario($row['idusuario']);
                    $user->cargar();
                    $obj->setear($row['idarchivocargado'], $row['acnombre'], $row['acdescripcion'], $row['acicono'], $user, $row['aclinkacceso'], $row['accantidaddescarga'], $row['accantidadusada'], $row['acfechainiciocompartir'], $row['acefechafincompartir'], $row['acprotegidoclave']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            ArchivoCargado::setmensajeoperacion("ArchivoCargado->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
