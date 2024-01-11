<?php  
 namespace Model;
 
class ActiveRecord
{

   //Base de datos
   protected static $db;
   protected static $columnasDB = [];
   protected static  $tabla='';

   //Definir la conexion a la DB
   public static function setDB($database)
   {
      self::$db = $database;
   }

   //Errores 
   protected static $errores = [];

  

   public function save()
   {
      if (!is_null($this->id)) {
         //Actualizar
         if($this->update()){
               // echo "Insertado correctamente";
               //Redireccionar al usuario
               header('Location: /admin?resultado=2');
         }
      } else {
         //Crea un nuevo registro
         if($this->create()){
           
               // echo "Insertado correctamente";
               //Redireccionar al usuario
               header('Location: /admin?resultado=1');
           
         }
      }
   }

   public function create()
   {

      //Sanitizar lo datos
      $atributos = $this->sanitizarAtributos();
      //Insertar en la base de dayos
      $query = "INSERT INTO " . static::$tabla ."(";
      $query .= join(', ', array_keys($atributos));
      $query .= " ) VALUES ('";
      $query .= join("', '", array_values($atributos));
      $query .= "')";


      $result = self::$db->query($query);

      return $result;
   }


   public function update()
   {
      //Sanitizar
      $atributos = $this->sanitizarAtributos();
      $values = [];
      foreach ($atributos as $key => $value) {
         $values[] = "{$key}='{$value}'";
      }

      $query = "UPDATE " . static::$tabla ." SET ";
      $query .= join(', ', $values);
      $query .= " WHERE  id='" . self::$db->escape_string($this->id) . "' ";
      $query .= "LIMIT 1";


      $resultado = self::$db->query($query);

      return $resultado;
   }

   public function delete(){
      //Eliminar de la base de datos
      $query="DELETE FROM " . static::$tabla ." WHERE id=". self::$db->escape_string($this->id) . " LIMIT 1";
      $result=self::$db->query($query);

      $this->deleteImage();

      return $result;
   }


   public function deleteImage(){
     //Eliminar imagen
       //Comprobar si existe el archivo
       $FileExist = file_exists(CARPETAS_IMAGENES . $this->imagen);

       if ($FileExist) {
          unlink(CARPETAS_IMAGENES . $this->imagen);
       }

   }

   //Idetificar y unir los atributos de la DB 
   public function atributos()
   {
      $atributos = [];
      foreach (static::$columnasDB as $row) {
         if ($row === 'id') continue;
         $atributos[$row] = $this->$row;
      }

      return $atributos;
   }

   public function sanitizarAtributos()
   {
      $atributos = $this->atributos();
      $sanitizado = [];

      foreach ($atributos as $key => $value) {
         $sanitizado[$key] = self::$db->escape_string($value);
      }
      return $sanitizado;
   }


   //Subida de archivos
   public function setImage($imagen)
   {
      //Elimina la imagen previa

      if (!is_null($this->id)) {
       $this->deleteImage();
      }

      if ($imagen) {
         $this->imagen = $imagen;
      }
   }


   //Validacion
   public static function getErrores()
   {
      return static::$errores;
   }

   public function validar()
   {

      static::$errores=[];
      return static::$errores;
   }


   //Listar todas las propiedades

   public static function all()
   {
      $query = "SELECT * FROM ". static::$tabla;

      $result = self::consultarSQL($query);

      return $result;
   }

   //Busca un registro por su id
   public static function findById($id)
   {
      $query = "SELECT * FROM " . static::$tabla ." WHERE id='$id'";
      $result = self::consultarSQL($query);

      return array_shift($result);
   }

   public static function consultarSQL($query)
   {
      //Consultar base de datos
      $resultado = self::$db->query($query);
      //Iterar los resultados
      $array = [];
      while ($row = $resultado->fetch_assoc()) {
         $array[] = static::crearObjeto($row);
      }
      //Liberar la memoria 
      $resultado->free();
      //Retornar los resultados
      return $array;
   }


   protected static function crearObjeto($row)
   {

      $objeto = new static;

      foreach ($row as $key => $value) {
         if (property_exists($objeto, $key)) {
            $objeto->$key = $value;
         }
      }
      return $objeto;
   }


   //Sincroniza el objeto en memoria con los cambios realizados por el usuario
   public function sincronizar($args = [])
   {

      foreach ($args as $key => $value) {
         if (property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
         }
      }
   }

   //Obtiene determinado numero de registros
   public static function getLimit($number){

      $query = "SELECT * FROM ". static::$tabla ." LIMIT ".$number;

      $result = self::consultarSQL($query);

      return $result;

   }
}
