<?php

function connectDB(){

    $db= new mysqli('localhost','root','123456789','bienesraicesdb');



    if(!$db){
   echo "Error no se pudo conectar";
   exit;
    }

    return $db;
    
}