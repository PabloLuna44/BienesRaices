<main class="contenedor seccion">
        <h1>Contacto</h1>

        <?php  
        if($mensaje){?>
            <p class="alerta exito"><?php echo $mensaje ?></p>
            <?php
        }

        ?>

        <picture>
            <source srcset="build/img/destacada3.jpg" type="image/avif">
            <source srcset="build/img/destacada3.jpg.webp" type="image/webp">
            <img loading="lazy" width="200" height="300" src="build/img/destacada3.jpg.jpg" alt="">
        </picture>


        <h2>Llene el formulario de Contacto</h2>

        <form class="formulario" action="/contacto" method="POST" >

            <fieldset>
                <legend>Informacion Personal</legend>

                <label>Nombre</label>
                <input type="text"  placeholder="Nombre" id="nombre" name="contacto[nombre]" required>     

                <label>Mensaje</label>
                <textarea  id="mensaje" cols="30" rows="10" name="contacto[mensaje]" required></textarea>
            </fieldset>


            <fieldset>
                <legend>Informacion Sobre la propiedad</legend>

                <label for="opciones">Vende o Compra</label>
                <select id="opciones" name="contacto[tipo]" required>
                    <option value="" disabled selected>---Seleccione---</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" name="contacto[precio]" id="" placeholder="Precio o Presupuesto" id="presupuesto" required>

            </fieldset>

            <fieldset>
                <legend>Preferencia</legend>
                <p>Como desea ser contactado</p>


                <div class="form-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input  type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                    <label for="contactar-email">Email</label>
                    <input  type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>


                </div>


                <div id="contacto"></div>

                
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">

        </form>

    </main>