<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{

    public static function login(Router $router)
    {


        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $auth = new Admin($_POST['user']);

            $errores = $auth->validar();

            if (empty($errores)) {
                //Verificar si el usuario existe 
                $result = $auth->findByEmail();

                if (!$result) {

                    $errores = Admin::getErrores();
                } else {
                    //Verificar el password
                    $autenticado = $auth->verifyPassword($result);

                    if ($autenticado) {
                        //Autenticar al usuario
                        $auth->autenticar();

                    } else {
                        //Password incorrceto (mensaje de error)s
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout()
    {
     session_start();
     
     $_SESSION=[];

     header('Location: /');
    }
}
