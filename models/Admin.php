<?php  

namespace Model;


class Admin extends ActiveRecord{

    //BAse de datos 
    protected static $tabla='usuarios';

    protected static $columnasDB=['id','email','password'];


    public $id;
    public $email;
    public $password;

    public function __construct($args=[]){

        $this->id= $args['id']??null;
        $this->email= $args['email']??'';
        $this->password= $args['password']??'';
    }


    public  function validar()
    {
        
        if(!$this->email){
          self::$errores[]='El email es obligatorio';
        }
        if(!$this->password){
            self::$errores[]='El password es obligatorio';
        }

        return self::$errores;
    }

    public function findByEmail(){

        $query = "SELECT * FROM " . static::$tabla ." WHERE email='$this->email'" . "LIMIT 1";
        $result = self::consultarSQL($query);

  
        if(!$result){
            self::$errores[]='El usuario no existe';
            return;
        }

        return array_shift($result);

    }


    public function verifyPassword($resultado){

        
        $autenticado=password_verify($this->password,$resultado->password);

        if(!$autenticado){
            self::$errores[]='El password es incorrceto';
        }
        return $autenticado;

    }

    public function autenticar(){
        session_start();


        //LLenar el arreglo de session
        $_SESSION['usuario']=$this->email;
        $_SESSION['login']=TRUE;

        header('Location: /admin');
    }

    


}

