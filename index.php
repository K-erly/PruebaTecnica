<?php 
//Creación de base de datos
require 'config/conexionDB.php';
require 'config/createTable.php';
date_default_timezone_set('America/Bogota');
session_start();


//iniciar jornada
if(isset($_POST['iniciar'])){
    $codigo= trim($_POST['codigo']);

    $empleado = $db->prepare("SELECT 1 from jornadas WHERE codigo_trabajador = ? LIMIT 1");
    $empleado->execute([$codigo]);
    $existeEmpleado = $empleado->fetch();
    //Validación de campos
    if($existeEmpleado){

        if(!empty($codigo) && is_numeric($codigo)){
            //Verificar si tiene jornada abierta
            $jornada = $db->prepare("SELECT id from jornadas WHERE codigo_trabajador = ? AND hora_salida IS NULL LIMIT 1");
            $jornada->execute([$codigo]);
            $existeJornada = $jornada->fetch(PDO::FETCH_ASSOC);

            //si no existe jornada
            if(!$existeJornada){

                $horaEntrada = date("Y-m-d H:i:s");

                $inicioJornada = $db->prepare("INSERT INTO jornadas (codigo_trabajador, hora_entrada) VALUES (?, ?)");
                $inicioJornada->execute([$codigo, $horaEntrada]);
            }

            $_SESSION['codigo'] = $codigo;

            header("Location: jornada.php");
            exit();
            
        }
    }else{
        echo("Empleado no registrado");
    }
}
?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos/style.css" type="text/css">
        <title>Inicio</title>
    </head>
    <body class="login">
        <div class="container">
            <h2> Prueba Técnica</h2>
            <h3>Kimberly Torres Jiménez</h3>
             <div class="container-form">
                
                <h2>Iniciar Jornada</h2>
                <form method="POST">

                    <input type="number" name="codigo" placeholder="Código empleado" required>
                    <button class="btn" type="submit" name="iniciar">Ingresar</button>      
                </form>
            </div>
           
        </div>
    </body>
</html>