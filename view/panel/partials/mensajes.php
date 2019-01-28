<!-- Los mensajes, los muestro y luego los borro para que no vuelvan a salir-->
<?php if ( isset($_SESSION["mensajes"]) AND count($_SESSION["mensajes"]) > 0 ) { ?>
    <?php foreach ($_SESSION["mensajes"] as $mensaje) { ?>

        <div class="alert alert-<?php echo $mensaje["tipo"]?> alert-dismissible fade show" role="alert">
            <?php echo $mensaje["mensaje"]?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php } ?>
    <!-- Borro mensajes, ya han sido mostrados y es inutil almacenarlos -->
    <?php unset($_SESSION["mensajes"]) ?>
<?php } ?>

