<?php
class Usuario
{
    private $idUsuario;
    private $usApellido;
    private $usNombre;
    private $usCorreo;
    private $usLogin;
    private $usClave;
    private $usActivo;
    private $archivosCargados;
    private $archivosModificados;
    private $roles;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idUsuario = "";
        $this->usApellido = "";
        $this->usNombre = "";
        $this->usCorreo = "";
        $this->usLogin = "";
        $this->usClave = "";
        $this->usActivo = "";
        $this->archivosCargados = [];
        $this->archivosModificados = [];
        $this->roles = [];
        $this->mensajeoperacion = "";
    }

    /**
     * @param int $id
     * @param string $apellido
     * @param string $nombre
     * @param string $login
     * @param string $clave
     * @param int $act
     */
    public function setear($id,$correo, $apellido, $nombre, $login, $clave, $act)
    {
        $this->setIdUsuario($id);
        $this->setUsCorreo($correo);
        $this->setUsApellido($apellido);
        $this->setUsNombre($nombre);
        $this->setUsLogin($login);
        $this->setUsClave($clave);
        $this->setUsActivo($act);
    }

    /**
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    /**
     * @return string
     */
    public function getUsCorreo()
    {
        return $this->usCorreo;
    }
    /**
     * @return string
     */
    public function getUsNombre()
    {
        return $this->usNombre;
    }
    /**
     * @return string
     */
    public function getUsApellido()
    {
        return $this->usApellido;
    }
    /**
     * @param string
     */
    public function getUsLogin()
    {
        return $this->usLogin;
    }
    /**
     * @param string
     */
    private function getUsClave()
    {
        return $this->usClave;
    }
    /**
     * @param int
     */
    public function getUsActivo()
    {
        return $this->usActivo;
    }
    /**
     * @return array
     */
    public function getArchivosCargados()
    {
        return $this->archivosCargados;
    }
    /**
     * @return array
     */
    public function getArchivosModificados()
    {
        return $this->archivosModificados;
    }
    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
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
    public function setIdUsuario($id)
    {
        $this->idUsuario = $id;
    }
    /**
     * @param string $correo
     */
    public function setUsCorreo($correo)
    {
        $this->usCorreo = $correo;
    }
    /**
     * @param string $nombre
     */
    public function setUsNombre($nombre)
    {
        $this->usNombre = $nombre;
    }
    /**
     * @param string $apellido
     */
    public function setUsApellido($apellido)
    {
        $this->usApellido = $apellido;
    }
    /**
     * @param string $login
     */
    public function setUsLogin($login)
    {
        $this->usLogin = $login;
    }
    /**
     * @param string $clave
     */
    public function setUsClave($clave)
    {
        $this->usClave = $clave;
    }
    /**
     * @param int $act
     */
    public function setUsActivo($act)
    {
        $this->usActivo = $act;
    }
    /**
     * @param array $archivos
     */
    public function setArchivosCargados($archivos)
    {
        $this->archivosCargados = $archivos;
    }
    /**
     * @param array $archivos
     */
    public function setArchivosModificados($archivos)
    {
        $this->archivosModificados = $archivos;
    }
    /**
     * @param $cargos array
     */
    public function setRoles($cargos)
    {
        $this->roles = $cargos;
    }
    /**
     * @param string $valorMensaje
     */
    public function setmensajeoperacion($valorMensaje)
    {
        $this->mensajeoperacion = $valorMensaje;
    }

    /**
     * solo necesitamos que el Usuario tenga su id seteado para cargar todos los demas valores
     * @return boolean
     */
    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario WHERE idusuario = " . $this->getIdUsuario();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idusuario'],$row['uscorreo'], $row['usapellido'], $row['usnombre'], $row['uslogin'], $row['usclave'], $row['usactivo']);
                }
            }
        } else {
            $this->setmensajeoperacion("Usuario->listar: " . $base->getError());
        }
        return $resp;
    }

    /**
     * una vez que el Usuario tenga sus valores seteados insertamos un nuevo usuario
     * con estos valores en la base de datos
     * @return boolean
     */
    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO usuario (usapellido, usnombre, uscorreo, uslogin, usclave, usactivo)  VALUES('" . $this->getUsApellido() . "' , '" . $this->getUsNombre() . "' , '" . $this->getUsCorreo() . "' , '" . $this->getUsLogin() . "' , '" . $this->getUsClave() . "' , '" . $this->getUsActivo() . "');";
        if ($base->Iniciar()) {
            if ($idUs = $base->Ejecutar($sql)) {
                //al ejecutar nos devuelve la cantidad de inserciones realizadas, nuestro id
                $this->setIdUsuario($idUs);
                $resp = $this->agregarRol();
            } else {
                $this->setmensajeoperacion("Usuario->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Usuario->insertar: " . $base->getError());
        }
        return $resp;
    }

    /**
     * si seteamos nuevos datos no nos alcanza utilizar un metodo set sobre el Usuario
     * sino que debemos reflejar los nuevos cambios sobre la base de datos
     * @return boolean
     */
    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuario SET usapellido='" . $this->getUsApellido() . "', usnombre='" . $this->getUsNombre() . "', uscorreo='" . $this->getUsCorreo() . "', usLogin='" . $this->getUsLogin() . "', usClave='" . $this->getUsClave() . "', usActivo='" . $this->getUsActivo() . "' WHERE idusuario='" . $this->getIdUsuario() . "'";
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

    /**
     * para borrar el Usuario de manera permanente lo debemos hacer en la base de datos
     * entonces al estar seteada el id, nos basta para buscarlos y realizar un DELETE
     * @return boolean
     */
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

    /**
     * guardamos los Usuarios en un arreglo para poder manipular sobre ellos,
     * tenemos el parametro para cualquier especificacion sobre la busqueda de los Usuarios
     * pero si el parametro es vacio solamente mostrarmos a los usuarios sin restricciones
     * @param string $parametro
     * @return array
     */
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
                    $obj->setear($row['idusuario'], $row['uscorreo'], $row['usapellido'], $row['usnombre'], $row['uslogin'], 'claveOculta', $row['usactivo']);
                    $obj->cargarArchivosSubidos();
                    $obj->cargarArchivosModificados();
                    $obj->cargarRoles();
                    array_push($arreglo, $obj);
                }
            }
        } else {
            Usuario::setmensajeoperacion("Usuario->listar: " . $base->getError());
        }
        return $arreglo;
    }

    /**
     * como un usuario puede subir muchos archivos, entonces guardamos en un arreglo
     * los objArchivosCargados para saber cuales son sus archivos y seteamos el arreglo
     */
    public function cargarArchivosSubidos()
    {
        //guardamos los archivos cargamos pr un usuario
        $archivos = ArchivoCargado::listar("idusuario='" . $this->getIdUsuario() . "'");
        $this->setArchivosCargados($archivos);
    }

    /**
     * si un usuario puede modificar distintos archivos entonces podemos guardar la coleccion
     * de los archivos modificados por este usuario
     */
    private function cargarArchivosModificados()
    {
        //guardamos los archivos modificados pr un usuario
        $archivos = ArchivoCargadoEstado::listar("idusuario=" . $this->getIdUsuario() . " AND idestadotipos>1 ");
        $this->setArchivosModificados($archivos);
    }

    /**
     * ya que un Usuario puede tener distintos roles, guardamos en una coleccion de roles
     * todos los roles/permisos que tiene el usuario
     */
    public function cargarRoles()
    {
        $cargos = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuariorol WHERE idusuario=" . $this->getIdUsuario();
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $objRol = new Rol();
                    $objRol->setIdRol($row['idrol']);
                    $objRol->cargar();
                    array_push($cargos, $objRol);
                }
            }
        } else {
            $this->setmensajeoperacion("Usuario->cargarRoles: " . $base->getError());
        }
        $this->setRoles($cargos);
    }

    /**
     * Cuando se otorga el alta a un nuevo usuario, le damos un rol por defecto de visitante
     * Si el administrador le otorga nuevos roles debemos reflejarlos en la base de datos
     * indicando con el id del usuario y el id del rol
     * @return boolean
     */
    public function agregarRol($parametro = "visitante")
    {
        $resp = false;
        $arreglo = Rol::listar("roldescripcion='" . $parametro . "'");
        if ($arreglo != null){
            $this->setRoles($arreglo);
            $rol = $arreglo[0];
        }
        $base = new BaseDatos();
        $sql = "INSERT INTO usuariorol (idusuario, idrol) VALUES(" . $this->getIdUsuario() . "," . $rol->getIdRol() . ");";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Usuario->agregarRol: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Usuario->agregarRol: " . $base->getError());
        }
        return $resp;
    }

    /**
     * El administrador tiene la posibilidad de eliminar un rol sobre el usuario,
     * para esto por parametro pasa el rol a eliminar y debemos saber el id del usuario
     * y el id del rol a eliminar
     * @return boolean
     */
    public function eliminarRol($parametro)
    {
        $resp = false;
        $arreglo = Rol::listar("roldescripcion='" . $parametro . "'");
        if ($arreglo != null){
            $this->setRoles($arreglo);
            $rol = $arreglo[0];
        }
        $base = new BaseDatos();
        $sql = "DELETE FROM usuariorol WHERE idusuario=" . $this->getIdUsuario() . " AND idrol=" . $rol->getIdRol() ;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Usuario->eliminarRol: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Usuario->eliminarRol: " . $base->getError());
        }
        return $resp;
    }
}
