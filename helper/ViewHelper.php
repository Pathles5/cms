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
        require("../view/$carpeta/$archivo.php");
        require("../view/$carpeta/partials/footer.php");

    }

}