<?php
/**
 * Created by PhpStorm.
 * User: web
 * Date: 11/01/2019
 * Time: 19:34
 */
namespace  App\Helper;

class ViewHelper
{

    public function vistas($carpeta,$archivo, $datos=null){

        require("../view/$carpeta/partials/header.php");
        require("../view/$carpeta/partials/menu.php");
        require("../view/$carpeta/partials/mensajes.php");
        require("../view/$carpeta/$archivo.php");
        require("../view/$carpeta/partials/footer.php");

    }

    public function mensajeYRedireccion( $ruta, $tipo, $texto ){

        $_SESSION['mensajes']=array("tipo" => $tipo, "mensaje" => $texto);
        header("Location:".$_SESSION['home'].$ruta);

    }

    public function permisos( $permiso=null){

        if (isset($_SESSION['usuario']) AND ( $permiso == null OR $_SESSION['usuario']->$permiso ==1 ) ) {
            return true;
        }else{
            $this->mensajeYRedireccion("panel", "warning", "No tienes permiso para realizar ésta operación.");
        }


    }

}