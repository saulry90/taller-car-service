<?php include 'modulo_header.php';?>
<main id="indexLogin">
      <article>
            <section>
                  <!-- Pestañas para diferenciar el login -->
                  <div id="tabsDiv">

                        <button class="linkClass" onclick="displayContent(event, 'privada')">
                        Inicia sesión como empleado
                        </button>

                        <button class="linkClass" onclick="displayContent(event, 'clientes')">
                        Inicia sesión como cliente
                        </button>
            
                        <!-- Pestaña login privado  -->
                        <div id="privada" class="contentClass">
                              <h3>Inicia sesión como empleado</h3>
                                    <section>
                                          <p>Introduce tu nombre de usuario y la contraseña para acceder a tu area privada:</p>
                                          <form action="loginTaller.php" method="post">
                                                <p><label>Introduce tu nombre de user</label><input type="text" name="user" required placeholder="Gerente"></p>
                                                <p><label>Introduce tu clave</label><input type="password" name="passwordForm" required placeholder="1111"></p>
                                                <input type="submit" value="aceptar" name="aceptar">
                                          </form> 
                                    </section>
                        </div>
            
                        <!-- Pestaña login cliente  -->
                        <div id="clientes" class="contentClass">
                              <h3>Inicia sesión como cliente</h3>
                              <section>
                                    <p>Introduce tu e-mail y la contraseña para acceder a tus citas:</p>
                                    <form action="loginClient.php" method="post">
                                          <p><label>Introduce tu E-mail</label><input type="mail" name="mail" required placeholder="javi@gmail.com"></p>
                                          <p><label>Introduce tu contraseña de acceso</label><input type="password" name="passClient" required placeholder="222"></p>
                                          <input type="submit" value="aceptar" name="aceptar">
                                    </form> 
                              </section>
                  </div>
            </section>
      </article>

      
</main>

<!-- Script para poder visualizar los diferentes login según donde se seleccione -->
<script>
      document.querySelector('#privada').style.display = "block";
      document.querySelector('.linkClass').classList.add("active");
      
      function displayContent(event, contentNameID) {
  
            let content = document.getElementsByClassName("contentClass");
            let totalCount = content.length;

            // Loop through the content class
            // and hide the tabs first
            for (let count = 0;
                  count < totalCount; count++) {
                  content[count].style.display = "none";
            }

            let links = document.getElementsByClassName("linkClass");
            totalLinks = links.length;

            // Loop through the links and
            // remove the active class
            for (let count = 0; count < totalLinks; count++) {
                  links[count].classList.remove("active");
            }

            // Display the current tab
            document.getElementById(contentNameID).style.display = "block";

            // Add the active class to the current tab
            event.currentTarget.classList.add("active");
      }
</script>
</body>
</html>