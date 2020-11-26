<?php

class Rol{
    
    private $id;
    private $descripcion;
    private $usuarios;
    private $mensajeOperacion;
    
    public function __construct() {
        $this->id = "";
        $this->descripcion = "";
        $this->usuarios = [];
    }
    
    /**
     * @param int $id
     * @param string $descrip
     */
    public function setear ($id, $descrip){
        $this->setIdRol ($id);
        $this->setDescripcion ($descrip);
    }
    
    /**
     * @return int
     */    
    public function getIdRol() {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getDescripcion() {
        return $this->descripcion;
    }
    /**
     * @return array
     */
    public function getUsuarios(){
        return $this->usuarios;
    }
    /**
     * @return string
     */
    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }

    /**
     * @param int $id
     */
    public function setIdRol($id) {
        $this->id = $id;
    }
    /**
     * @param string $descrip
     */
    public function setDescripcion($descrip) {
        $this->descripcion = $descrip;
    }
    /**
     * @param array $usuariosRol
     */
    public function setUsuarios($usuariosRol){
        $this->usuarios = $usuariosRol;
    }
    /**
     * @param string $mensajeOperacion
     */
    public function setMensajeOperacion($mensajeOperacion) {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM rol  WHERE idrol = ".$this->getIdRol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idrol'], $row['roldescripcion']);
                }
            }
        } else {
            $this->setmensajeoperacion("Rol->listar: ".$base->getError());
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO rol (roldescripcion)  VALUES('".$this->getDescripcion()."');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdRol($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Rol->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Rol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE rol SET roldescripcion='".$this->getDescripcion()."' WHERE idrol=".$this->getIdRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Rol->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Rol->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM rol WHERE idrol=".$this->getIdRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Rol->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Rol->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM rol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->setear($row['idrol'], $row['roldescripcion']);
                    $obj->cargarUsuarios();
                    array_push($arreglo, $obj);
                }
            }
        } else {
            Rol::setmensajeoperacion("Rol->listar: ".$base->getError());
        }
        return $arreglo;
    }

    /**
     * Debemos cargar todos los posibles usuarios que puede tener este rol
     */
    public function cargarUsuarios(){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol WHERE idrol=".$this->getIdRol();
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $objUsuario= new Usuario();
                    $objUsuario->setIdUsuario($row['idusuario']);
                    $objUsuario->cargar();
                    array_push($arreglo, $objUsuario);
                }
            }
        } else {
            $this->setmensajeoperacion("Rol->cargarUsuarios: ".$base->getError());
        }
        $this->setUsuarios($arreglo);
    }
}