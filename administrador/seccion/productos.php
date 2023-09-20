<?php include("../template/header_admin.php") ?>
<?php
$txtId = (isset($_POST["id_txt"])) ? $_POST["id_txt"] : "";
$txtNombre = (isset($_POST["nombre"])) ? $_POST["nombre"] : "";
$txtImagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";
$accion = (isset($_POST["accion"])) ? $_POST["accion"] : "";

include("../config/database.php");

switch ($accion) {
    case "agregar":
        //comando de MySql
        $sentenciaSQL = $conexion->prepare("INSERT INTO libros2 (nombre,imagen) VALUES (:nombre,:imagen);");
        if (!$conexion) {
            die("Error al conectar a la base de datos");
        }
        //comando de MySql
        $sentenciaSQL->bindParam(":nombre", $txtNombre);
        $fecha = new DateTime();
        $nombreDelArchivo = ($txtImagen != '') ? $fecha->getTimestamp() . "_" . $_FILES["imagen"]["name"] : "imagen.jpg";

        $tmpImagen = $_FILES["imagen"]["tmp_name"];
        if ($tmpImagen != '') {
            move_uploaded_file($tmpImagen, "../../img/" . $nombreDelArchivo);
        }
        //comando de MySql
        $sentenciaSQL->bindParam(":imagen", $nombreDelArchivo);
        //comando de MySql
        $sentenciaSQL->execute();

        header("Location:productos.php");
        break;


    case "modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE libros2 SET nombre=:nombre WHERE id=:id");
        $sentenciaSQL->bindParam(":nombre", $txtNombre);
        $sentenciaSQL->bindParam(":id", $txtId);
        $sentenciaSQL->execute();


        if ($txtImagen != "") {
            $fecha = new DateTime();
            $nombreDelArchivo = ($txtImagen != '') ? $fecha->getTimestamp() . "_" . $_FILES["imagen"]["name"] : "imagen.jpg";

            $tmpImagen = $_FILES["imagen"]["tmp_name"];
            move_uploaded_file($tmpImagen, "../../img/" . $nombreDelArchivo);

            //Eliminamos la imagen anterior
            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM libros2 WHERE id=:id");
            $sentenciaSQL->bindParam(":id", $txtId);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($libro["imagen"]) && $libro["imagen"] != "imagen.jpg") {
                if (file_exists("../../img/" . $libro["imagen"])) {
                    unlink("../../img/" . $libro["imagen"]);
                }
            }
            //Selecionamos la imagen nueva
            $sentenciaSQL = $conexion->prepare("UPDATE libros2 SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(":imagen", $nombreDelArchivo);
            $sentenciaSQL->bindParam(":id", $txtId);
            $sentenciaSQL->execute();
        }

        header("Location:productos.php");
        break;


    case "cancelar":
        
        header("Location:productos.php");

        break;


    case "borrar":
        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM libros2 WHERE id=:id");
        $sentenciaSQL->bindParam(":id", $txtId);
        $sentenciaSQL->execute();
        $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($libro["imagen"]) && $libro["imagen"] != "imagen.jpg") {
            if (file_exists("../../img/" . $libro["imagen"])) {
                unlink("../../img/" . $libro["imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM libros2 WHERE id=:id");
        $sentenciaSQL->bindParam(":id", $txtId);
        $sentenciaSQL->execute();
        header("Location:productos.php");
        break;

    case "seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM libros2 WHERE id=:id");
        $sentenciaSQL->bindParam(":id", $txtId);
        $sentenciaSQL->execute();
        $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre = $libro["nombre"];
        $txtImagen = $libro["imagen"];

        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM libros2");
$sentenciaSQL->execute();
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
                    <input type="text" required readonly value="<?php echo $txtId; ?>" class="form-control" name="id_txt" id="id_txt" aria-describedby="emailHelp" placeholder="Agrega un ID...">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre:</label>
                    <input type="text"  required class="form-control"  value="<?php echo ($accion)=="modificar"? "": $txtNombre; ?>" name="nombre" id="nombre_txt" aria-describedby="emailHelp" placeholder="Agrega un Nombre...">

                </div>
                <div class="form-group">
                    <label>Imagen:</label>
                    <br/>
                    <?php
                    if ($txtImagen != "") {
                    ?>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" alt="" width="70">
                    <?php } ?>
                    
                    <input type="file" class="form-control" name="imagen" id="imagen">
                </div>
                <div class="btn-group row" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion)=="seleccionar"? "disabled": null; ?> value="agregar" class="rounded my-1 mx-sm-1 col-sm-auto col-md-auto btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion)!="seleccionar"? "disabled": null; ?> value="modificar" class=" rounded my-1 mx-sm-1 col-sm-auto col-md-auto btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion)!="seleccionar"? "disabled": null; ?> value="cancelar" class=" rounded my-1 mx-sm-1 col-sm-auto col-md-auto btn btn-info">Cancelar</button>
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
            <?php foreach ($listaLibros as $libro) { ?>

                <tr>
                    <td><?php echo $libro['id']; ?></td>
                    <td><?php echo $libro['nombre']; ?></td>
                    <td>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $libro['imagen']; ?>" alt="" width="90">


                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="id_txt" id="id_txt" value="<?php echo $libro["id"]; ?>">
                            <input type="submit" name="accion" value="borrar" class="btn btn-danger">
                            <input type="submit" name="accion" value="seleccionar" class="btn btn-primary">
                        </form>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
</div>

<?php include("../template/footer_admin.php") ?>