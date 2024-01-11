


<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Session</h1>

    
   <?php foreach ($errores as $error) : ?>

<div class="alerta error">
    <?php echo $error ?>

</div>

<?php endforeach; ?>

    <form method="POST" class="formulario">


    <fieldset>
                <legend>Login</legend>

                <label>Email</label>
                <input type="email" name="user[email]" placeholder="Email" id="email" >

                <label>Password</label>
                <input type="password" name="user[password]" placeholder="Password" id="password">

          </fieldset>

          <input type="submit" value="Iniciar Session" class="boton boton-verde">
    </form>

</main>

