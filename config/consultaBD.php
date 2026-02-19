<?php
require 'conexionDB.php';

$stmt = $db->query("SELECT * FROM jornadas ORDER BY id DESC");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($data);
echo "</pre>";

echo "Timezone actual: " . date_default_timezone_get() . "<br>";
echo "Hora actual PHP: " . date("Y-m-d H:i:s") . "<br>";

?>