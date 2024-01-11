<?php

define('TEMPLATES_URL',__DIR__.'/templates');
define('FUNCIONES_URL',__DIR__.'/funciones.php');
define('CARPETAS_IMAGENES',$_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function IncludeTemplate(string $template,bool $inicio=false){

    include TEMPLATES_URL."/$template.php";
}

function autetication(){

    session_start();

    if(!$_SESSION['login']){
      header('Location: /');
    }
}

function debugger($variable){

    echo "<pre>";
    echo var_dump($variable);
    echo "<pre>";
    exit;

}


//Escapa/ sanitizar el HTML

function s($html):string{
$s=htmlspecialchars($html);

return $s;
}


function ValidarTipoContenido($tipo){
    $tipos=['vendedor', 'propiedad'];

    return in_array($tipo,$tipos);
}


function MostrarNotificacion($codigo){

    switch($codigo){

        case 1:{
            $mostrar['mensaje']='Creado Correctamente';
            $mostrar['tipo']='exito';
            break;
        }
        case 2:{
            $mostrar['mensaje']='Actualizado Correctamente';
            $mostrar['tipo']='actualizado';
            break;
        }
        case 3:{
            $mostrar['mensaje']='Eliminado Correctamente';
            $mostrar['tipo']='eliminado';
            break;
        }

        default:{
            $mostrar=FALSE;
            break;
        }
    }


    return $mostrar;
}


function redireccionar(string $url){
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location:'.$url);
    }

    return $id;
}
