<?php include("./template/header.php") ?>
<?php include("administrador/config/database.php");
    $sentenciaSQL = $conexion->prepare("SELECT * FROM libros2");
    $sentenciaSQL->execute();
    $listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    
?>
<div class="row gap-1 justify-content-center m-0 p-0">
    <?php foreach($listaLibros as $libro){ ?>    
<div class="card col-3 py-2">

        <img class="card-img-top rounded-3 border" src="/img/<?php echo $libro["imagen"] ;?>" alt="">
        <div class="card-body ">
            <h4 class="card-title"><?php echo $libro['nombre']?></h4>
            <a name="" id="" class="btn btn-primary" target="_blank" href="https://books.goalkicker.com/" role="button">Ver mas</a>
        </div>
    </div>
    <?php }?>
    
</div>

<?php include("./template/footer.php") ?>