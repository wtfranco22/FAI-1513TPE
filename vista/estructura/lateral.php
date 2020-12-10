<div class="row">
    <nav id="menu" class="col-md-3 col-lg-2 d-md-block collapse">
        <div class="list-group">
        <a href="../formularios/contenido.php?" class="text-dark list-group-item">
                Inicio</a>
            <a href="../formularios/perfilCuenta.php" class="text-dark list-group-item">
                Perfil</a>
                <?php if($comienzaSesion->rolAutorizado('administrador')):
                    //como administrador le damos la herramienta para administrar a los usuarios ?>
            <a href="../formularios/administrarUsuarios.php" class="text-dark list-group-item">
                Administrar Usuarios</a>
                <?php endif; ?>
            <a href="?cerrar=salir" class="text-danger list-group-item">
                Cerrar Sesion</a>
        </div>
    </nav>
    <div class="col-md-9 col-lg-10 bg-light">
