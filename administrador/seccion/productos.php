<?php include("../template/header_admin.php") ?>
<?php
$txtId = (isset($_POST["id_txt"])) ? $_POST["id_txt"] : "";
$txtNombre = (isset($_POST["nombre"])) ? $_POST["nombre"] : "";
$txtImagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";
$accion = (isset($_POST["accion"])) ? $_POST["accion"] : "";

include("../config/database.php");

switch ($accion) {
    case "agregar":
        //INSERT INTO `libros` (`ID`, `NOMBRE`, `IMAGEN`) VALUES (NULL, 'Javascript 1.0', 'javascript_image.jpg');
        
                                   //comando de MySql
        $sentenciaSQL = $conexion->prepare("INSERT INTO libros (NOMBRE,IMAGEN) VALUES (:NOMBRE,:IMAGEN);");
        if (!$conexion) {
            die("Error al conectar a la base de datos");
        }              
                        //comando de MySql
        $sentenciaSQL->bindParam(":NOMBRE", $txtNombre);
        $sentenciaSQL->bindParam(":IMAGEN", $txtImagen);

                        //comando de MySql
        $sentenciaSQL->execute();


        break;
    case "modificar":
        echo "Presionar boton modificar";
        break;
    case "cancelar":
        echo "Presionar boton cancelar";
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL ->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            Datos del Libro
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">ID:</label>
                    <input type="text" class="form-control" name="id_txt" id="id_txt" aria-describedby="emailHelp" placeholder="Agrega un ID...">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre_txt" aria-describedby="emailHelp" placeholder="Agrega un Nombre...">

                </div>
                <div class="form-group">
                    <label>Imagen:</label>
                    <input type="file" class="form-control" name="imagen" id="imagen">
                </div>
                <div class="btn-group row" role="group" aria-label="">
                    <button type="submit" name="accion" value="agregar" class="rounded my-1 mx-sm-1 col-sm-auto col-md-auto btn btn-success">Agregar</button>
                    <button type="submit" name="accion" value="modificar" class=" rounded my-1 mx-sm-1 col-sm-auto col-md-auto btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" value="cancelar" class=" rounded my-1 mx-sm-1 col-sm-auto col-md-auto btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>

    </div>



</div>
<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach($listaLibros as $libro){ ?>
            
            <tr>
                <td><?php echo $libro['ID']; ?></td>
                <td><?php echo $libro['NOMBRE']; ?></td>
                <td><?php echo $libro['IMAGEN']; ?></td>
                <td>Selecionar | Boorar</td>
            </tr>
            <?php }?>
            
        </tbody>
    </table>
</div>

<?php include("../template/footer_admin.php") ?>