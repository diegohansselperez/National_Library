<?php include("../template/header_admin.php") ?>
<?php
$txtId = (isset($_POST["id_txt"])) ? $_POST["id_txt"] : "";
$txtNombre = (isset($_POST["nombre"])) ? $_POST["nombre"] : "";
$txtImagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";
$accion = (isset($_POST["accion"])) ? $_POST["accion"] : "";


echo $txtId . "<br/>";
echo $txtNombre . "<br/>";

echo $txtImagen . "<br/>";
echo $accion . "<br/>";

$localhost = "localhost";
$bd = "national_library";
$usuario = "root";
$contraseña = "";

try {
    $canexion = new PDO("mysql:host=$localhost;dbname=$bd", $usuario, $contraseña);
    if ($canexion) {
        echo "Conectado al sistema";
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}

switch ($accion) {
    case "agregar":
        //INSERT INTO `libros` (`ID`, `NOMBRE`, `IMAGEN`) VALUES (NULL, 'Javascript 1.0', 'javascript_image.jpg');
        $sentenciaSQL = $conexion->prepare("INSERT INTO `libros` (`ID`, `NOMBRE`, `IMAGEN`) VALUES (NULL, 'Javascript 1.0', 'javascript_image.jpg')");
        $sentenciaSQL->execute();

        echo "Presionar boton agregar";
        break;
    case "modificar":
        echo "Presionar boton modificar";
        break;
    case "cancelar":
        echo "Presionar boton cancelar";
        break;
}


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

            <tr>
                <td>2</td>
                <td>Aprende Java</td>
                <td>Imagen.jpg</td>
                <td>Selecionar | Boorar</td>
            </tr>
        </tbody>
    </table>
</div>

<?php include("../template/footer_admin.php") ?>