<main class="contenedor seccion contenido-centrado">
        <h1><?php  echo $propiedad->titulo ?></h1>

        <div class="image">
            
                <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="Anuncio 1" loading="lazy">

            
        </div>
        <div class="resumen-propiedad">
            
            <p class="precio">$<?php  echo $propiedad->precio ?></p>

        <ul class="iconos">
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="Imagen wc">
                <p><?php  echo $propiedad->wc ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Imagen Estacionamiento">
                <p><?php  echo $propiedad->estacionamiento ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="Imagen Dormitorio">
                <p><?php  echo $propiedad->habitaciones ?></p>
            </li>

        </ul>

        <p>
        <?php  echo $propiedad->descripcion ?>
        </p>

    
        </div>

    </main>

  