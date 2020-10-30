<?php
class Usuario
{
    private $idUsuario;
    private $usApellido;
    private $usNombre;
    private $usLogin;
    private $usClave;
    private $usActivo;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idUsuario = "";
        $this->usApellido = "";
        $this->usNombre = "";
        $this->usLogin = "";
        $this->usClave = "";
        $this->usActivo = "";
        $this->mensajeoperacion = "";
    }

    public function setear($id, $apellido, $nombre, $login, $clave, $act)
    {
        $this->setIdUsuario($id);
        $this->setUsApellido($apellido);
        $this->setUsNombre($nombre);
        $this->setUsLogin($login);
        $this->setUsClave($clave);
        $this->setUsActivo($act);
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    public function getUsNombre()
    {
        return $this->usNombre;
    }
    public function getUsApellido()
    {
        return $this->usApellido;
    }
    public function getUsLogin()
    {
        return $this->usLogin;
    }
    public function getUsClave()
    {
        return $this->usClave;
    }
    public function getUsActivo()
    {
        return $this->usActivo;
    }
    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function setIdUsuario($id)
    {
        $this->idUsuario = $id;
    }
    public function setUsNombre($nombre)
    {
        $this->usNombre = $nombre;
    }
    public function setUsApellido($apellido)
    {
        $this->usApellido = $apellido;
    }
    public function setUsLogin($login)
    {
        $this->usLogin = $login;
    }
    public function setUsClave($clave)
    {
        $this->usClave = $clave;
    }
    public function setUsActivo($act)
    {
        $this->usActivo = $act;
    }
    public function setmensajeoperacion($valorMensaje)
    {
        $this->mensajeoperacion = $valorMensaje;
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM Usuario WHERE idusuario = " . $this->getIdUsuario();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idusuario'], $row['usapellido'], $row['usnombre'], $row['uslogin'], $row['usclave'], $row['usactivo']);
                }
            }
        } else {
            $this->setmensajeoperacion("Usuario->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO usuario (idusuario, usapellido, usnombre, uslogin, usclave, usactivo)  VALUES(" . $this->getIdUsuario() . " , '" . $this->getUsApellido() . "' , '" . $this->getUsNombre() . "' , '" . $this->getUsLogin() . "' , '" . $this->getUsClave() . "' , '" . $this->getUsActivo() . "');";
        if ($base->Iniciar()) {
            if ($idUs = $base->Ejecutar($sql)) {
                $this->setIdUsuario($idUs);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Usuario->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Usuario->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuario SET usapellido='" . $this->getUsApellido() . "', usnombre='" . $this->getUsNombre() . "', usLogin='" . $this->getUsLogin() . "', usClave='" . $this->getUsClave() . "', usActivo='" . $this->getUsActivo() . "' WHERE idusuario='" . $this->getIdUsuario() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Usuario->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Usuario->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM usuario WHERE idusuario=" . $this->getIdUsuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Usuario->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Usuario->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new Usuario();
                    $obj->setear($row['idusuario'], $row['usapellido'], $row['usnombre'], $row['uslogin'], $row['usclave'], $row['usactivo']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            Usuario::setmensajeoperacion("Usuario->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
