<?php include("template/header_admin.php") ?>
<div class="col-md-12">
    <div class="jumbotron">
        <h1 class="display-3">Bienvenido <?php echo $nombreUsuario; ?></h1>
        <p class="lead">Vamos a administrar nuestros libros en este sitio web.</p>
        <hr class="my-2">
        <p>More info</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="seccion/productos.php" role="button">Administrador libros</a>
        </p>
    </div>
</div>
<?php include("template/footer_admin.php") ?>