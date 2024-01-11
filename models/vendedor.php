<?php   

namespace Model;

class Vendedor extends ActiveRecord{

    protected static $tabla ='vendedores';
    protected static $columnasDB = ['id', 'nombre','apellido','telefono','imagen','correo'];


    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $imagen;
    public $correo;

    public function __construct($args = [])
    {
       $this->id = $args['id'] ?? null;
       $this->nombre = $args['nombre'] ?? '';
       $this->apellido = $args['apellido'] ?? '';
       $this->telefono = $args['telefono'] ?? '';
       $this->imagen = $args['imagen'] ?? '';
       $this->correo = $args['correo'] ?? '';
      
    }

    public function validar()
    {
 
       if (!$this->nombre) {
          self::$errores[] = "Debes añadir un nombre";
       }
       if (!$this->apellido) {
          self::$errores[] = "Debes añadir un apellido";
       }
       if (!$this->telefono ){
          self::$errores[] = "Debes añadir un telefono ";
       }
       if (!$this->imagen) {
         self::$errores[] = "Debes añadir una Imagen";
      }
      if (!$this->correo) {
         self::$errores[] = "Debes añadir un correo";
      }
      //Expresion regular
      if(!preg_match('/[0-9]{10}/',$this->telefono) or !(strlen($this->telefono)===10)){
       
         self::$errores[]='Formato de Telefono no valido';
      }

      
       return self::$errores;
    }
}