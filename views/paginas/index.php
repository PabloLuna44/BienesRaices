<main class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>

        <?php  include 'iconos.php' ?>

    </main>


    <section class="secccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>
        
       <?php  include 'listar.php' ?>

        <div class="alinear-derecha">
            <a class="boton-verde" href="">Ver todas</a>
        </div>

    </section>


    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario y un asesor se pondra en contacto contigo a la brevedad</p>

        <div>
            <a href="contacto.php" class="boton-amarillo">Contactanos</a>
        </div>
    </section>


    <div class="contenedor seccion seccion-inferior">

        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="image">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpg">

                        <img src="build/img/blog1.jpg" alt="Imagen Blog">
                    </picture>

                </div>

                <div class="texto-entrada">
                    <a href="entrada.php"></a>
                    <h4>Terraza en el techo de tu casa</h4>
                    <p>Escrito el: <span>20/10/23</span> por: <span>Admin</span></p>

                    <p>
                        Consejos para construir una terraza en el techo de tu casa con los mejores
                        materiales y ahorrando dinero
                    </p>
                </div>

            </article>

            <article class="entrada-blog">
                <div class="image">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpg">

                        <img src="build/img/blog2.jpg" alt="Imagen Blog">
                    </picture>

                </div>

                <div class="texto-entrada">
                    <a href="entrada.php"></a>
                    <h4>Guia para la decoracion de tu hogar</h4>
                    <p>Escrito el: <span>20/10/23</span> por: <span>Admin</span></p>

                    <p>
                        Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles
                        y colores para darle vida a tu espacio
                    </p>
                </div>

            </article>

        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comporto de una exelente forma, muy buena atecion y la casa
                    que me ofrecieron cumple con tadas mis expectativas
                    <h4>Juan Pablo Guzman</h4>
                </blockquote>
            </div>


        </section>

    </div>
