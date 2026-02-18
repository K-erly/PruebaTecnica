<?php
   require 'config/conexionDB.php';
   date_default_timezone_set('America/Bogota');
   session_start();

   //Verifica sesión
   if(!isset($_SESSION['codigo'])){
        header("Location: index.php");
        exit();
   }

    $codigo = $_SESSION['codigo'];

    //Obtener jornada
    $jornada = $db->prepare("SELECT hora_entrada FROM jornadas WHERE codigo_trabajador = ? AND hora_salida IS NULL LIMIT 1");
    $jornada->execute([$codigo]);

    $jornadaActiva = $jornada->fetch(PDO::FETCH_ASSOC);
    
    if($jornadaActiva){
        echo("Hay jornada activa");
    }else{
        echo("No hay jornada activa");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Jornada</title>
    <link rel="stylesheet" href="estilos/style.css">
</head>
<body>
    <div class="container">
    <h2>Jornada en curso</h2>
    <p>Código empleado: <?php echo ($codigo); ?></p>
    <p>Ingreso: <?php echo ($jornadaActiva['hora_entrada']); ?></p>

    <h1 id="cronometro">00:00:00</h1>

    <form action="logout.php" method="POST">
        <button type="submit">Cerrar Jornada</button>
    </form>
    </div>
</body>