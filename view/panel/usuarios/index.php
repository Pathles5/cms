<!--
Todo esto es mio y lo activo de jairus
<h3>Usuarios:</h3>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Usuario</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>nombre</td>
            <td>botones</td>
        </tr>
    </tbody>
</table>
-->
<div class="container-fluid">
    <div class="row ">
        <h3 class="col-9">Usuarios</h3>
        <div class="iconos col-3 text-right">
            <a href="<?php echo $_SESSION['home'] ?>panel/usuarios/crear" title="añadir">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>
    <!--Cabecera -->
    <div class="row cabecera_listdo no-gutters">
        <div class="col-9">
            USUARIO
        </div>
        <div class="col-3 text-right">
            ACCIONES
        </div>
    </div>

    <!--Recorro usuarios -->
    <?php while ($usuario=$datos->fetchObject() ){   ?>
        <div class="row item_listado no-gutters">

            <div class="col-9">
                <a href="<?php echo $_SESSION['home'] ?>panel/usuarios/editar/<?php echo $usuario->id ?>" title="añadir">
                    <?php echo $usuario->usuario ?>
                </a>
            </div>

            <div class="col-3 text-right">

                <!--editar-->
                <a href="<?php echo $_SESSION['home'] ?>panel/usuarios/editar/<?php echo $usuario->id ?>" title="añadir">
                    <i class="fas fa-pencil-alt"></i>
                </a>

                <!--activar/desactivar-->
                <?php $clase = ($usuario->activo ==1 ) ? "verde" : "rojo" ?>
                <?php $icono = ($usuario->activo ==1 ) ? "up" : "down" ?>
                <a class="<?php echo $clase ?>" href="<?php echo $_SESSION['home'] ?>panel/usuarios/activar/<?php echo $usuario->id ?>" title="activar/desactivar">
                    <i class="far fa-thumbs-<?php echo $icono ?>"></i>
                </a>

                <!--Borrar-->
                <a class="boton_borrar" data-id="<?php echo $usuario->id ?>" title="añadir">
                    <i class="far fa-trash-alt"></i>
                </a>

            </div>

        </div>
        <div class="col-12 mensaje_borrar" id="<?php echo $usuario->id ?>">
            <p>¿Seguro que desea borrar al usuario: <strong><?php echo $usuario->usuario ?></strong>?</p>
            <p><small>Esta accion no se puede deshacer</small></p>
            <a href="<?php echo $_SESSION['home'] ?>panel/usuarios/borrar/<?php echo $usuario->id ?>" title="borrar usuario">
                Borrar
            </a>
            <a class="boton_borrar" data-id="<?php echo $usuario->id ?>">
                Cancelar
            </a>
        </div>
    <?php } ?>

</div>