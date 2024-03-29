<main class="contenedor seccion ">
    <h1>Administrador de Bienes Raices</h1>
    <?php
    if ($resultado) {
        $Mostrar = MostrarNotificacion(intval($resultado));

        if ($Mostrar) { ?>
            <p class="alerta <?php echo $Mostrar['tipo'] ?>"><?php echo $Mostrar['mensaje'] ?></p>
    <?php }
    }


    ?>

    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor</a>

    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <th>ID</th>
            <th>Titulo</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Acciones</th>
        </thead>

        <tbody> <!--mostrar los resultados -->
            <?php foreach ($propiedades as $propiedad) : ?>

                <tr>
                    <td><?php echo $propiedad->id ?></td>
                    <td><?php echo $propiedad->titulo ?></td>
                    <td> <img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen ?>" alt=""></td>
                    <td>$<?php echo $propiedad->precio ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" value="<?php echo $propiedad->id ?>" name="id">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a class="boton-amarillo-block" href="/propiedades/actualizar?id=<?php echo $propiedad->id ?>">Actualizar</a>
                    </td>
                </tr>

            <?php endforeach; ?>



        </tbody>
    </table>


    <h2>Vendedores</h2>

<table class="propiedades">
    <thead>
        <th>ID</th>
        <th>Nombre</th>
        <th>Imagen</th>
        <th>Telefono</th>
        <th>Acciones</th>
    </thead>

    <tbody> <!--mostrar los resultados -->
        <?php foreach ($vendedores as $vendedor) : ?>

            <tr>
                <td><?php echo $vendedor->id ?></td>
                <td><?php echo $vendedor->nombre ." ". $vendedor->apellido ?></td>
                <td> <img class="imagen-tabla" src="/imagenes/<?php echo $vendedor->imagen ?>" alt=""></td>
                <td><?php echo $vendedor->telefono ?></td>
                <td>
                    <form method="POST" action="/vendedores/eliminar" class="w-100">
                        <input type="hidden" value="<?php echo $vendedor->id ?>" name="id">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a class="boton-amarillo-block" href="/vendedores/actualizar?id=<?php echo $vendedor->id ?>">Actualizar</a>
                </td>
            </tr>

        <?php endforeach; ?>



    </tbody>

</table>

