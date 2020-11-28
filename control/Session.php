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
		$datos['usclave'] = $param['clave'];
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
		$_SESSION['roles'] = $objUsuario->getRoles();
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
			unset($_SESSION['login']);
			unset($_SESSION['idusuario']);
			unset($_SESSION['nombre']);
			unset($_SESSION['roles']);
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
}
