<?php
   require 'config/conexionDB.php';

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
        echo("Hay jornada activa version 2.0");
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

    <button class="btn" id="cerrarJornada">Cerrar Jornada</button>
    
    </div>

    <script type="text/javascript" >
        const horaEntrada = new Date("<?php echo ($jornadaActiva['hora_entrada']) ?>");
        
        const h = horaEntrada.getHours().toString().padStart(2, '0');
        const m = horaEntrada.getMinutes().toString().padStart(2, '0');
        const s = horaEntrada.getSeconds().toString().padStart(2, '0');
        
       // alert("hora entrada"+horaEntrada+ "separada "+ h+":"+m+":"+s);
        
       function actualizarCronometro(){
        
        const horaActual = new Date();
        // const hora = horaActual.getHours();
        // const minutos = horaActual.getMinutes();
        // const segundos = horaActual.getSeconds();

        const tiempoMilisegundos = (horaActual-horaEntrada);

        if(tiempoMilisegundos < 0)return; //Para evitar tiempos negativos

        const totalHoras = tiempoMilisegundos / (1000 * 60 * 60);

        //Representación legible del tiempo
        let tiempoHoras = Math.floor(totalHoras);
        let tiempoMinutos = Math.floor((totalHoras % 1) * 60);
        let tiempoSegundos = Math.round((((totalHoras % 1) * 60) % 1) * 60);

        //Formato presentacion horas
        // if(tiempoHoras<10) {tiempoHoras = "0"+tiempoHoras};
        // if(tiempoMinutos<10) {tiempoMinutos = "0"+tiempoMinutos};
        // if(tiempoSegundos<10) {tiempoSegundos = "0"+tiempoSegundos};
        tiempoHoras=tiempoHoras.toString().padStart(2, "0");
        tiempoMinutos=tiempoMinutos.toString().padStart(2, "0");
        tiempoSegundos=tiempoSegundos.toString().padStart(2, "0");
        
    
    //     console.log("hora entrada"+horaEntrada+ "separada "+ h+":"+m+":"+s+" hora actual "+horaActual +" separada "+hora+":"+minutos+":"+segundos);
    // console.log(totalHoras+" "+tiempoHoras+":"+tiempoMinutos+":"+tiempoSegundos);
        document.getElementById("cronometro").textContent = `${tiempoHoras}:${tiempoMinutos}:${tiempoSegundos}`;   
    }
       setInterval(actualizarCronometro,1000);
    </script>  

</body>