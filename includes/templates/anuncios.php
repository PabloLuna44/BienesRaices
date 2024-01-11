<?php

use App\Propiedad;

if($_SERVER['REQUEST_URI']=='/index.php'){

    $propiedades=Propiedad::getLimit(3);

}else{
    $propiedades=Propiedad::all();
}


?>

<div class="contenedor-anuncios">
    <?php foreach ($propiedades as $propiedad) : ?>
        <div class="anuncio">

            <img src="../../imagenes/<?php echo $propiedad->imagen ?>" alt="Anuncio 1" loading="lazy">

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo ?></h3>
                <p class="parrafo"><?php echo $propiedad->descripcion ?></p>
               
                
                <p class="precio">$<?php echo $propiedad->precio ?></p>

                <ul class="iconos">
                    <li>
                        <img class="icono" src="build/img/icono_wc.svg" alt="Imagen wc">
                        <p><?php echo $propiedad->wc ?></p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Imagen Estacionamiento">
                        <p><?php echo $propiedad->estacionamiento ?></p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_dormitorio.svg" alt="Imagen Dormitorio">
                        <p><?php echo $propiedad->habitaciones ?></p>
                    </li>

                </ul>

                <a class="boton boton-amarillo-block" href="anuncio.php?id=<?php echo $propiedad->id ?>">Ver Propiedad</a>


            </div> <!--contenido anuncio-->

        </div> <!--Anuncio-->
    <?php endforeach;   ?>
</div>

<script>
    // Obtener todos los elementos con la clase "parrafo"
    var parrafos = document.querySelectorAll(".parrafo");

    // Limitar el número de caracteres para cada párrafo
    var longitudMaxima =100;
    parrafos.forEach(function (parrafo) {
        parrafo.textContent = parrafo.textContent.slice(0, longitudMaxima) + '...';
    });
</script>


<?php


?>