<!--<form method="post">
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>
                    Usuario: <input type="text" class="form-control" value="">
                </label>
            </div>
            <div class="form-group">
                <label>
                    Constraseña: <input type="password" class="form-control" placeholder="New Password">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check">
                <label class="form-check-label"><input type="checkbox" class="form-check-input">Ver listado de usuarios</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="checkbox" class="form-check-input">Noticias</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="checkbox" class="form-check-input">Permiso1</label>
            </div>
        </div>
    </div>

    <div class="container">
        <button type="submit" class="btn btn-warning">Cambiar</button>
    </div>
</form>
-->

<!--Usuario -->

<div class="container-fluid">
    <div class="row ">
        <h3 class="col-9">
            <?php echo ($datos->id) ? "Editar" : "Crear" ?>
             usuarios
        </h3>

        <div class="iconos col-3 text-right">
            <a href="<?php echo $_SESSION['home'] ?>panel/usuarios/" title="volver">
                <i class="fas fa-undo-alt"></i>
            </a>
            <a onclick="editar.submit()" title="guardar">
                <i class="far fa-save"></i>
            </a>
        </div>
    </div>

    <?php $id = ($datos->id) ? $datos->id : "nuevo" ?>

    <form method="post" name="editar" action="<?php echo $_SESSION['home'] ?>panel/usuarios/editar/<?php echo $id ?>">
        <div class="row edicion">
            <div class="col-6">
                <strong>
                    Usuario: <br>
                    <input type="text" name="usuario" value="<?php echo $datos->usuario ?>">
                </strong><br>

                <strong>
                    Clave: <br>
                    <input type="text" name="usuario" value="<?php echo $datos->clave ?>">
                </strong>
            </div>

            <div class="col-6">
                <strong>Último acceso: </strong> <br>
                <?php echo ($datos->fecha_acceso) ? date("d/m/Y H:i", strtotime( $datos->fecha_acceso )) : "" ?>
                <br><br>
                <strong>Permisos:</strong><br>
                <label>
                    <input type="checkbox" name="noticias" <?php echo ($datos->noticias == 1) ? "checked" : "" ?>>
                    Noticias
                </label><br>
                <label>
                    <input type="checkbox" name="usuarios" <?php echo ($datos->usuarios == 1) ? "checked" : "" ?>>
                    Usuarios
                </label>
            </div>
        </div>
    </form>
</div>