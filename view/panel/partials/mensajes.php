<!-- Los mensajes, los muestro y luego los borro para que no vuelvan a salir-->
<?php if ( isset($_SESSION["mensajes"]) ) { ?>

        <div class="alert alert-<?php echo $_SESSION["mensajes"]["tipo"]?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION["mensajes"]["mensaje"]?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <!-- Borro mensajes, ya han sido mostrados y es inutil almacenarlos -->
    <?php unset($_SESSION["mensajes"]) ?>
<?php } ?>

