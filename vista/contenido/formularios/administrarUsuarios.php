<?php
include_once("../../estructura/cabecera.php");
?>
<?php
if (!($comienzaSesion->activa() && $comienzaSesion->rolAutorizado('administrador'))) {
    header("Location:ingresarCuenta.php");
    die();
}
$datos = data_submitted();
$listar = new AbmUsuario();
if (!isset($datos['indice']))
    $datos['indice'] = 'todos';
switch ($datos['indice']) {
    case 'nombre':
        $listadoUsuarios = $listar->buscar(['usnombre' => ($datos['valor'])]);
        break;
    case 'apellido':
        $listadoUsuarios = $listar->buscar(['usapellido' => ($datos['valor'])]);
        break;
    case 'id':
        $listadoUsuarios = $listar->buscar(['idusuario' => ($datos['valor'])]);
        break;
    case 'noactivo':
        $listadoUsuarios = $listar->buscar(['usactivo' => 0]);
        break;
    case 'rol':
        $listar = new AbmRol();
        $listaRol = $listar->buscar(['roldescripcion' => $datos['valor']]);
        $listadoUsuarios = $listaRol[0]->getUsuarios();
        break;
    default:
        $listadoUsuarios = $listar->buscar(null);
        break;
}
?>

<h2 class="text-center"><a class="float-left btn btn-outline-danger" href="contenido.php?">&#xf060;</a>Administración de Usuarios</h2>
<form id="buscar" name="buscar" class="m-5 shadow" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" data-toggle="validator" autocomplete="off">
    <div class="input-group">
        <select class="col-4 form-control border border-success" id="indice" name="indice">
            <option value="todos">Todos los usuarios</option>
            <option value="id">ID usuario</option>
            <option value="nombre">Nombre</option>
            <option value="apellido">Apellido</option>
            <option value="rol">Rol</option>
            <option value="noactivo">No activos</option>
        </select>
        <input class="form-control border border-success" type="text" id="valor" name="valor" value="" placeholder="Buscar...">
        <button type="submit" class="btn btn-success">&#xf002;</button>
    </div>
</form>
<form class="shadow" id="adminUser" name="adminUser" action="../acciones/accionAdminUser.php" method="POST" data-toggle="validator">
    <table class="table">
        <thead class="table-success text-center">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Login</th>
                <th scope="col">activo</th>
                <th scope="col">roles</th>
                <th scope="col">activo</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php
            foreach ($listadoUsuarios as $objUsuario) : ?>
                <tr>
                    <th> <?php echo $objUsuario->getIdUsuario(); ?> </th>
                    <td> <?php echo $objUsuario->getUsNombre(); ?> </td>
                    <td> <?php echo $objUsuario->getUsApellido(); ?> </td>
                    <td> <?php echo $objUsuario->getUsLogin(); ?> </td>
                    <td> <?php echo $objUsuario->getUsActivo(); ?> </td>
                    <td>
                        <select class="form-control">
                            <?php foreach ($objUsuario->getRoles() as $rol) : ?>
                                <option value=""> <?php echo $rol->getDescripcion(); ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <?php
                        if ($objUsuario->getUsActivo() == 1) {
                            echo "<button type='submit' class='btn btn-danger' id='baja' name='baja' value='" . $objUsuario->getIdUsuario() . "'> Dar Baja </button>";
                        } else {
                            echo "<button type='submit' class='btn btn-success' id='alta' name='alta' value='" . $objUsuario->getIdUsuario() . "'> Dar Alta </button>";
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>
<form id="adminModificarUsuario" name="adminModificarUsuario" class="m-5 shadow" action="../acciones/accionAdminUser.php" method="POST" data-toggle="validator" autocomplete="off">
    <div class="input-group">
        <select class="form-control border border-success" id="accionRolUser" name="accionRolUser">
            <option value="">Modificar Rol</option>
            <option value="agregarRolUser">Nuevo</option>
            <option value="quitarRolUser">Eliminar</option>
        </select>
        <input type="number" id="idusuario" name="idusuario" class="form-control border border-success" placeholder="ID usuario">
        <input class="form-control border border-success" type="text" id="valorRol" name="valorRol" placeholder="Descripción del rol">
        <button type="submit" class="btn btn-success">Enviar</button>
    </div>
</form>

<?php
include_once("../../estructura/pie.php");
?>