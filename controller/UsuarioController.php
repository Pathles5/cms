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
use App\Model\Usuario;

class UsuarioController
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

    //Le llevo a la página de inicio de panel
    public function inicio(){
        //Permisos
        $this->view->permisos();

        $this->view->vistas("panel","index");

    }

    //Listado de usuarios
    function index(){

        //Permisos
        $this->view->permisos("usuarios");

        //Recojo los usuarios de la bbdd
        $datos = $this->db->query("SELECT * FROM usuarios");

        $this->view->vistas("panel","usuarios/index", $datos);

    }

    public function crear(){

        //Permisos
        $this->view->permisos("usuarios");

        //Creo un nuevo usuario vacio
        $usuario = new Usuario();

        //Llamar a la ventana editar
        $this->view->vistas("panel","usuarios/editar", $usuario);

    }

    public function editar($id){

        //Permisos
        $this->view->permisos("usuarios");

        //Comprueba permisos y redirecciona si fuese necesario
        $this->view->permisos("usuarios");

        if (isset($_POST["usuario"])){

            //Recupero datos del formulario, de manera segura
            $usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_STRING );
            $clave = filter_input(INPUT_POST, "clave", FILTER_SANITIZE_STRING );
            $noticias = (filter_input(INPUT_POST, "noticias", FILTER_SANITIZE_NUMBER_INT ) == "on") ? 1 : 0;
            $usuarios = (filter_input(INPUT_POST, "usuarios", FILTER_SANITIZE_NUMBER_INT ) == "on") ? 1 : 0;
            $cambiar_clave = (filter_input(INPUT_POST, "cambiar_clave", FILTER_SANITIZE_STRING ) == "on") ? 1 : 0;

            //Introducir si el usuario es nuevo, obligar a introducir una nueva contraseña y si editas, que sea voluntario

            //Encripto la clave
            $clave_encriptada=crypt($clave);

            if ($id == "nuevo") {

                //Creo nuevo user

                $consulta = $this->db->exec("INSERT INTO usuarios (usuario, clave, noticias, usuarios) VALUES ('$usuario','$clave_encriptada','$noticias','$usuarios')");

                ( $consulta > 0) ?
                    //Se crea correctamente
                    //Mensaje y redireccion
                    $this->view->mensajeYRedireccion("panel/usuarios", "success", "Usuario: <strong>$usuario</strong> se ha registrado.") :
                //Hubo algun error
                    //Mensaje y redireccion
                    $this->view->mensajeYRedireccion("panel/usuarios", "danger", "Hubu un  error al guardar en la base de datos." );


            }else{
                //Actualiza el usuario
                $consulta = $this->db->exec("UPDATE usuarios SET usuario='$usuario',clave='$clave_encriptada',noticias=$noticias,usuarios=$usuarios WHERE id=$id");

                //Se crea correctamente
                ( $consulta > 0) ?
                    //Se crea correctamente
                    //Mensaje y redireccion
                    $this->view->mensajeYRedireccion("panel/usuarios", "success", "Usuario: <strong>$usuario</strong> se ha actualizado.") :
                    //Hubo algun error
                    //Mensaje y redireccion
                    $this->view->mensajeYRedireccion("panel/usuarios", "danger", "Hubu un  error al actualizar en la base de datos." );


            }

        }
        else{

            //Obtengo usuario de bbdd
            $resultado = $this->db->query("SELECT * FROM usuarios WHERE id=".$id);
            $usuario = $resultado->fetchObject();

            //Llamar a la ventana editar
            $this->view->vistas("panel","usuarios/editar", $usuario);

        }

    }

    //Activa y desactiva segun el estado actual
    //Activa y desactiva segun el estado actual
    public function activar($id){
        //Permisos
        $this->view->permisos("usuarios");

        //Obtengo usuario de bbdd para activar/desactivar el estado activo
        $resultado = $this->db->query("SELECT * FROM usuarios WHERE id=".$id);


        if ($resultado) {
            $usuario = $resultado->fetchObject();
            if ($usuario->activo == 1) {

                //Desactivo usuario
                $consulta=$this->db->exec("UPDATE usuarios SET activo = 0 WHERE id='$id'");

                ( $consulta > 0) ?  //Compruebo para ver queno ha habido errores

                    $this->view->mensajeYRedireccion("panel/usuarios", "success", "Usuario: <strong>$usuario->usuario</strong> se ha desactivado.") :
                    $this->view->mensajeYRedireccion("panel/usuarios", "danger", "Hubu un  error al guardar en la base de datos." );

            }else{

                //Activo usuario
                $consulta=$this->db->exec("UPDATE usuarios SET activo = 1 WHERE id='$id'");

                ( $consulta > 0) ?  //Compruebo para ver queno ha habido errores

                    $this->view->mensajeYRedireccion("panel/usuarios", "success", "Usuario: <strong>$usuario->usuario</strong> se ha activado.") :
                    $this->view->mensajeYRedireccion("panel/usuarios", "danger", "Hubu un  error al guardar en la base de datos." );

            }
        }
    }

    public function borrar($id){
        //Permisos
        $this->view->permisos("usuarios");

        //Borro usuario
        $consulta=$this->db->exec("DELETE FROM usuarios WHERE id='$id'");

        ( $consulta > 0) ?  //Compruebo para ver queno ha habido errores

            $this->view->mensajeYRedireccion("panel/usuarios", "success", "Usuario: <strong>$usuario->usuario</strong> se ha borrado.") :
            $this->view->mensajeYRedireccion("panel/usuarios", "danger", "Hubu un  error al guardar en la base de datos." );

    }

    public function entrar(){

        if ( isset($_SESSION["usuario"])) {

            //Le llevo a la pag de inicio del panel
            $this->inicio();
        }
        else if ( isset($_POST["acceder"]) ) {

            //Recupero datos del formulario, de manera segura
            $usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_STRING );
            $clave = filter_input(INPUT_POST, "clave", FILTER_SANITIZE_STRING );

            //echo "El usuario es $usuario y la clave es $clave";

            //Busco el usuario introducido en la BBDD y lo asigno a un objeto
            $resultado = $this->db->query("SELECT * FROM usuarios WHERE usuario='".$usuario."' AND activo = 1");
            $user = $resultado->fetchObject();

            //Mi user es Antonio y 12345678


            //SI existe el usuario
            if ($user) {
                //echo "El user existe";
                if (hash_equals($user->clave, crypt($clave, $user->clave))) {
                    //echo "¡Contraseña verificada!";

                    //Asigno el usuario a la sesion
                    $_SESSION["usuario"] = $user;

                    //Mensaje de entrada y redireccion

                    //Mensaje y redireccion
                    $this->view->mensajeYRedireccion("panel", "success", "Bienvenido al panel de control." );

                }
                else{
                    //echo "MALA PASS";
                    //Mensaje de error y redireccion

                    //Mensaje y redireccion
                    $this->view->mensajeYRedireccion("panel", "danger", "Error al acceder al panel de administraccion." );
                }
            }
            else {

                //Mensaje y redireccion
                $this->view->mensajeYRedireccion("panel", "danger", "No existe ningún usuario con ese nombre." );
            }
        }
        else {
            //Te llevo a la pagina de acceso, para verificar el usser.
            $this->view->vistas("panel","usuarios/entrar");
        }

    }

    public function salir(){

        //Borro al usuario
        unset($_SESSION["usuario"]);
        //Mensaje de exito en el cierre de sesión
        $this->view->mensajeYRedireccion("panel", "success", "Te has desconectado con exito." );

    }
}