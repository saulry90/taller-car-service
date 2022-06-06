<?php 
include 'modulo_header.php';
session_start();

// Datos form
$aceptar=$_POST["aceptar"];
$user=htmlspecialchars($_POST["user"]);
$passwordForm=$_POST["passwordForm"];

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
    /* if (isset($_SESSION['user']) {
        echo "ddd";
    } */
    if (isset($_POST["aceptar"]))
    {
         if (!empty($user) && !empty($passwordForm)) 
        {
            
            // Consultar user y password de la BBDD y que sea igual con los datos introducidos en el login
            $sql="SELECT user,passw FROM worker WHERE user = '$user' AND passw = '$passwordForm'";
            $result= $conn->query($sql);
            // Si hay un resultado en la BBDD
            if ($result->num_rows==1) 
            {


              
                // Crear sesión con el user del mecánico que a accedido
                $_SESSION["user"]=$user;
                $_SESSION["passw"]=$passwordForm;

                ?>
                    <!-- Cargar los datos de los clientes -->
                    <main id="loginTaller">
                    <article>
                    <section>
                    <?php
                            echo '<span id="sesionNombre">Hola '.$_SESSION["user"].'</span>';
                        ?>
                            <div id="container">
                            <h3>Listado de clientes</h3>
                            <p>Selecciona una persona para ver las visitas que ha hecho al taller o para crear una nueva solicitud</p>
                            
                                    <form action="gestion.php" method="post" name="formGestion">
                                        
                                        <div class="rowtable">
                                            <span>ID cliente </span>
                                            <span>Nombre   </span>
                                            <span>E-mail </span>
                                            <span>Teléfono </span>
                                            <span>Código postal </span>
                                        </div>

                <?php
                // Consulta seleccionando todos los campos de la tabla "CLIENT"
                $sql="SELECT * FROM client";
                $result= $conn->query($sql);
                if ($result->num_rows>0)
                {
                    while($row=$result->fetch_assoc()) {
                        $mail = $row['mail'];
                        $nombre = $row['nombre'];
                        $apellidos = $row['apellidos'];
                        $telefono = $row['telefono'];
                        $cp = $row['cp'];
                        $codigo = $row['codigo'];

                        //  Guardar el nombre del cliente en una sesión
                        $_SESSION["nombre"]=$nombre;
                        $_SESSION["apellidos"]=$apellidos;

                        // Se introduce en un campo de opción única y dentro de un span cada variable con los datos de la tabla client
                        echo utf8_encode('
                        
                        <div class="rowtable">
                        
                        
                        <label><span>'.$codigo.'</span> <span>'.$nombre. ' '.$apellidos.'</span> <span>'.$mail.'</span>  <span>'.$telefono.'</span> <span>'.$cp.'</span><input type="radio" id="miclienteSel" name="clientesel" value="'.$codigo.'" onChange="autoSubmit()";></label>
                        </div>');
                    }

                    ?>
                </form>
                </div>
                </section>
                </article>
                </main>
                </body>
                </html>
                    <?php
            }
            else 
            {
                echo "Hay algo incorrecto vuelve a intentarlo<br>Redirigiendo...";
               header('refresh:1;url=./index.php');
            }

        }
        else
        {
            echo "<p style='text-align:center;'>Los datos introducidos son erróneos</p>";
           header('refresh:1;url=./index.php');
        } 
    }
}    
}    
?>