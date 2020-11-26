<?php

class AbmSession
{
	/**
	 * inicializamos la clase
	 */
	public function __construct()
	{
		session_start();
	}

	/**
	 * @param string $nombreUsuario
	 * @param string $psw
	 */
	public function iniciar($nombreUsuario, $psw)
	{
		$_SESSION['usnombre'] = $nombreUsuario;
		$_SESSION['usclave'] = $psw;
	}

	/**
	 * busca al usuario si existe y es valida su contraseña
	 * @return boolean
	 */
	public function validar()
	{
		$resp = false;
		$usuario = new AbmUsuario();
		$encontrado = $usuario->buscar($_SESSION);
		if ($encontrado != null) {
			$resp = true;
			unset($_SESSION['usclave']);
		}
		return $resp;
	}

	/**
	 * verifica que exista la sesion
	 * @return boolean
	 */
	public function activa()
	{
		$resp = false;
		if (isset($_SESSION['usnombre'])) {
			$resp = true;
		}
		return $resp;
	}

	/**
	 * vamos a buscar al usuario si es que existe y es valido
	 * @return Usuario
	 */
	public function getUsuario()
	{
		if ($this->validar() && $this->activa()) {
			$usuario = new AbmUsuario();
			$lista = $usuario->buscar($_SESSION);
			$objUsuario = $lista[0];
		}
		return $objUsuario;
	}

	/**
	 * Obtenemos los roles que tiene el usuario actual
	 * @return array
	 */
	public function getRol()
	{
		$rolesUsuario=[];
		if ($this->getUsuario() !== null) {
			$usLogeado = $this->getUsuario();
			$rolesUsuario = $usLogeado->getRoles();
		}
		return $rolesUsuario;
	}

	/**
	 * se encarga de cerrar la sesion activa
	 */
	public function cerrar()
	{
		if ($this->activa()) {
			unset($_SESSION['usnombre']);
			session_destroy();
		}
	}
}
