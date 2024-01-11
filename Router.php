<?php  

namespace MVC;

class Router{


public $routesGET=[];
public $routesPOST=[];


public function get($url,$fn){

    $this->routesGET[$url]=$fn;
}

public function post($url,$fn){
    $this->routesPOST[$url]=$fn;
}



public function CheckRoutes(){

    session_start();

    $auth=$_SESSION['login']??null;

    //Arreglo de rutas protegidas...
    $protectedRoutes=[
        '/admin',
        '/propiedades/crear',
        '/propiedades/atualizar',
        '/propiedades/eliminar',
        '/vendedores/crear',
        '/vendedores/actualizar',
        '/vendedores/eliminar'
    ];

    $CurrentURL=$_SERVER['PATH_INFO']?? '/';
    $method=$_SERVER['REQUEST_METHOD'];

    if($method==='GET'){

        $fn=$this->routesGET[$CurrentURL]?? null;

    }else if($method==='POST'){

        $fn=$this->routesPOST[$CurrentURL]?? null;
    }

    //Protege las rutas
    if(in_array($CurrentURL,$protectedRoutes) && !$auth){
        header('Location: /');
    }

    if($fn){
        //La URL existe y hay una funcion asociada
        call_user_func($fn,$this);

    }else{
        echo "Pagina No Encontrada";
    }

}


//Muestra una vista 
public function render($view, $data=[]){

    
    foreach($data as $key => $value){

        $$key=$value; //El doble signo de dollar crea una variable por cada atributo  del arreglo y lo inicializa su valor asociado
    }

    ob_start();//Almacenamieto en memoria durante un momento...

    include __DIR__ . '/views/'.$view.'.php';
    
    $contenido=ob_get_clean();//Limpia el buffer para que el servidor no consuma memoria

    include __DIR__ . '/views/layout.php';

}




}

