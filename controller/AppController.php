<?php
/**
 * Created by PhpStorm.
 * User: web
 * Date: 11/01/2019
 * Time: 19:31
 */
namespace App\Controller;

class AppController
{

    public function index(){

        echo "Esto es la home";

    }

    public function acercade(){

        echo "Esto es acerca de";

    }

    public function noticias(){

        echo "Esto es noticias";

    }

    public function noticia($slug){

        echo "Esta es la noticia: ".$slug;

    }
}