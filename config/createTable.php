<?php
//Crea la tabla usuarios si no existe

//Información adicional del trabajador obtenible en otra tabla(escalable)

require 'conexionDB.php';

$sql = "CREATE TABLE IF NOT EXISTS jornadas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        codigo_trabajador INTEGER NOT NULL,
        hora_entrada DATETIME NOT NULL, 
        hora_salida DATETIME,
        tiempo_total TEXT
        )";

$db->exec($sql);

//Version 2.0
?>