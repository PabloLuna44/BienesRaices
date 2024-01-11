<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{


    public static function index(Router $router)
    {
        $inicio = TRUE;
        $propiedades = Propiedad::getLimit(3);

        $router->render('paginas/index', [
            'inicio' => $inicio,
            'propiedades' => $propiedades

        ]);
    }

    public static function nosotros(Router $router)
    {

        $router->render('paginas/nosotros');
    }
    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router)
    {
        $id = redireccionar('/propiedad');
        $propiedad = Propiedad::findById($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router)
    {
        $router->render('paginas/blog');
    }
    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada');
    }
    public static function contacto(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $contacto = $_POST['contacto'];
            $mensaje=null;


            //Crear una nueva instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'e949f99a181394';
            $mail->Password = 'e75e22c0b81697';
            $mail->SMTPSecure = 'tls';

            //Configurar el contenido del mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';


            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje </p>';
            foreach ($contacto as $key => $value) :
                
                if($value==='telefono'){
                    $contenido.='<p> Eligio ser contactado por telefono </p>';
                }else if($value==='email'){
                    $contenido.='<p> Eligio ser contactado por email </p>';
                }
                $contenido .= '<p>' . strtoupper($key) . ':' . $value . '</p>';
            endforeach;
            $contenido .= '</html>';

            

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es un texto alternativo sin HTML';


            //Enviar el email
            if ($mail->send()) {
                $mensaje='Mensaje enviado correctamente';
            } else {
                $mensaje= 'El mensaje no fue enviado';
            }
        }

        $router->render('paginas/contacto',[
        'mensaje'=>$mensaje
        ]);
    }
}
