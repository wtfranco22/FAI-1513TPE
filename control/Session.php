<?php

class Session
{
	/**
	 * inicializamos la clase
	 */
	public function __construct()
	{
		session_start();
	}

	/**
	 * busca al usuario si existe y es valida su contraseña
	 * @return boolean
	 */
	public function validar($param)
	{
		$resp = false;
		$usuario = new AbmUsuario();
		$datos['uslogin'] = $param['usuario'];
		if(isset($parma['clave'])){
			$datos['usclave'] = $param['clave'];
		}
		$datos['usactivo'] = 1;
		$encontrado = $usuario->buscar($datos);
		if ($encontrado != null) {
			$resp = true;
			$this->iniciar($encontrado[0]);
		}
		return $resp;
	}

	/**
	 * @param Usuario $objUsuario
	 */
	private function iniciar($objUsuario)
	{
		$_SESSION['login'] = $objUsuario->getUsLogin();
		$_SESSION['idusuario'] = $objUsuario->getIdUsuario();
		$_SESSION['nombre'] = $objUsuario->getUsNombre();
		$_SESSION['apellido'] = $objUsuario->getUsApellido();
		$_SESSION['roles'] = $objUsuario->getRoles();
		$_SESSION['correo'] = $objUsuario->getUsCorreo();
	}

	/**
	 * @return int
	 */
	public function getIdUsuario()
	{
		return $_SESSION['idusuario'];
	}

	/**
	 * @return string
	 */
	public function getCorreoUsuario()
	{
		return $_SESSION['correo'];
	}

	/**
	 * @return string
	 */
	public function getLoginUsuario()
	{
		return $_SESSION['login'];
	}
	/**
	 * @return string
	 */
	public function getNombreUsuario()
	{
		return $_SESSION['nombre'];
	}
	/**
	 * @return string
	 */
	public function getApellidoUsuario()
	{
		return $_SESSION['apellido'];
	}
	/**
	 * verifica que exista la sesion
	 * @return boolean
	 */
	public function activa()
	{
		$resp = false;
		if (isset($_SESSION['login'])) {
			$resp = true;
		}
		return $resp;
	}

	/**
	 * se encarga de cerrar la sesion activa
	 */
	public function cerrar()
	{
		if ($this->activa()) {
			session_destroy();
		}
	}

	/**
	 * ingresa un rol y verificamos si el usuario posee dicho rol
	 * @return boolean
	 */
	public function rolAutorizado($param)
	{
		$resp = false;
		$i = 0;
		$roles = $_SESSION['roles'];
		while ($i < count($roles) && !$resp) {
			$resp = $roles[$i]->getDescripcion() == $param;
			$i++;
		}
		return $resp;
	}

	/**
	 * recarga los datos, es para poder setear los nuevos cambiar que sufrio el usuario
	 */
	public function reCargar($param)
	{
		return $this->validar(['usuario' => $param['login']]);
	}

	/**
	 * como el usuario esta recuperando la contraseña, solo lo buscamos por codigo
	 * @param string $param
	 * @return boolean
	 */
	public function recuperando($param)
	{
		$listado = Usuario::listar("usclave='" . $param['usclave']."'");
		$usuario = $listado[0];
		$resp=false;
		if($usuario!=null){
			$this->iniciar($usuario);
			$resp = true;
		}
		return $resp;
	}
}
