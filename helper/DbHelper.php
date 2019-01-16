<?php
/**
 * Created by PhpStorm.
 * User: web
 * Date: 11/01/2019
 * Time: 19:33
 */
namespace App\Helper;

class DbHelper
{
    var $db;

    function __construct()
    {
        //Conexion mediante POO
        $opciones = [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];

        try {
            $this->db = new \PDO('mysql:host=localhost;dbname=cms', 'root', 'root');
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'Falló la conexión: '. $e->getMessage();
        }
    }
}