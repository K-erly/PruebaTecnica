<?php
require 'conexionDB.php';
require 'createTable.php';


$stmt = $db->prepare("INSERT INTO jornadas (codigo_trabajador, hora_entrada, hora_salida, tiempo_total) VALUES (?,?,?,?)");
$stmt->execute([12345, '2026-02-18 08:00:00','2026-02-18 17:00:00',9]);
$stmt->execute([56789, '2026-02-18 09:00:00','2026-02-18 18:00:00',9]);
echo "Registro insertado correctamente";
?>

