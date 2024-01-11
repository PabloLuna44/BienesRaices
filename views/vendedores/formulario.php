    <fieldset>
        <legend>Informacion Del Vendedor</legend>

        <label for="nombre">Nombre:</label>
        <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre" value="<?php echo s($vendedor->nombre) ?>">

        <label for="apellido">Apellido:</label>
        <input type="text" name="vendedor[apellido]" id="apellido" placeholder="Apellido" value="<?php echo s($vendedor->apellido) ?>">


    </fieldset>


    <fieldset>
        <legend>Informacion Extra</legend>

        <label for="telefono">Telefono:</label>
        <input type="tel" pattern="[0-9]{10}" name="vendedor[telefono]" id="telefono" placeholder="Telefono" size="10" value="<?php echo s($vendedor->telefono) ?>">


        <label for="correo">Telefono:</label>
        <input type="email" name="vendedor[correo]" id="correo" placeholder="Correo" size="10" value="<?php echo s($vendedor->correo) ?>">


        <label for="imagen">Imagen:</label>
        <input type="file" name="vendedor[imagen]" id="imagen" accept="image/jpeg, image/png">

        <?php if ($vendedor->imagen) { ?>
            <img src="/imagenes/<?php echo $vendedor->imagen ?>" alt="Imagen vendedor" class="imagen-small">

        <?php } ?>


    </fieldset>