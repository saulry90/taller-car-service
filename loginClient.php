<?php 
include 'modulo_header.php';

$aceptar=$_POST["aceptar"];
$mail=$_POST["mail"];
$passwordForm=$_POST["passClient"];

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
    $sql="SELECT * FROM client WHERE mail = '$mail' AND contrasena = '$passwordForm'";
    $result= $conn->query($sql);
    if ($result = $conn->query($sql)) 
    {
          while($row=$result->fetch_assoc()) {
                $codigo = $row['codigo'];
                $nombre = $row['nombre'];
          }


          ?>
          <!-- Cargar los servicios del cliente -->
          <main id="gestion">
              <article>
              <section>

                      <div id="container">
                      <h3>Servicios que has realizado en el taller</h3>
                      <div class="rowtable">
                          <span>Servicio solicitado</span>
                          <span>Persona que te atendió</span>
                          <span>Fecha</span>
                      </div>  

                      <div class="rowtable">
                            <?php
                             $sql="SELECT * FROM solicitar WHERE codigo = '$codigo'";
                              $result= $conn->query($sql);
                              if ($result->num_rows>0)
                              {
                              while($row=$result->fetch_assoc()) {
                                    $tipo = $row['tipo'];
                                    $fecha = $row['fecha'];
                                    $user = $row['user'];
                                    }
                                    echo utf8_encode('<span>'.$tipo.'</span><span>'.$user.'</span><span>'.$fecha.'</span>');
                              } 
                            ?>
                    </div>
                                    <p><a href='#' onclick='javascript:history.go(-1)'>Salir</a></p>
                                  
                </section>  
                </article>
                </main>
                </body>
                </html>
                    <?php

        }
        else
        {
            echo "Debes rellenar los campos<br>Redirigiendo...";
           //header('refresh:1;url=./index.php');
        } 

    }
   
?>

</body>
</html>
