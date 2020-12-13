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
    private $modificacionesArchivo;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idArchivoCargado = "";
        $this->acNombre = "";
        $this->acDescripcion = "";
        $this->objUsuario = new Usuario();
        $this->acIcono = "";
        $this->acLinkAcceso = "";
        $this->acCantidadDescarga = "";
        $this->acCantidadUsada = "";
        $this->acFechaInicioCompartir = "";
        $this->aceFechaFinCompartir = "";
        $this->acProtegidoClave = "";
        $this->modificacionesArchivo = [];
        $this->mensajeoperacion = "";
    }

    /**
     * @param int $id
     * @param string $nombre
     * @param string $desc
     * @param string $icon
     * @param Usuario $user
     * @param string $link
     * @param int $cantDes
     * @param int $cantUsad
     * @param string $fechaIni
     * @param string $fechaFin
     * @param string $clave
     */
    public function setear($id, $nombre, $desc, $icon, $user, $link, $cantDes, $cantUsad, $fechaIni, $fechaFin, $clave)
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

    //--------------------------------------------->>>>OBSERVADORES<<<<---------------------------------------------
    /**
     * @return int
     */
    public function getIdArchivoCargado()
    {
        return $this->idArchivoCargado;
    }
    /**
     * @return string
     */
    public function getAcNombre()
    {
        return $this->acNombre;
    }
    /**
     * @return string
     */
    public function getAcDescripcion()
    {
        return $this->acDescripcion;
    }
    /** 
     * @return Usuario 
     */
    public function getObjUsuario()
    {
        return $this->objUsuario;
    }
    /**
     * @return string
     */
    public function getAcIcono()
    {
        return $this->acIcono;
    }
    /**
     * @return string
     */
    public function getAcLinkAcceso()
    {
        return $this->acLinkAcceso;
    }
    /**
     * @return int
     */
    public function getAcCantidadDescarga()
    {
        return $this->acCantidadDescarga;
    }
    /**
     * @return int
     */
    public function getAcCantidadUsada()
    {
        return $this->acCantidadUsada;
    }
    /**
     * @return string
     */
    public function getAcFechaInicioCompartir()
    {
        return $this->acFechaInicioCompartir;
    }
    /**
     * @return string
     */
    public function getAceFechaFinCompartir()
    {
        return $this->aceFechaFinCompartir;
    }
    /**
     * @return string
     */
    public function getAcProtegidoClave()
    {
        return $this->acProtegidoClave;
    }
    /**
     * @return array
     */
    public function getModificacionesArchivo()
    {
        return $this->modificacionesArchivo;
    }
    /**
     * @return string
     */
    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    //--------------------------------------------->>>>MODIFICADORES<<<<---------------------------------------------
    /**
     * @param int $id
     */
    public function setIdArchivoCargado($id)
    {
        $this->idArchivoCargado = $id;
    }
    /**
     * @param string $nombre
     */
    public function setAcNombre($nombre)
    {
        $this->acNombre = $nombre;
    }
    /**
     * @param string $desc
     */
    public function setAcDescripcion($desc)
    {
        $this->acDescripcion = $desc;
    }
    /**
     * @param $user Usuario
     */
    public function setObjUsuario($user)
    {
        $this->objUsuario = $user;
    }
    /**
     * @param string $icon
     */
    public function setAcIcono($icon)
    {
        $this->acIcono = $icon;
    }
    /**
     * @param string $enlace
     */
    public function setAcLinkAcceso($enlace)
    {
        $this->acLinkAcceso = $enlace;
    }
    /**
     * @param int $cantDes
     */
    public function setAcCantidadDescarga($cantDes)
    {
        $this->acCantidadDescarga = $cantDes;
    }
    /**
     * @param int $cantUsad
     */
    public function setAcCantidadUsada($cantUsad)
    {
        $this->acCantidadUsada = $cantUsad;
    }
    /**
     * @param string $fechaIni
     */
    public function setAcFechaInicioCompartir($fechaIni)
    {
        $this->acFechaInicioCompartir = $fechaIni;
    }
    /**
     * @param $fechaFin
     */
    public function setAceFechaFinCompartir($fechaFin)
    {
        $this->aceFechaFinCompartir = $fechaFin;
    }
    /**
     * @param string $clave
     */
    public function setAcProtegidoClave($clave)
    {
        $this->acProtegidoClave = $clave;
    }
    /**
     * @param array $modificaciones
     */
    public function setModificacionesArchivo($modificaciones)
    {
        $this->modificacionesArchivo = $modificaciones;
    }
    /**
     * @param string $mensaje
     */
    public function setmensajeoperacion($mensaje)
    {
        $this->mensajeoperacion = $mensaje;
    }

    /**
     * solo necesitamos que el ArchivoCargado tenga su id seteado para cargar todos los demas valores
     * @return boolean
     */
    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM archivocargado WHERE idarchivocargado = " . $this->getidArchivoCargado();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $user = new Usuario();
                    $user->setIdUsuario($row['idusuario']);
                    $user->cargar();
                    $this->setear(
                        $row['idarchivocargado'],
                        $row['acnombre'],
                        $row['acdescripcion'],
                        $row['acicono'],
                        $user,
                        $row['aclinkacceso'],
                        $row['accantidaddescarga'],
                        $row['accantidadusada'],
                        $row['acfechainiciocompartir'],
                        $row['acefechafincompartir'],
                        $row['acprotegidoclave']
                    );
                }
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargado->listar: " . $base->getError());
        }
        return $resp;
    }

    /**
     * una vez que el ArchivoCargado tenga sus valores seteados insertamos un nuevo ArchivoCargado
     * con estos valores en la base de datos
     * @return boolean
     */
    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO archivocargado (acnombre, acdescripcion, acicono, idusuario, aclinkacceso, accantidaddescarga, accantidadusada, acfechainiciocompartir , acefechafincompartir, acprotegidoclave) VALUES( '" . $this->getAcNombre() . "' , '" . $this->getAcDescripcion() . "' , '" . $this->getAcIcono() . "' , " . $this->getObjUsuario()->getIdUsuario() . " , '" . $this->getAcLinkAcceso() . "' , " . $this->getAcCantidadDescarga() . " , " . $this->getAcCantidadUsada() . ", '" . $this->getAcFechaInicioCompartir() . "' , '" . $this->getAceFechaFinCompartir() . "' , '" . $this->getAcProtegidoClave() . "');";
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

    /**
     * si seteamos nuevos datos no nos alcanza utilizar un metodo set sobre el Usuario
     * sino que debemos reflejar los nuevos cambios sobre la base de datos
     * @return boolean
     */
    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE archivocargado SET acnombre='" . $this->getAcNombre() . "', acdescripcion='" . $this->getAcDescripcion() . "', acicono='" . $this->getAcIcono() . "', idusuario=" . $this->getObjUsuario()->getIdUsuario() . ", aclinkacceso='" . $this->getAcLinkAcceso() . "', accantidaddescarga=" . $this->getAcCantidadDescarga() . ", accantidadusada=" . $this->getAcCantidadUsada() . ", acfechainiciocompartir='" . $this->getAcFechaInicioCompartir() . "', acefechafincompartir='" . $this->getAceFechaFinCompartir() . "', acprotegidoclave='" . $this->getAcProtegidoClave() . "' WHERE idarchivocargado=" . $this->getIdArchivoCargado() ;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)>=0) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("ArchivoCargado->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargado->modificar: " . $base->getError());
        }
        return $resp;
    }

    /**
     * para borrar el ArchivoCargado de manera permanente lo debemos hacer en la base de datos
     * entonces al estar seteada el id, nos basta para buscarlos y realizar un DELETE
     * @return boolean
     */
    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM archivocargado WHERE idarchivocargado=" . $this->getidArchivoCargado();
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

    /**
     * guardamos los ArchivoCargado en un arreglo para poder manipular sobre ellos,
     * tenemos el parametro para cualquier especificacion sobre la busqueda de los ArchivoCargado
     * pero si el parametro es vacio solamente mostrarmos a los usuarios sin restricciones
     * @param string $parametro
     * @return array
     */
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
                    $obj->cargarModificaciones();
                    array_push($arreglo, $obj);
                }
            }
        } else {
            ArchivoCargado::setmensajeoperacion("ArchivoCargado->listar: " . $base->getError());
        }
        return $arreglo;
    }

    /**
     * como un archivo puede tener muchos ArchivoCargadoEstado que representa las distintas modificaciones
     * que pasa el archivo, podemos guardar estas modificaciones como historial en una coleccion
     */
    public function cargarModificaciones()
    {
        $modificaciones = ArchivoCargadoEstado::listar("idarchivocargado=" . $this->getIdArchivoCargado());
        $this->setModificacionesArchivo($modificaciones);
    }
}
