<?php 
use Model\Vendedor; 

if(!$vendedor)

$vendedor=new Vendedor();

?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>

    <a href="/admin" class="boton-verde">Volver</a>


    <?php foreach ($errores as $error) : ?>

        <div class="alerta error">
            <?php echo $error ?>

        </div>

    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/vendedores/actualizar?id=<?php echo $vendedor->id ?>" enctype="multipart/form-data">

    <?php include __DIR__ . '/formulario.php';?>

        <input type="submit" value="Actualizar Vendedor" class="boton-verde">
    </form>
</main>
