<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class VendedorController
{

 
    public static function create(Router $router)
    {

       $vendedor=new Vendedor;
       $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $vendedor = new Vendedor($_POST['vendedor']);

            
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800, 600);
                $vendedor->setImage($nombreImagen);
            }

            //validar

            $errores = $vendedor->validar();

            //REvisar que el array de errores este vacio

            if (empty($errores)) {

                //Crea la carpeta para subir imagenes
                if (!is_dir(CARPETAS_IMAGENES)) {
                    mkdir(CARPETAS_IMAGENES);
                }

                //Guarda la imagen en el servidor
                $image->save(CARPETAS_IMAGENES . $nombreImagen);

                //Guarda en la base de datos
                $vendedor->save();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor'=>$vendedor,
            'errores' => $errores
        ]);
    }



    public static function update(Router $router)
    {
       $id=redireccionar('/admin');

        $vendedor = Vendedor::findById($id);

        if(!$vendedor){
            header('Location: /admin');
        }

        //Arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        //Metodod post para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Asignar los atributos
            $args = [];
            $args = $_POST['vendedor'];

            $vendedor->sincronizar($args);

            $errores = $vendedor->validar();

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Subida de archivos
            //Realiza un resize a la imagen con intervention
            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800, 600);
                $vendedor->setImage($nombreImagen);
            }


            if (empty($errores)) {

                //Almacenar imagen
                if ($image) {
                    $image->save(CARPETAS_IMAGENES . $nombreImagen);
                }

                $vendedor->save();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
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
        
                    $vendedor = Vendedor::findById($id);
                    $result = $vendedor->delete();

                    if ($result) {
                        header("Location: /admin?resultado=3");
                    }
                }
            }
        }

    }
}
