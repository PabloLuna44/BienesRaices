<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{

    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores= Vendedor::all();
        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' =>$vendedores
        ]);
    }



    public static function create(Router $router)
    {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $propiedad = new Propiedad($_POST['propiedad']);



            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImage($nombreImagen);
            }

            //validar

            $errores = $propiedad->validar();

            //REvisar que el array de errores este vacio

            if (empty($errores)) {

                //Crea la carpeta para subir imagenes
                if (!is_dir(CARPETAS_IMAGENES)) {
                    mkdir(CARPETAS_IMAGENES);
                }

                //Guarda la imagen en el servidor
                $image->save(CARPETAS_IMAGENES . $nombreImagen);

                //Guarda en la base de datos
                $propiedad->save();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }



    public static function update(Router $router)
    {
       $id=redireccionar('/admin');

        $vendedores = Vendedor::all();
        //Obtener datos de una propiedad
        $propiedad = Propiedad::findById($id);
        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if(!$propiedad){
            header('Location: /admin');
        }

        //Metodod post para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            //Asignar los atributos
            $args = [];
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);

            $errores = $propiedad->validar();

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";



            //Subida de archivos
            //Realiza un resize a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImage($nombreImagen);
            }


            if (empty($errores)) {

                //Almacenar imagen
                if ($image) {
                    $image->save(CARPETAS_IMAGENES . $nombreImagen);
                }
                $propiedad->save();
            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }


    public static function delete(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
          
            if ($id) {
        
                $tipo = $_POST['tipo'];
                if (ValidarTipoContenido($tipo)) {
        
                    $propiedad = Propiedad::findById($id);
                    $result = $propiedad->delete();

                    if ($result) {
                        header("Location: /admin?resultado=3");
                    }
                }
            }
        }

    }
}
