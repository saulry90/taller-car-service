<?php include 'modulo_header.php';?>
<?php
session_start();
?>
<?php

// Datos form
// Se trae el código del cliente del form
$clienteSel=$_POST["clientesel"];


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
        <!-- Cargar las reservas del cliente -->
          <main id="gestion">
                    <article>
                    <section>
                    <?php
                            echo '<span id="sesionNombre">Hola '.$_SESSION["user"].'</span>';
                    ?>
                    <div id="container">

                            <h3>Crear nueva cita para revisión</h3>

                            <?php
                        // Seleccionar de la tabla de clientes el nombre del cliente que coincida con el seleccionado en el form anterior
                        $sqlcl="SELECT nombre FROM client WHERE codigo = '$clienteSel'";
                        $resultcl= $conn->query($sqlcl);
                        if ($resultcl->num_rows>0)
                        {
                            while($row=$resultcl->fetch_assoc()) {
                                $nombrecl = $row['nombre'];
                            }
                        }

                        $_SESSION["nombre"] = $nombrecl;
                        ?>

                            <p>Crea una nueva cita para <?php echo $nombrecl; ?> indicando los servicios que debe realizar en su próxima visita.</p>

                        <form action="cita.php" method="post">

                            
                            
        
                            <div class="formrow">
                                <label for="service">Tipo de servicio a realizar:</label>
                                <select multiple name='nombre_service[]'>
                                <option select hidden value='0'>Elige el servicio a realizar</option>
                                <?php
            
                                // Seleccionar todos los nombres de todos los servicios para que aparezcan como opción a seleccionar dentro del select 
                                $sql="SELECT * FROM servicio";
                                $result= $conn->query($sql);
                                if ($result->num_rows>0)
                                {
                                    while($row=$result->fetch_assoc()) {
                                            $tipo = $row['tipo'];  
                                            echo utf8_encode("<option value='");
                                        echo utf8_encode($tipo."' name='serviciot'>".$tipo."</option>");
                                    }
                                    
                                }
                                else{
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }

                                ?>
                                </select>
                            </div>
                            <div class="formrow">
                                <div>
                                    <label for="start">Fecha para la próxima revisión:</label>
                                    <input type="date" id="start" name="trip-start" min="" max="">
                                </div>
                                <input type="submit" value="Crear nueva cita" name="ncita"><br>
                            </div>
                            
                        </form>


                        
                        <h3>Registro de solicitudes de <?php echo $nombrecl; ?></h3>
                    
                        <div class="rowtable">
                            <span>Tipo de servicio </span>
                            <span>Persona que lo atendió   </span>
                            <span>Fecha </span>
                        </div>

                    <?php


                // Seleccionar de la tabla de solicitudes todos los campos del cliente seleccionado cuando el código sea igual al traido del form
                $sql="SELECT * FROM solicitar WHERE codigo = '$clienteSel'";
                $result= $conn->query($sql);
                if ($result->num_rows>0)
                {
                    while($row=$result->fetch_assoc()) {
                        $tipo = $row['tipo'];
                        $fecha = $row['fecha'];
                        $userwork = $row['user'];

                        // Se introduce en un campo de opción única y dentro de un span cada variable con los datos de la tabla solicitar
                        echo utf8_encode('
                        
                        <div class="rowtable">
                        <label><span>'.$tipo.'</span> <span>'.$userwork. '</span> <span>'.$fecha.'</span>
                        </div>');
                        
                    } 
                }              
                  
}
                  ?>

        </main id="loginTaller">
        </article>
        </div>
        </section>
            </main>
            </body>

            <script>
                // Restringir el input date con la fecha actual en el parametro min
                let today = new Date();
                let dd = today.getDate();
                let mm = today.getMonth()+1;
                let yyyy = today.getFullYear();
                if(dd<10){
                dd='0'+dd
                } 
                if(mm<10){
                mm='0'+mm
                } 

                today = yyyy+'-'+mm+'-'+dd;
                document.querySelector("#start").setAttribute("min", today);
            </script>

    </html>