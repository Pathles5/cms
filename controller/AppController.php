<?php
/**
 * Created by PhpStorm.
 * User: web
 * Date: 11/01/2019
 * Time: 19:31
 */
namespace App\Controller;
use App\Helper\ViewHelper;
use App\Helper\DbHelper;

class AppController
{

    var $view;
    var $db;


    function __construct()
    {
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;

        $dbHelper = new DbHelper();
        $this->db = $dbHelper->db;
    }

    public function index(){

        $this->view->vistas("app","index", "Antonio");

    }

    public function acercade(){

        $this->view->vistas($this->carpeta,"acerca-de");
    }

    public function noticias(){

        $this->view->vistas($this->carpeta,"noticias");

    }

    public function noticia($slug){

        $this->view->vistas($this->carpeta,"noticia");

    }




}