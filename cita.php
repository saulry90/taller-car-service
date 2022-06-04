<?php include 'modulo_header.php';?>
<?php
session_start();
?>
<?php

// Variable con el nombre del cliente guardada en sesión
$nameclient = $_SESSION["nombre"];

// Variable del trabajador
$nomworker = $_SESSION["user"];

// Conexión BBDD
$servername = "PMYSQL124.dns-servicio.com";
$username = "bbdd_disatechgo";
$password = "Disa8614+"; 
$dbname = "7353665_taller-car-service";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
else
{ 

      ?>
         
        <!-- Confirmar la reserva -->
          <main id="cita">
                    <article>
                    <section>
                    <?php
                            echo '<span id="sesionNombre">Hola '.$nomworker.'</span>';
                    ?>
                    <div id="container">
                        <img class="confirmimage" src="assets\images\done.png">
                  <?php
                  
                 if (isset($_POST["ncita"])){
                       $datecita = $_POST["trip-start"];
                       $nombreserv = $_POST["nombre_service"];

                  if (!empty($datecita) && !empty($nombreserv)){   
                       echo '
                       <p>Cita añadida: '.$datecita.'</p>
                       <ul>';

                      

                        // Consultar el codigo del cliente comparando con el nombre del cliente que tenemos almacenado en la sesión
                        $sql="SELECT codigo,mail FROM client WHERE nombre = '$nameclient'";
                        $result= $conn->query($sql);
                        // Si hay un resultado en la BBDD
                        if ($result->num_rows==1) 
                        {
                            while($row=$result->fetch_assoc()) {
                                $codigo = $row['codigo'];
                                $mail = $row['mail'];
                            }

                            // Por cada tipo de servicio insertar en la tabla solicitar una cita nueva
                            for ($i=0;$i<count($nombreserv);$i++)    
                            {     
                            $sql2=utf8_decode("INSERT INTO solicitar (tipo,codigo,fecha,user) VALUES ('$nombreserv[$i]','$codigo','$datecita','$nomworker')");
                            if ($conn->query($sql2)===TRUE)
                            {
                                $servis = $nombreserv[$i];
                                echo ("<li>".$nombreserv[$i]."</li>"); 
                            }
                            else 
                            {
                                echo "Error: " . $sql2 . "<br>" . $conn->error;
                            }
                            } 
                            // * Para enviar el mail con mailto y meter en variable los servicios de <li>. Volver a listado con historico javascript
                            echo "
                            </ul>
                            <p><a href='mailto:".$mail."?subject=Su%20próxima%20visita%20al%20taller&body=Hola%20".$nameclient."%20le%20recordamos%20que%20su%20próxima%20visita%20al%20taller%20es%20el%20".$datecita."%20para%20una%20revisión%20de:%0A%0A";
                            for ($i=0;$i<count($nombreserv);$i++) {    

                                echo "· ".$nombreserv[$i]."%0A";
             
                            }
                            echo "%0AGracias, nos vemos pronto.'>Enviar mail recordatorio al cliente</a</p>";
                            echo "<p><a href='#' onclick='javascript:history.go(-2)'>Volver al listado de clientes</a></p>";
                        }
                      
                 }
                 else {
                       echo 'Elige fecha y servicio para la cita';
                 }

            }
           
}
?>    
</div>
</section>
</article>        
</main>
            </body>