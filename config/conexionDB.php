<?php
//Conexión a la base de datos SQLite
//Si no existe la base de datos, se crea automáticamente
//PHP Data Objects (PDO).
$dbPath = __DIR__ . '/../database/database.sqlite';

 try{
    $db = new PDO('sqlite:'. $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 }catch(PDOException $e){
    die("Error al conectar base de datos: " . $e->getMessage());
 }
?>