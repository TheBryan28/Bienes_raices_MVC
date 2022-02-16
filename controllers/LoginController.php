<?php 

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController {
    public static function login( Router $router) {

        $errores = [];
        $mensaje = $_GET['mensaje'] ?? null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validar();
        
            if(empty($errores)) {
                //mira si existe el usuario, devuelve null si no
                $resultado = $auth->existeUsuario();
                
                if( !$resultado ) {
                    $errores = Admin::getErrores();
                } else {
                    //revisar la password
                    $auth->comprobarPassword($resultado);

                    if($auth->autenticado) {
                       $auth->autenticar();
                    } else {
                        $errores =Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores,
            'mensaje'=>$mensaje
        ]); 
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}